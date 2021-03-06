<?php

namespace nee_portal\Http\Controllers\Admin\MasterEntry;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;

use nee_portal\Http\Controllers\Controller;

use nee_portal\Models\Centre;

use Illuminate\Database\QueryException;

use Kris\LaravelFormBuilder\FormBuilder;

use Redirect, Basehelper;

class CentreController extends Controller
{
    private $content='admin.masterentry.centre.';

    public function __construct(Centre $centre) {

        $this->centre = $centre;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=$this->centre->paginate();

        return view($this->content.'index', compact('result'));
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

        $form=$formBuilder->create('nee_portal\Forms\CentreForm',

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
        $this->validate($request, Centre::$rules);

        Centre::create($request->all());

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

        if(Basehelper::Permission()==true)
            return back()->with(array('message'=>'Access Denied!')); 

            $centre  = Centre::where('centre_code', $id)->firstOrFail();

                $form    = $formBuilder->create('nee_portal\Forms\CentreForm',
                [
                 'method' => 'PUT',

                 'model' => $centre,

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
        $this->validate($request, Centre::$edit_rules);
        
        $result=Centre::where('centre_code', $id)->firstOrFail();

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
        if(Basehelper::Permission()==true)
            return back()->with(array('message'=>'Access Denied!')); 
        
        try{

              Centre::where('centre_code', $id)->delete();

            }catch(QueryException $e){

              return Redirect::back()->with('message', 'Can not delete!');
            }

        return Redirect::route($this->content.'index')->with('message', 'Data has been Deleted Successfully!');
    }
}
