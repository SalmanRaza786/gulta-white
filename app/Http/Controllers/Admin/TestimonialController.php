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
             $request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'review_message' => 'required|string|max:250',

            ]);
            if ($validator->fails()){
                return redirect()->back()->with('error',$validator->errors()->first());
            }

            $res = $this->testimonials->updateOrCreate($request,0);
            if (!$res->get('status')){
                return redirect()->back()->with('error',$res->get('message'));

            }
            return redirect()->back()->with('success',$res->get('message'));
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
