<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\Faq;
use App\Repositries\faqs\FaqInterface;
use Illuminate\Http\Request;

class FAQsController extends Controller
{
    private $faq;

    public function __construct(FaqInterface $faq)
    {
        $this->faq = $faq;
    }

    public function index()
    {
        try {

            return view('admin.faqs.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function faqsList(Request $request){
        try {


            $res=Helper::fetchOnlyData($this->faq->getFaqsList($request));
            $customers = collect([]);
            foreach ($res['data'] as $row){
                $array = array(
                    'id' =>encrypt($row->id),
                    'question' =>$row->questions,
                    'ans'=>$row->ans
                );
                $customers->push($array);
            }
            return Helper::ajaxDatatable($customers, $res['totalRecords'], $request);
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }

    }

    public function updateOrCreateRecord(Request $request)
    {

        try {

            $roleUpdateOrCreate = $this->faq->updateOrCreate($request,$request->id);
            if ($roleUpdateOrCreate->get('status'))
                return Helper::ajaxSuccess($roleUpdateOrCreate->get('data'),$roleUpdateOrCreate->get('message'));
            return Helper::ajaxErrorWithData($roleUpdateOrCreate->get('message'), $roleUpdateOrCreate->get('data'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }


    public function deleteFaqs(Request $request)
    {
        try {
            $id=decrypt($request->id);
            if(!Faq::find($id)){
                return Helper::error('Invalid faq id');
            }
            $res = $this->faq->deleteFaqs($id);
            return Helper::ajaxSuccess($res->get('data'),$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    //showFaqClientSide
    public function showFaqClientSide()
    {
        try {

            $data['faqs']=Helper::fetchOnlyData($this->faq->getAllFaqs());
            return view('admin.faqs.clientFaqs')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }
}
