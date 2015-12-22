<?php

namespace nee_portal\Http\Controllers\Admin\MasterEntry;

use Illuminate\Http\Request;

use nee_portal\Http\Requests;

use nee_portal\Http\Controllers\Controller;

use nee_portal\Models\Reservation;

use Kris\LaravelFormBuilder\FormBuilder;

use Redirect, Session, URL;

use nee_portal\Helpers\Basehelper;

class ReservationController extends Controller
{
    private $content='admin.masterentry.reservation.';

    public function __construct(Reservation $reservsation) {

        $this->reservsation = $reservsation;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result=$this->reservsation->paginate();

        $paginator=0;

        $paginator=$result->currentPage();

        Session::put('url', URL::full());

        foreach ($result as $res) {

            $res->quota_id = Basehelper::getQuota($res->quota_id);

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
        $form=$formBuilder->create('nee_portal\Forms\ReservationForm',

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
        $this->validate($request, Reservation::$rules);

        Reservation::create($request->all());

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

            $reservsation  = Reservation::findOrFail($id);

                $form    = $formBuilder->create('nee_portal\Forms\ReservationForm',
                [
                 'method' => 'PUT',

                 'model' => $reservsation,

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
        $this->validate($request, Reservation::$edit_rules);
        
        $result=Reservation::findOrFail($id);

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
        Reservation::destroy($id);

        if(Session::has('url')){

            return Redirect::to(Session::pull('url'))->with('message', 'Data has been Deleted Successfully!');
        }

        return Redirect::route($this->content.'index')->with('message', 'Data has been Deleted Successfully!');

    }
}
