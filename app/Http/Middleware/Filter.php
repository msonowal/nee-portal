<?php

namespace nee_portal\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth, Session, Input, Carbon\Carbon;
use nee_portal\Models\CandidateInfo;

class Filter
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $filter;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $filter)
    {
        $this->filter = Auth::candidate();
        $this->info_id = Session::get('candidate_info_id');
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!$this->filter->guest()) {

          $current_date=Carbon::today();
          $closing_date="2016-03-07 00:00:00";
          $challan_vrf_date="2016-03-15 00:00:00";

          if($current_date > $closing_date){
            $candidate= CandidateInfo::where('id', $this->info_id)->firstOrFail();
            $reg_status=$candidate->reg_status;

            if($reg_status=="not_submitted")
                return redirect()->route('candidate.application.dashboard')->withErrors(array('message'=>'Form Submission Process has been closed!'));

            if($reg_status=="payment_pending")
            {
               if(!empty(Input::get('payment_option'))){
                   $payment_option=Input::get('payment_option');

                if($payment_option!="challan")
                     return redirect()->route('candidate.application.payment_options')->withErrors(array('message'=>'Online payment process has been closed!'));  
                }
                
            }
          }

          if($current_date > $challan_vrf_date)
          {
              $candidate= CandidateInfo::where('id', $this->info_id)->firstOrFail();
              $reg_status=$candidate->reg_status;

              if($reg_status!="completed"){
                    return redirect()->route('candidate.application.dashboard')->withErrors(array('message'=>'All process has been closed!'));
              }
              
          }
                       
        }

        return $response;
    }
}
