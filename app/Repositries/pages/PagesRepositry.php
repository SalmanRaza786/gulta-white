<?php

namespace App\Repositries\pages;

use App\Http\Helpers\Helper;
use App\Models\Category;
use App\Models\Product;
use App\Traits\HandleFiles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use DataTables;


class PagesRepositry implements PagesInterface
{
    protected $categoryFilePath = 'product-media/';
    protected $categoryFileName = "";
    use HandleFiles;
    public function updateOrCreatePage($request,$id)
    {

        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'cat_id' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
            if ($validator->fails())
                return Helper::errorWithData($validator->errors()->first(), $validator->errors());

            if($request->file('product_image')){
                $this->categoryFileName = $this->handleFiles($request->file('product_image'), $this->categoryFilePath);
            }

            $role = Product::updateOrCreate(
                [
                    'id' => $id
                ],
                [
                    'cat_id' => $request->cat_id,
                    'title' => $request->title,
                    'price' => $request->price,
                    'description' => $request->description,
                    'thumbnail' => $this->categoryFileName,

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
    public function getPagesList($request)
    {
        try {
            $data['totalRecords'] = Product::count();
            $qry= Product::query();
            $qry=$qry->with('category');
            $qry=$qry->when($request->s_title, function ($query, $title) {
                return $query->where('name',$title);
            });
            $qry=$qry->when($request->s_status, function ($query, $s_status) {
                return $query->where('status',$s_status);
            });

            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();

            if (!empty($request->get('s_title')) OR !empty($request->get('s_status')) ) {

                $qry= Product::query();
                $qry=$qry->when($request->s_title, function ($query, $title) {
                    return $query->where('name',$title);
                });
                $qry=$qry->when($request->s_status, function ($query, $s_status) {
                    return $query->where('status',$s_status);
                });
                $data['totalRecords']=$qry->count();
            }
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }
    public function deletePage($id)
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
    public function findPageById($id)
    {
        try {
             $res = Product::with('category.products')->find($id);
            return Helper::success($res, $message='Record found');
            } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
             }
    }

}
