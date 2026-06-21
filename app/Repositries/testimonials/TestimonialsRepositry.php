<?php

namespace App\Repositries\testimonials;

use App\Http\Helpers\Helper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use DataTables;


class TestimonialsRepositry implements TestimonialsInterface
{
    use ImageUploadTrait;

    public function updateOrCreate($request, $id)
    {
        try {
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = $this->uploadImage($request->file('image'), 'reviews');
            }

            $data = [
                'name'           => $request->name,
                'email'          => $request->email,
                'review_message' => $request->review_message,
            ];

            if ($imageName) {
                $data['image'] = $imageName;
            }

            $review = Testimonial::updateOrCreate(
                ['email' => $request->email],
                $data
            );

            return Helper::success($review, 'Your review has been received. It will be published once approved by our team.');
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(), []);
        }
    }

    public function getTestimonials($request)
    {
        try {
            $data['totalRecords'] = Testimonial::count();
            $qry= Testimonial::query();

            $qry=$qry->when($request->s_title, function ($query, $title) {
                return $query->where('name',$title);
            });
            $qry=$qry->when($request->s_status, function ($query, $s_status) {
                return $query->where('status',$s_status);
            });

            $qry=clone $qry;
            $qry=$qry->when($request->start, fn($q)=>$q->offset($request->start));
            $qry=$qry->when($request->length, fn($q)=>$q->limit($request->length));
            $data['data'] =$qry->orderByDesc('id')->get();

            if (!empty($request->get('s_title')) OR !empty($request->get('s_status')) ) {

                $data['totalRecords']=$qry->count();
            }
            return Helper::success($data, $message="Record found");

        } catch (ValidationException $validationException) {
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        } catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }
    public function deleteTestimonials($id)
    {
        try {
            $role = Testimonial::find($id);
            $role->delete();
            return Helper::success($role, $message=__('translation.record_deleted'));
        } catch (ValidationException $validationException) {
            DB::rollBack();
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        }

    }

    public function getAllTestimonials($isPublish=null)
    {
        try {

            $qry= Testimonial::query();
            ($isPublish)?$qry->where('is_published',$isPublish):'';
            $data =$qry->get();
            return Helper::success($data, $message="Record found");
        }  catch (\Exception $e) {
            return Helper::errorWithData($e->getMessage(),[]);
        }

    }
    public function updateTestimonialStatus($id,$isPublish)
    {
        try {
            $role = Testimonial::find($id);
            $role->is_published=$isPublish;
            $role->save();
            return Helper::success($role,'Record update successfully');
        } catch (ValidationException $validationException) {
            DB::rollBack();
            return Helper::errorWithData($validationException->errors()->first(), $validationException->errors());
        }

    }


}
