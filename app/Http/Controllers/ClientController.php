<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $clientFilter=Client::paginate(10);
        return view('clients.index',compact('clientFilter'));
    }
    public function search(Request $request)
    {
      $this->validate($request,[
       'input' =>'required'
      ]);
      $input = $request->input;
      $clientFilter = Client::where('name' , 'like' , '%' . $input . '%')
                   ->orWhere('email' , 'like' ,'%' . $input . '%')
                   ->orWhereHas('city',function ($city) use($input){
                        $city->where('name','like','%'.$input.'%');
                    })->get();
      if ($clientFilter)
      {
        return view('clients.index',compact('clientFilter'));
      }


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Client::findOrFail($id);
        $record->delete();
        flash()->success("Deleted");
        return back();
    }
}
