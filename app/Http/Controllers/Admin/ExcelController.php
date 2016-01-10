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

        if(!$request->hasFile('challan'))
            return back()->with('message', 'Please upload a file');

        $filename=$request->challan->getClientOriginalName();
        $destination_path= storage_path().'/challan/';
        $path=$destination_path.$filename;
        $request->challan->move($destination_path, $filename);

        Excel::selectSheets('RECO')->load($path, function($reader){
            $results= $reader->toArray();

            foreach ($results as $key => $value) {

                if($value['tranid'] !=null && $value['trandate']!=null){

                    $data=ChallanInfo::where('transaction_id', $value['tranid'])->get();

                    if(count($data) == 0){
                        $challan_info   = New ChallanInfo;
                        $challan_info->transaction_id  = $value['tranid'];
                        $challan_info->transaction_date = date('Y-m-d', strtotime($value['trandate']));
                        $challan_info->save();                        
                    }
                }
            }
        });
        return back()->with('message', 'File processed successfully!');
    }
}
