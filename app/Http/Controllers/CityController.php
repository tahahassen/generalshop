<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function index()
    {
        $cities = City::paginate(env('PAGINATE_COUNT'));

        return view('admin.cities.cities')->with(
            ['cities' => $cities]
        );
    }
}
