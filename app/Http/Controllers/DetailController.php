<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index()
    {
        $product = Detail::all();
        return view('frontend.pages.index', get_defined_vars());
    }

    public function create(){
        //
    }
}
