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
    
    private $content = 'candidate.';

    public function index()
    {
        return $this->createStep2();
    }

    public function home()
    {
        return view($this->content.'home');
    }

    public function createStep1()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step2',

            ['method' =>'POST',

             'url'    => route($this->content.'application')

            ])->remove('update');

        return view($this->content.'step1', compact('form'));
    }

    public function createStep2()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step1',

            ['method' =>'POST',

             'url'    => route($this->content.'application.step2')

            ])->remove('update');

        return view($this->content.'step2', compact('form'));
    }

}
