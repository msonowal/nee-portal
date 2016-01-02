<?php

namespace nee_portal\Http\Controllers\Admin;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ChallanInfo;
use Session, URL, Validator, Excel;

class AdminController extends Controller
{
    private $content='admin.';

    public function challan()
    {
        $result=ChallanInfo::paginate();

        $paginator=0;

        $paginator=$result->currentPage();

        Session::put('url', URL::full());

        return view($this->content.'challan.import', compact('result', 'paginator'));
    }

    public function importChallan(Request $request){


    	if(!$request->hasFile('challan')){
    		return back()->with('message', 'Please upload a file');
    	}

    	$file=$request->challan;


    	//dd($file);

    	Excel::load($file, function($reader) {

    		   $results = $reader->all();

    		   //Excel::selectSheets('Sheet1')->load($file)->get;
    		 //$reader->first();
    		   $reader->dd();


		});

		//Excel::selectSheets('RECO')->load();

    }

}
