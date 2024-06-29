<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MartController extends Controller
{

    public function index(){
        return view('frontend.mart');
    }
}
