<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\MobileTel;
use App\Models\StaticTel;
use App\Models\telephone;
use Illuminate\Http\Request;

class TelephonesController extends Controller
{

    public function StaticTel(){
        $tel = StaticTel::all();
        $departments= Departments::all();

        return view('admin.static-tel', ['tel'=> $tel, 'departments'=>$departments]);
    }

    public function AddStaticTel(Request $request){
//        $tel = new StaticTel(['name'=>$request->get('tel')]);
//        $tel->save();
        $tel = StaticTel::firstOrCreate(['name' => $request->get('tel'),
            'departments_id'=> $request->get('dep_id')]);
        if ($tel->wasRecentlyCreated === true) {
        } else {
            $msg="Запись уже существует";
            return redirect()->back()->withErrors(['msg' => $msg]);
        }
        return redirect()->back();
    }

    public function AddMobileTel(Request $request){
//        $tel = new MobileTel(['name'=>$request->get('tel')]);
//        $tel->save();
        $tel = MobileTel::firstOrCreate(['name' => $request->get('tel')]);
        if ($tel->wasRecentlyCreated === true) {
        } else {
            $msg="Запись уже существует";
            return redirect()->back()->withErrors(['msg' => $msg]);
        }
        return redirect()->back();
    }
    public function DestroyMobileTel(Request $request, $id){
      MobileTel::where('id',$id)->delete();
        return redirect()->back();
    }

    public function DestroyStaticTel(Request $request, $id){
      StaticTel::where('id',$id)->delete();
        return redirect()->back();
    }


    public function EditMobileTel(Request $request, $id){
     $tel = MobileTel::find($id)->update(['name'=>$request->get('tel')]);
        return redirect()->back();
    }

    public function EditStaticTel(Request $request, $id){
        $tel = StaticTel::find($id)->update(['name'=>$request->get('tel')]);
        return redirect()->back();
    }


    public function MobileTel(){
        $tel = MobileTel::all();
        $departments= Departments::all();

        return view('admin.mobile-tel', ['tel'=> $tel, 'departments'=>$departments]);
    }

}
