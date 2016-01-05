<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use Validator, Carbon;
use nee_portal\Models\ChallanInfo;

class PaymentController extends Controller
{
    private $content = 'candidate.application.';

    public function challanDetail(Request $request){

            $validator =Validator::make($data = $request->all(), ChallanInfo::$rules);

            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $transaction_id=$data['transaction_id'];
            $date=$data['transaction_date'];
            $date=Carbon::createFromFormat('d-m-Y', $date);
            $transaction_date=$date->format('Y-m-d');

            $challan_info=ChallanInfo::where('transaction_id', $transaction_id)->where('transaction_date', $transaction_date)->first();

            if(count($challan_info)){

                $candidate_info=CandidateInfo::where('id', $this->info_id)->first();
                $candidate_info->reg_status='completed';

                $candidate_info->save();

                return $this->getStep();
            }

            return redirect()->route($this->content.'challan')->withErrors('Dear Candidate the Transaction ID and Transaction Date provided by you does not match!');
    }
}
