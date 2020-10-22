<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //

    public function index()
    {
        $tags = Tag::paginate(env('PAGINATE_COUNT'));

        return view('admin.tags.tags')->with(
            ['tags' => $tags]
        );
    }
}
