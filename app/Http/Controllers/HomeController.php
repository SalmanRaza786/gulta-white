<?php

namespace App\Http\Controllers;
use App\Http\Helpers\Helper;
use App\Models\AttemptCode;
use App\Models\ProductCode;
use App\Models\Testimonial;
use App\Models\TextMessage;
use App\Models\User;
use App\Repositries\category\CategoryInterface;
use App\Repositries\faqs\FaqInterface;
use App\Repositries\pages\PagesInterface;
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
    private $pages;
    private $faqs;

    public function __construct(CategoryInterface $cat,ProductInterface $product,TestimonialsInterface $testimonials,PagesInterface $pages,FaqInterface $faqs)
    {
        $this->cat = $cat;
        $this->product = $product;
        $this->testimonials = $testimonials;
        $this->pages= $pages;
        $this->faqs= $faqs;
    }


    public function index(Request $request)
    {
        try {

            $data['homeImage']=TextMessage::pluck('home_image')->first();
            $data['testimonials']=Helper::fetchOnlyData($this->testimonials->getAllTestimonials());
            $data['totalAttempts']=0;
            if($request->isMethod('post')) {

                    $textMessage = TextMessage::first();


                    if (!$pCode = ProductCode::where('p_codes', $request->p_code)->where('is_enable',1)->first()) {
                        Helper::saveAttemptCode($request->name, $request->phone, $request->p_code, 2, null);
                        $data['totalAttempts']=AttemptCode::where('p_code',$request->p_code)->count();
                        $data['error'] = $textMessage ? $textMessage->in_valid_message : '';
                        return view('web.index')->with(compact('data'));
                    }

                    if ($pCode->is_verify == 'Verify') {
                        Helper::saveAttemptCode($request->name, $request->phone, $request->p_code, 2, null);
                        $data['client'] = AttemptCode::with('pCode.product')->where('p_code', $request->p_code)->first();
                        $data['totalAttempts']=AttemptCode::where('p_code',$request->p_code)->count();
                        $data['error'] = $textMessage ? $textMessage->verified_message : 'Your code is already verified by';
                        return view('web.index')->with(compact('data'));
                    }

                    Helper::saveAttemptCode($request->name, $request->phone, $request->p_code, 1, $pCode->p_id);
                    $data['totalAttempts']=AttemptCode::where('p_code',$request->p_code)->count();

                    ProductCode::where('p_codes', $request->p_code)->update(['is_verify' => 1]);
                    $data['success']= $textMessage?$textMessage->valid_message:'Your code is valid, verify successfully';
                    $data['client'] = AttemptCode::with('pCode.product')->where('p_code', $request->p_code)->first();
                    return view('web.index')->with(compact('data'));

            }

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
        $data['gallery']=Helper::fetchOnlyData($this->pages->findPageByType('gallery'));
            return view('web.gallery')->with(compact('data'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //userPageDetail
    public function userPageDetail(Request $request)
    {
        try {
            $id=decrypt($request->id);
            $data['pageDetail']=Helper::fetchOnlyData($this->pages->findPageById($id));
            return view('web.page-detail')->with(compact('data'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function blogs()
    {
        try {
            $data['blogs']=Helper::fetchOnlyData($this->pages->findPageByType('blog'));
            return view('web.blogs')->with(compact('data'));

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
            $data['aboutUs']=Helper::fetchOnlyData($this->pages->findPageByType('about'));
            return view('web.about-us')->with(compact('data'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function faqs()
    {
        try {
            $data['faqs']=Helper::fetchOnlyData($this->faqs->getAllFaqs());
            return view('web.faqs')->with(compact('data'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



}
