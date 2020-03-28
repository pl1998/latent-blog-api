<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SpaController extends Controller
{
    //
    public function index()
    {

        return view('index');
    }

    public function loading()
    {
        return view('loading');
    }
}
