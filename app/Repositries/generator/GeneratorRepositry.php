<?php

namespace App\Repositries\generator;

use App\Http\Helpers\Helper;
use App\Models\AttemptCode;
use App\Models\Product;
use App\Models\ProductCode;
use App\Models\Role as CustomRole;
use App\Models\TextMessage;
use App\Traits\HandleFiles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use DataTables;



class GeneratorRepositry implements GeneratorInterface
{
    protected $pImagePath = 'p-images/';
    protected $pImageName = null;
    use HandleFiles;
    public function updateOrCreate($request,$id)
    {

        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'prefix' => 'required',
                'digits' => 'required',
                'p_image' => 'required',
            ]);
            if ($validator->fails())
                return Helper::errorWithData($validator->errors()->first(), $validator->errors());

            if ($file = $request->file('p_image')) {
                $this->pImageName = $this->handleFiles($file, $this->pImagePath);
            }

            $role = Product::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'name' => $request->title,
                    'prefix' => $request->prefix,
                    'digit_length' =>$request->digits,
                    'image' => $this->pImageName,
                ]
            );

            ($id==0)?$message = __('translation.record_created'): $message =__('translation.record_updated');
            DB::commit();


            return Helper::success($role, $message);
        } catch (ValidationException $validationException) {
            DB::rollBack();
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            DB::rollBack();
            return Helper::errorWithData($e->getMessage(),[]);
        }
    }


    public function getProducts($request)
    {
        try {
            $data['totalRecords'] = Product::count();
            $qry= Product::query();


            $qry=$qry->when($request->s_name, function ($query, $name) {
                return $query->where('name', 'LIKE', "%{$name}%");
            });


            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();

            if (!empty($request->get('s_name'))) {

                $data['totalRecords']=$qry->count();
            }
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }
    public function deleteProduct($id)
    {
        try {
            $role = Product::find($id);
            $role->delete();
            return Helper::success($role, $message=__('translation.record_deleted'));
        } catch (ValidationException $validationException) {
            DB::rollBack();
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        }

    }
    public function findProductById($id)
    {
        try {
             $res = Product::find($id);
            return Helper::success($res, $message='Record found');
            } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
             }
    }
    public function getAllProducts()
    {
        try {

            $qry= Product::query();
            $data =$qry->get();
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }

    public function createPCodes($request)
    {

        try {
            $prod=Product::find($request->p_id);
            $batchNo=  Helper::generateUniqueNumber(6);
            for($i=0; $i<$request->qty; $i++){
                $uDigit=  Helper::generateUniqueNumber($prod->digit_length);

                $role = ProductCode::updateOrCreate(
                    [
                        'id' => 0
                    ],
                    [
                        'p_id' => $request->p_id,
                        'p_codes' => $prod->prefix.$uDigit,
                        'batch_no' =>$batchNo,
                        'is_verify' =>2,
                    ]
                );
            }
            return Helper::success($role,'Codes created successfully');
        }  catch (\Exception $e) {
            DB::rollBack();
            return Helper::errorWithData($e->getMessage(),[]);
        }
    }
    public function getPCodes($request)
    {
        try {
            $data['totalRecords'] = ProductCode::count();
            $qry= ProductCode::query();
            $qry= $qry->with('product');


            $qry=$qry->when($request->s_name, function ($query, $name) {
                return $query->where('name', 'LIKE', "%{$name}%");
            });


            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();

            if (!empty($request->get('s_name'))) {



                $data['totalRecords']=$qry->count();
            }
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }
    public function attemptCodeList($request)
    {
        try {
            $data['totalRecords'] = AttemptCode::count();
            $qry= AttemptCode::query();




            $qry = $qry->when($request->s_name, function ($query, $name) {
                return $query->where('name', 'LIKE', "%{$name}%")
                    ->orWhere('p_code', 'LIKE', "%{$name}%")
                    ->orWhere('phone', 'LIKE', "%{$name}%");
            });


            //s_status
            $qry = $qry->when($request->s_status, function ($query, $status) {
                return $query->where('is_valid',$status);

            });
            $countQry=$qry;
            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();

            if (!empty($request->get('s_name')) OR !empty($request->get('s_status'))) {

                $data['totalRecords']=$countQry->count();
            }
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }

    public function getAllCodes($request)
    {
        try {

            $qry= ProductCode::query();
            ($request->product_id)?$qry->where('p_id',$request->product_id):'';
            ($request->from_date)?$qry->whereDate('created_at','>=',$request->from_date):'';
            ($request->to_date)?$qry->whereDate('created_at','<=',$request->to_date):'';
            $data =$qry->get();
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }

    public function getAllCodesWithBatchNo($batch)
    {
        try {

            $qry= ProductCode::query();
            $qry->where('batch_no',$batch);
            $data =$qry->get();
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }

    public function getMessageList($request)
    {
        try {
            $data['totalRecords'] = TextMessage::count();
            $qry= TextMessage::query();


            $qry=$qry->when($request->s_name, function ($query, $name) {
                return $query->where('name', 'LIKE', "%{$name}%");
            });


            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();

            if (!empty($request->get('s_name'))) {

                $data['totalRecords']=$qry->count();
            }
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }

    public function findTextMessageById($id)
    {
        try {
            $res = TextMessage::find($id);
            return Helper::success($res, $message='Record found');
        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        }
    }

    public function createTextMessage($request)
    {

        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'valid_message' => 'required',
                'invalid_message' => 'required',

            ]);
            if ($validator->fails())
                return Helper::errorWithData($validator->errors()->first(), $validator->errors());


                    $textMessage=TextMessage::first();
                    $textMessage->valid_message =$request->valid_message;
                    $textMessage->in_valid_message = $request->invalid_message;
                    $textMessage->verified_message = $request->verified_message;
                    $textMessage->save();

//            $role = TextMessage::updateOrCreate(
//                [
//                    'id' => $request->id
//                ],
//                [
//                    'valid_message' => $request->valid_message,
//                    'in_valid_message' => $request->invalid_message,
//                    'verified_message' => $request->verified_message,
//
//                ]
//            );

             $message =__('translation.record_updated');
            DB::commit();


            return Helper::success($textMessage, $message);
        } catch (ValidationException $validationException) {
            DB::rollBack();
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            DB::rollBack();
            return Helper::errorWithData($e->getMessage(),[]);
        }
    }



}
