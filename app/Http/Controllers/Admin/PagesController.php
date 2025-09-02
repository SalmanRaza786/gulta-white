<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Models\Faq;
use App\Models\PagesContent;
use App\Models\PagesContentMedia;
use App\Repositries\pages\PagesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    private $pages;

    public function __construct(PagesInterface $pages)
    {
        $this->pages = $pages;
    }

    public function index()
    {

        try {
            return view('admin.pages.index');
        } catch (\Exception $e) {
            return $e->getMessage();

        }
    }

    //create
    public function create()
    {

        try {
            return view('admin.pages.create');
        } catch (\Exception $e) {
            return $e->getMessage();

        }
    }

    //storePages
    public function storePages(Request $request)
    {

        try {
            $request->all();
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'page_type' => 'required',
                'description' => 'required',
                'images.*'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=1024,height=768',
            ],
                [
                    'images.*.dimensions' => 'Images dimensions must be 1024x768.',
                ]
            );
            if ($validator->fails()) {
                return Helper::errorWithData($validator->errors()->first(), $validator->errors());
            }

            return $this->pages->updateOrCreatePage($request, $request->id);

        } catch (\Exception $e) {
            return $e->getMessage();

        }
    }
    public function pagesList(Request $request)
    {
        try {
            $res = $this->pages->getPagesList($request);

            $acStatement = collect([]);
         if(count($res['data']['data'])==0){
             return Helper::ajaxDatatable($res['data']['data'], $res['data']['totalRecords'], $request);
         }
            foreach ($res['data']['data'] as $row) {
                $array = array(
                    'id' => $row->id,
                    'title' => $row->title,
                    'description' =>strip_tags($row->description),
                    'page_type' =>strtoupper($row->page_type),
                );
                $acStatement->push($array);

            }
            return Helper::ajaxDatatable($acStatement, $res['data']['totalRecords'], $request);
        }
        catch(\Exception $e) {
                return Helper::ajaxError($e->getMessage());
            }

}

    public function deletePage(Request $request)
    {
        try {
            $id=$request->id;
            if(!PagesContent::find($id)){
                return Helper::error('Invalid page id');
            }
            $res = $this->pages->deletePage($id);
            return Helper::ajaxSuccess($res->get('data'),$res->get('message'));
        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    //editPage
    public function editPage(Request $request)
    {
        try {

            $id=$request->id;
            if(!PagesContent::find($id)){
                return Helper::error('Invalid page id');
            }
            $data['editPage'] =Helper::fetchOnlyData($this->pages->findPageById($id));
            return view('admin.pages.create')->with(compact('data'));

        } catch (\Exception $e) {
            return Helper::ajaxError($e->getMessage());
        }
    }

    public function deleteMedia(Request $request)
    {
        try {
            $media = PagesContentMedia::find($request->id);
            if (!$media) {
              return Helper::error('Invalid image id');
            }
            $media->delete();
            return Helper::success([],'Delete media successfully');

        } catch (\Exception $e) {
            return Helper::error($e->getMessage());
        }
    }

}
