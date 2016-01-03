<?php

namespace nee_portal\Http\Controllers\Admin;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ChallanInfo;
use Session, URL, Validator, Carbon\Carbon, File;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function challanImport(Request $request){


        if(!$request->hasFile('challan')){
            return back()->with('message', 'Please upload a file');
        }

        $filename=$request->challan->getClientOriginalName();
        $destination_path= storage_path().'/challan/';
        $path=$destination_path.$filename;
        $request->challan->move($destination_path, $filename);

        Excel::selectSheets('RECO')->load($path, function($reader){

            $results= $reader->toArray();

            foreach ($results as $key => $value) {

                $challan_info= New ChallanInfo;
                $challan_info->transaction_id= $value['tranid'];
                $date= $value['trandate'];

                if($challan_info->transaction_id !=null && $date!=null){
                    
                    $challan_info->transaction_date = Carbon::createFromFormat('d-m-Y', $date)->toDateTimeString();
                    $data=ChallanInfo::where('transaction_id', $challan_info->transaction_id)->first();

                    $challan_info->save();   
                }
                
            }

        });

        return back()->with('message', 'File upload successfully!');

    }
}
