<?php

namespace nee_portal\Http\Controllers\Admin\MasterEntry;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;

use nee_portal\Http\Controllers\Controller;

use nee_portal\Models\Quota;

use Illuminate\Database\QueryException;

use Kris\LaravelFormBuilder\FormBuilder;

use Redirect;

class QuotaController extends Controller
{
    private $content='admin.masterentry.quota.';

    public function __construct(Quota $quota) {

        $this->quota = $quota;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=$this->quota->paginate();

        return view($this->content.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(formBuilder $formBuilder)
    {
        $form=$formBuilder->create('nee_portal\Forms\QuotaForm',

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
        $this->validate($request, Quota::$rules);

        Quota::create($request->all());

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

            $quota  = Quota::findOrFail($id);

                $form    = $formBuilder->create('nee_portal\Forms\QuotaForm',
                [
                 'method' => 'PUT',

                 'model' => $quota,

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
        $this->validate($request, Quota::$rules);
        
        $result=Quota::findOrFail($id);

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

              Quota::destroy($id);

            }catch(QueryException $e){

              return Redirect::back()->with('message', 'Can not delete!');
            }

        return Redirect::route($this->content.'index')->with('message', 'Data has been Deleted Successfully!');

    }
}
