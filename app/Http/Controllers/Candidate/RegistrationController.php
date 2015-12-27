<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Validator, Basehelper, DB, Input;
use nee_portal\Models\Step1;
use nee_portal\Models\Step2;
use nee_portal\Models\Step3;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session, Auth, Redirect;
use nee_portal\Models\CandidateInfo;

class RegistrationController extends Controller
{
    public function __construct(formBuilder $formBuilder) {

        $this->info_id = Session::get('candidate_info_id');
        $this->formBuilder = $formBuilder;
    }
    
    private $content = 'candidate.application.';

    public function showForm(){

        try {

            $candidate_info = CandidateInfo::where('id', $this->info_id)->firstOrFail();

        } catch(ModelNotFoundException $e) {

            return Redirect::back()->with('message', 'Record Not Found!');
        }

        $reg_status = $candidate_info->reg_status;
        $step1 = Step1::where('candidate_info_id', $this->info_id)->get();
        $step2 = Step2::where('candidate_info_id', $this->info_id)->get();
        $step3 = Step3::where('candidate_info_id', $this->info_id)->get();

        if($reg_status=="not_submitted"){

            if($step1->count()==0){
                return $this->showStep1();
            }        
            elseif($step2->count()==0){
                return $this->showStep2();
            }
            elseif($step3->count()==0){
                return $this->showStep3();
            }
        }
    }


    public function getStep(){

        try {

            $candidate_info = CandidateInfo::where('id', $this->info_id)->firstOrFail();

        } catch(ModelNotFoundException $e) {

            return Redirect::back()->with('message', 'Record Not Found!');
        }

        $reg_status = $candidate_info->reg_status;
        $step1 = Step1::where('candidate_info_id', $this->info_id)->get();
        $step2 = Step2::where('candidate_info_id', $this->info_id)->get();
        $step3 = Step3::where('candidate_info_id', $this->info_id)->get();

        if($reg_status=="not_submitted"){

            if($step1->count()==0){
                return $this->saveStep1();
            }        
            elseif($step2->count()==0){
                return $this->saveStep2();
            }
            elseif($step3->count()==0){
                return $this->saveStep3();
            }
        }
    }


    public function showStep1()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step1',

            ['method' =>'POST',

             'url'    => route($this->content.'step')

            ])->remove('update');

        return view($this->content.'step1', compact('form'));
    }

    public function saveStep1()
    {

        $validator = Validator::make($data =Input::all(), Step1::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();

        } else {

        DB::beginTransaction();

        $step1 = Step1::where('candidate_info_id', $this->info_id)->get();

            if($step1->count()!=0){

                return $this->showForm();               

            } else {
                    $data = ['candidate_info_id' => $this->info_id] + Input::all();
                    $step1_data = new Step1;
                    $step1_data->fill($data);

                    if (!$step1_data->save())
                    {
                        return Redirect::back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                    }

                    DB::commit();
                    return $this->showForm();
            }

        }

    }

    public function showStep2()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step2',

            ['method' =>'POST',

             'url'    => route($this->content.'step')

            ])->remove('update');

        return view($this->content.'step2', compact('form'));
    }


    public function saveStep2()
    {
        $validator = Validator::make($data =Input::all(), Step2::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();

        } else {

        DB::beginTransaction();

        $step2 = Step2::where('candidate_info_id', $this->info_id)->get();

            if($step2->count()!=0){

                return $this->showForm();               

            } else {
                    $data = ['candidate_info_id' => $this->info_id] + Input::all();
                    $step2_data = new Step2;
                    $step2_data->fill($data);

                    if (!$step2_data->save())
                    {
                        return Redirect::back()->withInput()->with('message', 'Error Storing your data, Please contact Technical Support');
                    }

                    DB::commit();
                    return $this->showForm();
            }

        }

    }

    public function showStep3()
    {
        return view($this->content.'step3');
    }


}
