<?php

namespace App\Http\Controllers;
use App\Http\Helpers\Helper;
use App\Models\AttemptCode;
use App\Models\ProductCode;
use App\Models\TextMessage;
use App\Models\User;
use App\Repositries\category\CategoryInterface;
use App\Repositries\product\ProductInterface;
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

    public function __construct(CategoryInterface $cat,ProductInterface $product)
    {
        $this->cat = $cat;
        $this->product = $product;
    }


    public function index()
    {
        try {

          return view('index');

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



}
