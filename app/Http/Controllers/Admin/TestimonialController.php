<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Repositries\testimonials\TestimonialsInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    private $testimonials;

    public function __construct(TestimonialsInterface $testimonials)
    {
        $this->testimonials = $testimonials;
    }

    public function index()
    {
        try {

            return view('admin.reviews.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function updateOrCreateRecord(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'           => 'required',
                'email'          => 'required|email',
                'review_message' => 'required|string|max:250',
                'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            if ($validator->fails()) {
                return Helper::ajaxError($validator->errors()->first());
            }

            $res = $this->testimonials->updateOrCreate($request, 0);
            if (!$res->get('status')) {
                return Helper::ajaxError($res->get('message'));
            }
            return Helper::ajaxSuccess($res->get('data'), $res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    public function reviewsList(Request $request){
        try {

            $res=Helper::fetchOnlyData($this->testimonials->getTestimonials($request));
            return Helper::ajaxDatatable($res['data'], $res['totalRecords'], $request);

        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }

    }

    public function publishReview(Request $request)
    {
        try {
            $id=($request->id);
            if(!Testimonial::find($id)){
                return Helper::error('Invalid review id');
            }
            $res = $this->testimonials->updateTestimonialStatus($id,$request->isPublish);
            if(!$res->get('status')){
                return Helper::error($res->get('message'));
            }
            return Helper::ajaxSuccess([],$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }
    public function deleteReview(Request $request)
    {
        try {
            $id=($request->id);
            if(!Testimonial::find($id)){
                return Helper::error('Invalid faq id');
            }
            $res = $this->testimonials->deleteTestimonials($id);
            return Helper::ajaxSuccess($res->get('data'),$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }
}
