<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Ids;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments= Departments::all();
        $all_departments = Departments::all();

        $ids = Ids::groupBy('departments_id')->select('departments_id')->get();
        return View('admin.departments', ['all_departments'=>$all_departments,'ids'=>$ids, 'departments'=>$departments]);
    }
    public function inActive()
    {
        $departments= Departments::all();
        $all_departments = Departments::all();

        $ids = Ids::groupby('departments_id')->select('departments_id')->get();
//        all();
        $array_ids = array();
        $array_dep = array();
        foreach ($ids as $idis)
        {
            array_push($array_ids,$idis->departments->id);
        }
            $dep = Departments::whereNotIn('id',  $array_ids)->get(['name', 'id']);
                array_push($array_dep, $dep);

        return View('admin.inactiveDepartments',
            ['all_departments'=>$all_departments,'ids'=>$ids,'array_ids'=>$array_ids,
                'array_dep'=>$array_dep,'departments'=>$departments, 'dep'=>$dep]);
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
        $dep = Departments::firstOrCreate(['name' => $request->get('name')]);
        if ($dep->wasRecentlyCreated === true) {
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
        Departments::where('id', $id)->update(['name'=>$request->get('name')]);
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
        Departments::where('id',$id)->delete();
        return redirect()->back();
    }
}
