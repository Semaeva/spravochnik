<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\positions;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= Departments::all();
        $position = positions::all();
        return View('admin.positions', ['position'=>$position, 'departments'=>$departments]);
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
       // $pos = new positions(['name'=>$request->get('name')]);
        //$pos->save();
        $pos = positions::firstOrCreate(['name' => $request->get('name')]);
        if ($pos->wasRecentlyCreated === true) {
        } else {
            $msg="Запись уже существует";
            return redirect()->back()->withErrors(['msg' => $msg]);
        }
        return  redirect()->back();
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
        positions::where('id', $id)->update(['name'=>$request->get('name')]);
        return  redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        positions::where('id',$id)->delete();
        return redirect()->back();
    }
}
