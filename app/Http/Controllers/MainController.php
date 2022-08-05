<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Ids;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class MainController extends Controller
{
    public  function index()
    {
//        $id = Departments::find(1)->first();
        $id = Departments::where('name', 'like', '%Президент%')->first();
        $ids = Ids::where('departments_id',$id->id)->get();
        $departments= Departments::all();
        $department= Departments::find($id->id);
        return view('main.show', ['departments'=>$departments,'ids'=>$ids, 'department'=>$department]);
    }

    public  function show($id)
    {
        $ids = Ids::where('departments_id',$id)->get();
        $departments= Departments::all();
        $department= Departments::find($id);
        return view('main.show', ['departments'=>$departments,'ids'=>$ids, 'department'=>$department]);
    }

    public function showEmployee(Request $request)
    {
        $employees = Departments::all();
        if($request->get('keyword') != ''){
            $employees = Departments::where('name','LIKE','%'.$request->get('keyword').'%')->get();
      }
        return response()->json([
            'employees' => $employees
        ]);
    }
}
