<?php

namespace nee_portal\Http\Controllers;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    public function index()
    {

    	//return ' -- UNDER CONSTRUCTION -- ';
        //return view('layouts.frontend');
        return view('layouts.index');
    }

}
