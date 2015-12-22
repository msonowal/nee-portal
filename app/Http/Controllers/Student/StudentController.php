<?php

namespace nee_portal\Http\Controllers\Student;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Models\Student;
use nee_portal\Models\StudentInfo;
use nee_portal\Http\Controllers\Controller;
use Auth, Redirect;
use Kris\LaravelFormBuilder\FormBuilder;

class StudentController extends Controller
{
    public function __construct(formBuilder $formBuilder) {

        $this->formBuilder = $formBuilder;
    }
    
    private $content = 'student.';

    public function index()
    {
        return $this->showStep1();
    }

    public function dashboard()
    {
        return view($this->content.'dashboard');
    }

    public function showStep1()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step1Form',

            ['method' =>'POST',

             'url'    => route($this->content.'application')

            ])->remove('update');

        return view($this->content.'step1', compact('form'));
    }

    public function createStep2()
    {
        $form=$this->formBuilder->create('nee_portal\Forms\Step2Form',

            ['method' =>'POST',

             'url'    => route($this->content.'application.step2')

            ])->remove('update');

        return view($this->content.'step2', compact('form'));
    }

}
