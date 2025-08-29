<?php

namespace App\Http\Controllers;
use App\Http\Helpers\Helper;
use App\Models\AttemptCode;
use App\Models\ProductCode;
use App\Models\Testimonial;
use App\Models\TextMessage;
use App\Models\User;
use App\Repositries\category\CategoryInterface;
use App\Repositries\product\ProductInterface;
use App\Repositries\testimonials\TestimonialsInterface;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use function Brotli\compress_add;
use function PHPUnit\Framework\returnArgument;

class HomeController extends Controller
{
    private $cat;
    private $product;
    private $testimonials;

    public function __construct(CategoryInterface $cat,ProductInterface $product,TestimonialsInterface $testimonials)
    {
        $this->cat = $cat;
        $this->product = $product;
        $this->testimonials = $testimonials;
    }


    public function index()
    {
        try {

            $data['totalAttempts']=3;
            $data['homeImage']=TextMessage::pluck('home_image')->first();
            $data['testimonials']=Helper::fetchOnlyData($this->testimonials->getAllTestimonials());
          return view('web.index')->with(compact('data'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function codeVerify(Request $request)
    {
        try {
        $request->all();
        if($request){
            $textMessage=TextMessage::first();
       if(!$pCode= ProductCode::where('p_codes',$request->p_code)->first()){
           $attempt = AttemptCode::updateOrCreate(
               [
                   'id' => 0
               ],
               [
                   'name' => $request->name,
                   'phone' => $request->phone,
                   'p_code' => $request->p_code,
                   'is_valid' => 2,

               ]
           );
           return redirect()->back()->with('error',$textMessage?$textMessage->in_valid_message:'');

       }

       if($pCode->is_verify=='Verify'){
          $client= AttemptCode::with('pCode.product')->where('p_code',$request->p_code)->first();
           return redirect()->back()->with('client', $client)->with('error', $textMessage?$textMessage->verified_message:'Your code is already verified by');


       }

            $attempt = AttemptCode::updateOrCreate(
                [
                    'id' => 0
                ],
                [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'p_code' => $request->p_code,
                    'is_valid' => 1,
                    'p_id' => $pCode->p_id,
                ]
            );


            ProductCode::where('p_codes',$request->p_code)->update(['is_verify'=>1]);
            $client= AttemptCode::with('pCode.product')->where('p_code',$request->p_code)->first();
            return redirect()->back()->with('success', $textMessage?$textMessage->valid_message:'Your code is valid, verify successfully')->with('client', $client);


        }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function customLogout()
    {
        try {

            Auth::logout();
            Session::flush();
            return redirect()->route('admin.login.view');



        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function gallery()
    {
        try {

            return view('web.gallery');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function blogs()
    {
        try {

            return view('web.blogs');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function contactUs()
    {
        try {

            return view('web.contact-us');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function aboutUs()
    {
        try {

            return view('web.index');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function faqs()
    {
        try {

            return view('web.faqs');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



}
