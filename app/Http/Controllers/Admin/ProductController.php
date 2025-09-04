<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\Product;
use App\Models\ProductCode;
use App\Models\Testimonial;
use App\Repositries\generator\GeneratorInterface;
use App\Repositries\roles\RoleInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ProductController extends Controller
{

    private $generator;

    public function __construct(GeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function index()
    {
        try {

            return view('generator.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function saveProduct(Request $request)
    {

        try {

            $roleUpdateOrCreate = $this->generator->updateOrCreate($request,$request->id);
            if ($roleUpdateOrCreate->get('status'))
                return Helper::ajaxSuccess($roleUpdateOrCreate->get('data'),$roleUpdateOrCreate->get('message'));
            return Helper::ajaxErrorWithData($roleUpdateOrCreate->get('message'), $roleUpdateOrCreate->get('data'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }
    //productCodeGift
    public function productCodeGift(Request $request)
    {

        try {
             $request->all();
            $roleUpdateOrCreate = $this->generator->updateOrCreateGift($request,$request->gift_id);
            if ($roleUpdateOrCreate->get('status'))
                return Helper::ajaxSuccess($roleUpdateOrCreate->get('data'),$roleUpdateOrCreate->get('message'));
            return Helper::ajaxErrorWithData($roleUpdateOrCreate->get('message'), $roleUpdateOrCreate->get('data'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    public function productList(Request $request)
    {

        try {
            $res=$this->generator->getProducts($request);
            return Helper::ajaxDatatable($res['data']['data'], $res['data']['totalRecords'],$request);
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    public function editProduct(Request $request)
    {
        try {
            $res= $this->generator->findProductById($request->id);
            if($res->get('data')){
                return Helper::ajaxSuccess($res->get('data'),$res->get('message'));
            }else{
                return Helper::ajaxError('Record not found');
            }
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }
    public function deleteProduct(Request $request)
    {
        try {
            if(!Product::find($request->id)){
                return Helper::error('Invalid  id');
            }
            $res = $this->generator->deleteProduct($request->id);
            return Helper::ajaxSuccess($res->get('data'),$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    public function pCodes()
    {
        try {
        $data['products']=Helper::fetchOnlyData($this->generator->getAllProducts());
            return view('generator.p-codes')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function pCodesCreate(Request $request)
    {
        try {
             $request->all();
             $res=$this->generator->createPCodes($request);
            return Helper::ajaxSuccess($res->get('data'),$res->get('message'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }
    //pCodesCreate

    public function pCodesList(Request $request)
    {

        try {
            $res=$this->generator->getPCodes($request);
            return Helper::ajaxDatatable($res['data']['data'], $res['data']['totalRecords'],$request);
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    //attemptCodeList
    public function attemptCodeList(Request $request)
    {

        try {
            $res=$this->generator->attemptCodeList($request);
            return Helper::ajaxDatatable($res['data']['data'], $res['data']['totalRecords'],$request);
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }


    //attemptCodes
    public function attemptCodes()
    {
        try {

            return view('generator.attempt-code');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    public function codePrint(Request $request)
    {
        try {
            $data['codes']=Helper::fetchOnlyData($this->generator->getAllCodes($request));
            $data['products']=Helper::fetchOnlyData($this->generator->getAllProducts());
            return view('generator.print-code')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    //printCodeBatch
    public function printCodeBatch($batch)
    {
        try {
            $data['codes']=Helper::fetchOnlyData($this->generator->getAllCodesWithBatchNo($batch));
            $data['products']=Helper::fetchOnlyData($this->generator->getAllProducts());
            return view('generator.print-code')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    //messageIndex
    public function messageIndex(Request $request)
    {
        try {
            $data['appSetting']=Helper::fetchOnlyData($this->generator->getMessageList($request));
            return view('generator.message-index')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    //messageList
    public function messageList(Request $request)
    {

        try {
            $res=$this->generator->getMessageList($request);
            return Helper::ajaxDatatable($res['data']['data'], $res['data']['totalRecords'],$request);
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    public function editTextMessage(Request $request)
    {
        try {
            $res= $this->generator->findTextMessageById($request->id);
            if($res->get('data')){
                return Helper::ajaxSuccess($res->get('data'),$res->get('message'));
            }else{
                return Helper::ajaxError('Record not found');
            }
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    public function updateTextMessage(Request $request)
    {
        try {
            $request->all();
            $res=$this->generator->createTextMessage($request);
            if(!$res->get('status')){
                return Helper::error($res->get('message'));
            }
            return Helper::ajaxSuccess($res->get('data'),$res->get('message'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function publishPCode(Request $request)
    {
        try {
            $id=($request->id);
            if(!ProductCode::find($id)){
                return Helper::error('Invalid review id');
            }
            $res = $this->generator->updatePCodeEnableStatus($id,$request->isPublish);
            if(!$res->get('status')){
                return Helper::error($res->get('message'));
            }
            return Helper::ajaxSuccess([],$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }
    public function deletePCode(Request $request)
    {
        try {
            $id=($request->id);
            if(!ProductCode::find($id)){
                return Helper::error('Invalid Product code id');
            }
              $res = $this->generator->deletePCode($id);
            return Helper::ajaxSuccess($res->get('data'),$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }



}
