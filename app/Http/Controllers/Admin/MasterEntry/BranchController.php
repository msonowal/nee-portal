<?php

namespace nee_portal\Http\Controllers\Admin\MasterEntry;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;

use nee_portal\Http\Controllers\Controller;

use nee_portal\Models\Branch;

use Kris\LaravelFormBuilder\FormBuilder;

use Illuminate\Database\QueryException;

use Redirect;

class BranchController extends Controller
{
    private $content='admin.masterentry.branch.';

    public function __construct(Branch $branch) {

        $this->branch = $branch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=$this->branch->paginate();

        return view($this->content.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(formBuilder $formBuilder)
    {
        $form=$formBuilder->create('nee_portal\Forms\BranchForm',

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
        $this->validate($request, Branch::$rules);

        Branch::create($request->all());

        return Redirect::route($this->content.'index')->with('message', 'Data has been inserted Successfully!');
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

            $branch  = Branch::findOrFail($id);

                $form    = $formBuilder->create('nee_portal\Forms\BranchForm',
                [
                 'method' => 'PUT',

                 'model' => $branch,

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
        $this->validate($request, Branch::$rules);
        
        $result=Branch::findOrFail($id);

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

              Branch::destroy($id);

            }catch(QueryException $e){

              return Redirect::back()->with('message', 'Can not delete!');
            }

        return Redirect::route($this->content.'index')->with('message', 'Data has been Deleted Successfully!');

    }
}
