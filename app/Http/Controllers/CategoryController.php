<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories=Category::paginate(env('PAGINATE_COUNT'));
        return view('admin.categories.categories')->with(['categories'=>$categories]);
    }
}
