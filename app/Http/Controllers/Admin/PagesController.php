<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Repositries\pages\PagesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    private $pages;
    public function __construct(PagesInterface $pages) {
        $this->pages = $pages;
    }

    public function index(){

        try {
            return view('admin.pages.index');
        }catch (\Exception $e) {
        return $e->getMessage();

        }
    }

    //create
    public function create(){

        try {
            return view('admin.pages.create');
        }catch (\Exception $e) {
            return $e->getMessage();

        }
    }
    //storePages
    public function storePages(Request $request){

        try {
             $request->all();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'page_type' => 'required',
                'description' => 'required',
            ]);
            if($validator->fails()){
                return Helper::errorWithData($validator->errors()->first(), $validator->errors());
            }

          return  $this->pages->updateOrCreatePage($request,$request->id);

        }catch (\Exception $e) {
            return $e->getMessage();

        }
    }
}
