<?php

namespace App\Repositries\pages;

use App\Http\Helpers\Helper;
use App\Models\Category;
use App\Models\PagesContent;
use App\Models\PagesContentMedia;
use App\Models\Product;
use App\Traits\HandleFiles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use DataTables;


class PagesRepositry implements PagesInterface
{
    protected $mediaPath = 'pages-media/';
    protected $mediaName = "";
    use HandleFiles;
    public function updateOrCreatePage($request,$id)
    {

        try {
            DB::beginTransaction();
            $page = PagesContent::updateOrCreate(
                [
                    'id' => $id,
                     'page_type' => $request->page_type
                ],
                [
                    'title' => $request->title,
                    'page_type' => $request->page_type,
                    'description' => $request->description,

                ]
            );
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $file) {
                    $this->mediaName = $this->handleFiles($file, $this->mediaPath.'/');
                    $res = Helper::storeMedia('App\Models\PagesContent',$page->id,$this->mediaName,'image');
                }
            }
            ($id==0)?$message = __('translation.record_created'): $message =__('translation.record_updated');
            DB::commit();


            return Helper::success($page, $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return Helper::errorWithData($e->getMessage(),[]);
        }
    }
    public function getPagesList($request)
    {
        try {
            $data['totalRecords'] = PagesContent::count();
            $qry= PagesContent::query();
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
            $role = PagesContent::find($id);
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
             $res = PagesContent::with('pageMedia')->find($id);
            return Helper::success($res, $message='Record found');
            } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
             }
    }
    public function findPageByType($pageType)
    {
        try {
            $res = PagesContent::with('pageMedia')->where('page_type',$pageType)->latest('id')->get();
            return Helper::success($res, $message='Record found');
        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        }
    }


}
