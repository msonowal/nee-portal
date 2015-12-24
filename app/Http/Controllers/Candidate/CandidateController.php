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

    public function index()
    {
        //return $this->createStep1();
    }

    public function home()
    {
        return view($this->content.'home');
    }

    public function showStep2()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step2',

            ['method' =>'POST',

             'url'    => route($this->content.'step2')

            ])->remove('update');

        return view($this->content.'step2', compact('form'));
    }

    public function showStep3()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step3',

            ['method' =>'POST',

             'url'    => route($this->content.'step3')

            ])->remove('update');

        return view($this->content.'step3', compact('form'));
    }

}
