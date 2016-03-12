<?php

namespace nee_portal\Http\Controllers\Admin;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;
use nee_portal\Http\Controllers\Controller;
use nee_portal\Models\Admin;
use Illuminate\Database\QueryException;
use Kris\LaravelFormBuilder\FormBuilder;

use Redirect, Hash;

class UserController extends Controller
{
    private $content='admin.user.';

    public function __construct(Admin $user) {

        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=$this->user->paginate();

        return view($this->content.'index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form=$formBuilder->create('nee_portal\Forms\User',

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
        $this->validate($request, Admin::$rules);

        $data['username']=$request->username;
        $data['fullname']=$request->fullname;
        $data['mobile_no']=$request->mobile_no;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $data['active']="YES";

        Admin::create($data);

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

            $user  = Admin::findOrFail($id);

                $form    = $formBuilder->create('nee_portal\Forms\User',
                [
                 'method' => 'PUT',

                 'model' => $user,

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
        $this->validate($request, Admin::$rules);
        
        $result=Admin::findOrFail($id);

        $data['username']=$request->username;
        $data['fullname']=$request->fullname;
        $data['mobile_no']=$request->mobile_no;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $data['active']="YES";

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
                 Admin::destroy($id);

                }catch(QueryException $e){

                return Redirect::back()->with('message', 'Can not delete!');
            }

        return Redirect::route($this->content.'index')->with('message', 'Data has been Deleted Successfully!');

    }
}
