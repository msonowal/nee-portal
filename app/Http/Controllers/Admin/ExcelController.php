<?php

namespace nee_portal\Http\Controllers\Admin;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ChallanInfo;
use Session, URL, Validator, Carbon\Carbon, File, Basehelper;
use Maatwebsite\Excel\Facades\Excel;
use nee_portal\Models\CandidateInfo;


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

                    $data=ChallanInfo::where('transaction_id', $value['tranid'])
                                     ->where('transaction_date', $value['trandate'])
                                     ->get();

                    if(count($data) == 0){
                        $challan_info   = New ChallanInfo;
                        $challan_info->branch_id  = $value['brid'];
                        $challan_info->branch_name  = $value['brname'];
                        $challan_info->trans_type  = $value['trantype'];
                        $challan_info->amount  = $value['amount'];
                        $challan_info->amount  = $value['amount'];
                        $challan_info->transaction_id  = $value['tranid'];
                        $challan_info->transaction_date = date('Y-m-d', strtotime($value['trandate']));
                        $challan_info->save();                        
                    }
                }
            }
        });
        return back()->with('message', 'File processed successfully!');
    }

    public function allCompleted()
    {
        $results =CandidateInfo::join('candidates', 'candidates.id', '=', 'candidate_info.candidate_id')
                               ->join('step1', 'step1.candidate_info_id', '=', 'candidate_info.id')
                               ->join('step2', 'step2.candidate_info_id', '=', 'candidate_info.id') 
                               ->join('step3', 'step3.candidate_info_id', '=', 'candidate_info.id')
                               ->join('orders', 'orders.candidate_info_id', '=', 'candidate_info.id')
                               ->where('orders.status', 'SUCCESS')
                               ->where('candidate_info.reg_status', 'completed')
                               ->select('step2.name as NAME', 'candidate_info.exam_id as EXAM', 'candidate_info.form_no as FORM_NO')
                               ->get();

        foreach ($results as $result => $res)
        {
           $results[$result]['EXAM']= Basehelper::getExam($res->EXAM);
        } 

        $this->generateExcel($results, 'xlsx');                          
    } 

    private function generateExcel($results, $ext = 'xlsx', $part_name=''){


            Excel::create('CandidateInfo '.date('d_m_Y g_i_a').' '.$part_name, function($excel) use($results) {
                $excel->setTitle('Students Info as on '.date('d_m_Y g_i_a'));
                $excel->setCreator('NEE')
                      ->setCompany('Zantrik Technologies Private Limited');
                $excel->setDescription('Candidate informations');
                $excel->sheet('Sheet1', function($sheet) use($results) {
                    $sheet->freezeFirstRow();
                    $sheet->cells('A1:AG1', function($cells) {
                        $cells->setFontSize(12);
                        $cells->setFontWeight('bold');
                    });
                $sheet->setAutoFilter('A1:AG1');
                $sheet->row(1, function($row) {
                    $row->setBackground('#99CCFF');
                });
                $sheet->fromArray($results);
                });
            })->download($ext);

    }                          

}
