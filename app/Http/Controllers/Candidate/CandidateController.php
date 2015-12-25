<?php

namespace nee_portal\Http\Controllers\Candidate;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Models\Candidate;
use nee_portal\Models\CandidateInfo;
use nee_portal\Http\Controllers\Controller;
use Auth, Redirect;
use Kris\LaravelFormBuilder\FormBuilder;

class CandidateController extends Controller
{
    public function __construct(formBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }
    
    private $content = 'candidate.application.';

    public function home()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Home',

            ['method' =>'POST',

             'url'    => route('candidate.home')

            ]);

        return view($this->content.'home', compact('form'));
    }


    public function storehome()
    {
            //$id = $request->$q_id;

            //return Qualification::where('id', $id)->get();
    }

    public function showStep1()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step1',

            ['method' =>'POST',

             'url'    => route($this->content.'step1')

            ])->remove('update');

        return view($this->content.'step1', compact('form'));
    }

    public function showStep2()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step2',

            ['method' =>'POST',

             'url'    => route($this->content.'step2')

            ])->remove('update');

        return view($this->content.'step2', compact('form'));
    }

}
