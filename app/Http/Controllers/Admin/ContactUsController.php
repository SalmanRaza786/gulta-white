<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Repositries\contact\ContactInterface;
use App\Repositries\testimonials\TestimonialsInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    private $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    public function index()
    {
        try {

            return view('admin.reviews.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function storeContactUs(Request $request)
    {

        try {
            $request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',

            ]);
            if ($validator->fails()){
                return redirect()->back()->with('error',$validator->errors()->first());
            }

            $res = $this->contact->updateOrCreate($request,0);
            if (!$res->get('status')){
                return redirect()->back()->with('error',$res->get('message'));

            }
            return redirect()->back()->with('success',$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }
}
