<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositries\pages\PagesInterface;
use Illuminate\Http\Request;

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
}
