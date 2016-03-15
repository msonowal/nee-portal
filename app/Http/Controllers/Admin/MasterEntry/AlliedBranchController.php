<?php

namespace nee_portal\Http\Controllers\Admin\MasterEntry;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;

use nee_portal\Http\Controllers\Controller;

use nee_portal\Models\AlliedBranch;

use Kris\LaravelFormBuilder\FormBuilder;

use Redirect, Session, URL;

use nee_portal\Helpers\Basehelper;

class AlliedBranchController extends Controller
{
    private $content='admin.masterentry.alliedbranch.';

    public function __construct(AlliedBranch $allied_branch) {

        $this->allied_branch = $allied_branch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=$this->allied_branch->paginate();

        $paginator=0;

        $paginator=$result->currentPage();

        Session::put('url', URL::full());

        foreach ($result as $res) {

           $res->branch_id = Basehelper::getBranch($res->branch_id);

        }        

        return view($this->content.'index', compact('result', 'paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(formBuilder $formBuilder)
    {
        if(Basehelper::Permission()==true)
            return back()->with(array('message'=>'Access Denied!')); 

        $form=$formBuilder->create('nee_portal\Forms\AlliedBranchForm',

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
        $this->validate($request, AlliedBranch::$rules);

        AlliedBranch::create($request->all());

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

        if(Basehelper::Permission()==true)
            return back()->with(array('message'=>'Access Denied!')); 

            $allied_branch  = AlliedBranch::findOrFail($id);

                $form    = $formBuilder->create('nee_portal\Forms\AlliedBranchForm',
                [
                 'method' => 'PUT',

                 'model' => $allied_branch,

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
        $this->validate($request, AlliedBranch::$rules);
        
        $result=AlliedBranch::findOrFail($id);

        $data=$request->all();

        $result->update($data);

        if(Session::has('url')){

            return Redirect::to(Session::pull('url'))->with('message', 'Data has been Updated Successfully!');
        }

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
        if(Basehelper::Permission()==true)
            return back()->with(array('message'=>'Access Denied!')); 
        
        AlliedBranch::destroy($id);

        if(Session::has('url')){

            return Redirect::to(Session::pull('url'))->with('message', 'Data has been Deleted Successfully!');
        }

        return Redirect::route($this->content.'index')->with('message', 'Data has been Deleted Successfully!');

    }
}
