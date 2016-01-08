<?php

namespace nee_portal\Http\Controllers\Admin\MasterEntry;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;

use nee_portal\Http\Controllers\Controller;

use nee_portal\Models\ExamDetail;

use Illuminate\Database\QueryException;

use Kris\LaravelFormBuilder\FormBuilder;

use Redirect, Session, URL;

use nee_portal\Helpers\Basehelper;

class ExamDetailController extends Controller
{
    private $content='admin.masterentry.examdetail.';

    public function __construct(ExamDetail $exam_detail) {

        $this->exam_detail = $exam_detail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=$this->exam_detail->paginate();
        
        $paginator=0;

        $paginator=$result->currentPage();

        Session::put('url', URL::full());

        foreach ($result as $res) {

            $res->exam_id = Basehelper::getExam($res->exam_id);
            $res->qualification_id = Basehelper::getQualification($res->qualification_id);
        } 
        return view($this->content.'index', compact('result', 'paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form=$formBuilder->create('nee_portal\Forms\ExamDetailForm',

            ['method' =>'POST',

             'url'    => route($this->content.'store')

            ])->remove('update');

        return view($this->content.'create', compact('form'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ExamDetail::$rules);

        ExamDetail::create($request->all());

        if(Session::has('url')){

            return Redirect::to(Session::pull('url'))->with('message', 'Data has been inserted Successfully!');

        }
        else{

            return Redirect::route($this->content.'index')->with('message', 'Data has been inserted Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id, FormBuilder $formBuilder){

            $exam_detail  = ExamDetail::findOrFail($id);

                $form    = $formBuilder->create('nee_portal\Forms\ExamDetailForm',
                [
                 'method' => 'PUT',

                 'model' => $exam_detail,

                 'url' => route($this->content.'update', $id)

            ])->remove('submit');

                return view($this->content.'edit', compact('form'));
          }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ExamDetail::$rules);
        
        $result=ExamDetail::findOrFail($id);

        $data=$request->all();

        $result->update($data);

        return Redirect::route($this->content.'index')->with('message', 'Data has been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            try{
                 ExamDetail::destroy($id);

                }catch(QueryException $e){

                return Redirect::back()->with('message', 'Can not delete!');
            }

        if(Session::has('url')){

            return Redirect::to(Session::pull('url'))->with('message', 'Data has been Deleted Successfully!');
        }

        return Redirect::route($this->content.'index')->with('message', 'Data has been Deleted Successfully!');
    }
}
