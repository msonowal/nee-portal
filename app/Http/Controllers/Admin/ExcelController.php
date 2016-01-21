<?php

namespace nee_portal\Http\Controllers\Admin;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\ChallanInfo;
use Session, URL, Validator, Carbon\Carbon, File, Basehelper;
use Maatwebsite\Excel\Facades\Excel;
use nee_portal\Models\CandidateInfo;
use nee_portal\Models\Exam;
use nee_portal\Models\Quota;
use nee_portal\Models\Reservation;
use nee_portal\Models\State;
use nee_portal\Models\District;
use nee_portal\Models\Branch;
use nee_portal\Models\AlliedBranch;
use nee_portal\Models\VocationalSubject;
use nee_portal\Models\Centre;
use nee_portal\Models\Qualification;
use nee_portal\Models\ExamDetail;


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
                               ->select('step2.name as NAME', 'candidate_info.exam_id as EXAM', 'candidate_info.form_no as FORM_NO', 'candidate_info.id as REGISTRATION_NO', 'candidate_info.rollno as ROLL_NO', 'step1.quota as QUOTA', 'step1.reservation_code as RESERVATION_CODE', 'step1.reservation_code as CATEGORY', 'step1.nerist_stud as NERIST_STUDENT', 'candidate_info.q_id as ELIGIBILITY', 'candidate_info.qualification_status as ELIGIBILITY_STATUS', 'step1.admission_in as FOR_ADMISSION_IN', 'step1.voc_subject as VOCATIONAL_SUBJECT', 'step1.branch as BRANCH', 'step1.allied_branch as BRANCH_SUBJECT', 'step1.c_pref1 as CENTRE_PREF1', 'step1.c_pref2 as CENTRE_PREF2', 'candidate_info.paper_code as PAPER_CODE', 'orders.trans_type as PAYMENT_METHOD', 'candidate_info.id as AMOUNT', 'step2.father_name as FATHER_NAME', 'step2.guardian_name as GUARDIAN_NAME', 'step1.gender as GENDER', 'step2.nationality as NATIONALITY', 'step1.dob as DOB', 'candidates.mobile_no as MOBILE_NO.', 'candidates.email as EMAIL_ID', 'step2.emp_status as ARE_YOU_EMPLOYED', 'step2.relationship as RELATIONSHIP_WITH_GUARDIAN', 'step2.state as STATE', 'step2.district as DISTRICT', 'step2.po as PO', 'step2.pin as PIN', 'step2.village as VILLAGE', 'step2.address_line')
                               ->get();

        foreach ($results as $result => $res)
        {
          $exams=Exam::all();
          $quotas=Quota::all();
          $categories=Reservation::all();
          $states=State::all();
          $districts=District::all();
          $branches=Branch::all();
          $branch_subjects=AlliedBranch::all();
          $centres=Centre::all();
          $voc_subjects=VocationalSubject::all();
          $eligibilites=Qualification::all();
          $eligibles=ExamDetail::all();

          $item = $res['EXAM'];
          if($item !=NULL)
              $results[$result]['EXAM'] = $exams->filter(function($exam) use ($item){if( $exam->id==$item ) return $exam;})->first()->exam_name;

          $item = $res['QUOTA'];
          if($item !=NULL)
              $results[$result]['QUOTA'] = $quotas->filter(function($quota) use ($item){if( $quota->id==$item ) return $quota;})->first()->name;

          $item = $res['CATEGORY'];
          if($item !=NULL)
              $results[$result]['CATEGORY'] = $categories->filter(function($category) use ($item){if( $category->reservation_code==$item ) return $category;})->first()->category_name;  

          $item = $res['STATE'];
          if($item !=NULL)
              $results[$result]['STATE'] = $states->filter(function($state) use ($item){if( $state->id==$item ) return $state;})->first()->name;

          $item = $res['DISTRICT'];
          if($item !=NULL)
              $results[$result]['DISTRICT'] = $districts->filter(function($district) use ($item){if( $district->id==$item ) return $district;})->first()->name; 

          $item = $res['BRANCH'];
          if($item !=NULL)
              $results[$result]['BRANCH'] = $branches->filter(function($branch) use ($item){if( $branch->id==$item ) return $branch;})->first()->branch_name;   

          $item = $res['BRANCH_SUBJECT'];
          if($item !=NULL)
              $results[$result]['BRANCH_SUBJECT'] = $branch_subjects->filter(function($branch_subject) use ($item){if( $branch_subject->id==$item ) return $branch_subject;})->first()->allied_branch;     

          $item = $res['CENTRE_PREF1'];
          if($item !=NULL)
              $results[$result]['CENTRE_PREF1'] = $centres->filter(function($centre) use ($item){if( $centre->centre_code==$item ) return $centre;})->first()->centre_name;       

          $item = $res['CENTRE_PREF2'];
          if($item !=NULL)
              $results[$result]['CENTRE_PREF2'] = $centres->filter(function($centre) use ($item){if( $centre->centre_code==$item ) return $centre;})->first()->centre_name;         

          $item = $res['VOCATIONAL_SUBJECT'];
          if($item !=NULL)
              $results[$result]['VOCATIONAL_SUBJECT'] = $voc_subjects->filter(function($voc_subject) use ($item){if( $voc_subject->paper_code==$item ) return $voc_subject;})->first()->name;           

          $item = $res['ELIGIBILITY'];
          if($item !=NULL)
              $results[$result]['ELIGIBILITY'] = $eligibilites->filter(function($eligibility) use ($item){if( $eligibility->id==$item ) return $eligibility;})->first()->qualification;             

          $item = $res['FOR_ADMISSION_IN'];
          if($item !=NULL)
              $results[$result]['FOR_ADMISSION_IN'] = $eligibles->filter(function($eligible_for) use ($item){if( $eligible_for->id==$item ) return $eligible_for;})->first()->eligible_for;               
          
           //$results[$result]['EXAM']= Basehelper::getExam($res->EXAM);
           //$results[$result]['QUOTA']= Basehelper::getQuota($res->QUOTA);
           //$results[$result]['CATEGORY']= Basehelper::getCategory($res->CATEGORY);
           $results[$result]['AMOUNT']=Basehelper::getPayableAmount($res->AMOUNT);
           //$results[$result]['STATE']= Basehelper::getState($res->STATE);
           //$results[$result]['DISTRICT']= Basehelper::getDistrict($res->DISTRICT);
           //$results[$result]['BRANCH']= Basehelper::getBranch($res->BRANCH);
           //$results[$result]['BRANCH_SUBJECT']= Basehelper::getAlliedBranch($res->BRANCH_SUBJECT);
           //$results[$result]['CENTRE_PREF1']= Basehelper::getCentre($res->CENTRE_PREF1);
           //$results[$result]['CENTRE_PREF2']= Basehelper::getCentre($res->CENTRE_PREF2);
           $dob=Carbon::createFromFormat('Y-m-d', $res->DOB);
           $results[$result]['DOB']=$dob->format('d-m-Y');
           $results[$result]['REGISTRATION_NO']= Basehelper::getRegistrationNo($res->REGISTRATION_NO);
           //$results[$result]['VOCATIONAL_SUBJECT']= Basehelper::getVocSubject($res->VOCATIONAL_SUBJECT);
           //$results[$result]['ELIGIBILITY']=Basehelper::getQualification($res->ELIGIBILITY);
           //$results[$result]['FOR_ADMISSION_IN']= Basehelper::getAdmissionIn($res->FOR_ADMISSION_IN);
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
                    $sheet->cells('A1:AI1', function($cells) {
                        $cells->setFontSize(12);
                        $cells->setFontWeight('bold');
                    });
                $sheet->setAutoFilter('A1:AI1');
                $sheet->row(1, function($row) {
                    $row->setBackground('#F8F8F8');
                });
                $sheet->fromArray($results);
                });
            })->download($ext);

    }                          

}
