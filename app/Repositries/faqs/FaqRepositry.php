<?php

namespace App\Repositries\faqs;

use App\Http\Helpers\Helper;
use App\Models\Faq;
use App\Models\Role as CustomRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use DataTables;



class FaqRepositry implements FaqInterface
{
    public function updateOrCreate($request,$id)
    {

        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'question' => 'required|string|max:255',
                'ans' => 'required|string|max:255',
            ]);
            if ($validator->fails())
                return Helper::errorWithData($validator->errors()->first(), $validator->errors());

            $role = Faq::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'questions' => $request->question,
                    'ans' => $request->ans,

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


    public function getFaqsList($request)
    {
        try {
            $data['totalRecords'] = Faq::count();
            $qry= Faq::query();


            $qry=$qry->when($request->s_name, function ($query, $name) {
                return $query->where('questions', 'LIKE', "%{$name}%");
            });


            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();


            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }
    public function deleteFaqs($id)
    {
        try {
            $role = Faq::find($id);
            $role->delete();
            return Helper::success($role, $message=__('translation.record_deleted'));
        } catch (ValidationException $validationException) {
            DB::rollBack();
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        }

    }

    public function getAllFaqs()
    {
        try {

            $qry= Faq::query();
            $data =$qry->orderByDesc('id')->get();
            return Helper::success($data, $message="Record found");

        }catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }

}
