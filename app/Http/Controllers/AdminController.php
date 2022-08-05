<?php

namespace App\Http\Controllers;

use App\Models\Abonents;
use App\Models\Departments;
use App\Models\Ids;
use App\Models\MobileTel;
use App\Models\positions;
use App\Models\StaticTel;
use App\Models\telephone;
use http\Client\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Routing\Loader\Configurator\collection;
use function Symfony\Component\String\length;

class AdminController extends Controller
{
    public  function index()
    {
        $departments= Departments::all();
        return view('admin.main', ['departments'=>$departments]);
    }

    public  function show($id)
    {
        $ids = Ids::where('departments_id',$id)->get();
        $department=Departments::find($id);
        $departments=Departments::all();
        $abonents = Abonents::all();
        $positions = positions::all();
//        $static_tel_dis= StaticTel::distinct('name')->get(['name']) ;
        $static_tel= StaticTel::all();
        $mobile_tel= MobileTel::all();

        return view('admin.show', ['ids'=>$ids,'departments'=>$departments, 'department'=>$department,
            'abonents'=>$abonents,'positions'=>$positions,'static_tel'=>$static_tel,
//            'static_tel_dis'=>$static_tel_dis,
            'mobile_tel'=>$mobile_tel]);
    }

    public function changePositions(Request $request,$id){
        $check= Ids::where('positions_id',$request->get('positions'))->first();
        if($check){
            $dep = Departments::find($check->departments_id)->name;
            $abon = Abonents::find($check->abonents_id)->name;
            $msg="Должность уже используются в: ".$dep." у абонента: ".$abon.". Добавление дубликата невозможно.";
            return redirect()->back()->withErrors(['msg' => $msg]);
            }

            $ids = Ids::find($id);
            StaticTel::where('positions_id',$request->get('pos_id'))->update(['positions_id'=>0]);
            $ids -> update(['positions_id'=>$request->get('positions')]);
            foreach ($request->old_tel as $ol) {
                StaticTel::where('id', $ol)->update(['positions_id' => $request->get('positions')]);
            }
            return redirect()->back();
    }

    public function AbonentConfirm(Request $request,$ids,$dep_id){
        $check= Ids::where('abonents_id',$request->get('abonents'))->first();
        if($check){
            $dep = Departments::find($check->departments_id)->name;
            $pos = positions::find($check->positions_id)->name;
            $msg="Предупреждение. Инициалы абонента уже используются в: ".$dep." у должности: ".$pos.". Продолжить?";
            $var =$request->get('abonents');
            return view ('admin.isConfirmed', ['var'=>$var,'id'=>$ids, 'dep_id'=>$dep_id, 'msg'=>$msg ]);
        }
        Ids::find($ids)-> update(['abonents_id'=>$request->get('abonents')]);
        return  redirect()->back();
    }


    public function changeAbonents(Request $request){
        $id = $request->input('id');
        $var = $request->input('abonents');

        $ids = Ids::find($id);
        $ids -> update(['abonents_id'=>$var]);
         return response()->json([ 'data' => $id],200);
    }
    public function changeMobile(Request $request,$id){
        $check= Ids::where('mobiles_id',$request->get('mob'))->first();
        if($check){
            $dep = Departments::find($check->departments_id)->name;
            $pos = positions::find($check->positions_id)->name;
            $msg="Номер уже существует в: ".$dep." у должности: ".$pos.". Добавление дубликата мобильного номера невозможно.";
            return redirect()->back()->withErrors(['msg' => $msg]);
        }
        $ids = Ids::find($id);
        $ids -> update(['mobiles_id'=>$request->get('mob')]);
        return redirect()->back();
    }

    public function AddStaticTel($id, Request $request){
        $check = StaticTel::where('id', $request->get('static'))->where('positions_id', '!=', 0)->first();
        if($check){
            $msg="Добавление дубликата стационарного номера невозможно.";
            return redirect()->back()->withErrors(['msg' => $msg]);
        }
        $stat = $request->get('static');
         StaticTel::where('id', $stat)->update(['positions_id'=>$id, 'description'=>$request->get('description'), 'departments_id'=>$request->get('dep_id')]);
         return redirect()->back();
    }

    public function changeStatic(Request $request,$id){
        //        return redirect()->back()->withErrors(['msg' => $check]);

        $check = StaticTel::find($request->get('tel'));
        if(!isset($check)){
            StaticTel::where('id',$id)->update(['positions_id'=> 0]);
                    return redirect()->back();

        }
            $staticTel = StaticTel::where('positions_id', $request->get('pos_id'))->get();
//        return redirect()->back()->withErrors(['msg' => $check]);

        if ($check->positions_id != 0){
            $dep =  Ids::where('abonents_id',$request->get('pos_id'))->get();
            $pos = positions::find($check->positions_id)->name;
            foreach ($dep as $d){
                    $msg = "Номер уже существует в: " . $d->departments->name . " у должности: " . $pos . ". Добавление дубликата стационарного номера невозможно.";
                    return redirect()->back()->withErrors(['msg' => $msg]);
            }
        }

            foreach ($staticTel as $st){
                if ($st->id == $request->get('tel')){
                    $msg="Добавление дубликата стационарного номера невозможно.";
                    return redirect()->back()->withErrors(['msg' => $msg]);
                }
            }
        StaticTel::where('id', $id)->update(['positions_id'=>0]);
        StaticTel::where('id', $request->get('tel'))->update(['positions_id'=>$request->get('pos_id')]);
        return redirect()->back();
    }


    public  function  CheckPosition(Request $request, $id){
        $msg='Запись будет добавлена. Продолжить?';
        $checkPos= Ids::where('positions_id',$request->get('positions'))->first();
        if($checkPos){
            $dep = Departments::find($checkPos->departments_id)->name;
            $msg="Предупреждение. Выбранная должность уже используются в минисетрстве: ".$dep.". Продолжить?";
            return $msg;
        }
        return $msg;
    }

    public  function  CheckAbon($abon, $id){
        $msg ='';
        $checkAbon= Ids::where('abonents_id',$abon)->first();
        if($checkAbon){
            $depAbon = Departments::find($checkAbon->departments_id);
            if($depAbon->id == $id){
                $msg='Error. Дубликат абонента найден в этом же министерстве'.$depAbon->id;
                return $msg;
            }
            $msg="Предупреждение. Выбранный абонент состоит в министерстве: ".$depAbon->name.". Продолжить?";
            return $msg;
        }
        return $msg;
    }


    public  function  CheckStatic(Request $request){
        $name_tel = StaticTel::where('id',$request->get('static'))->first()->name;
        $msg = '';

        $checkStatic= StaticTel::where('id',$request->get('static'))
            ->where('positions_id', '!=',0)->first();

        $checkMob = Ids::where('mobiles_id',$request->get('mobile'))
            ->where('mobiles_id','!=',0)->first();

        if(isset($checkStatic)){
            $msg="Выбранный номер телефона используется на должности ".$checkStatic->positions.". Дублирование стационарного номера невозможно.";
            return response()->json(['data'=>$msg],200);
        }
        if(isset($checkMob)){
            $msg="Выбранный мобильный номер используется на должности ".$checkMob->positions->name.". Дублирование мобильного номера невозможно.";
            return response()->json(['data'=>$msg],200);
        }

        StaticTel::where('departments_id',$request->get('dep_id'))
            ->where('id',$request->get('static'))->update(['positions_id'=>$request->get('abonents_id')]);
            $ids = new Ids([
                'departments_id' => $request->get('dep_id'),
                'positions_id' => $request->get('positions_id'),
                'abonents_id' => $request->get('abonents_id'),
                'mobiles_id' => $request->get('mobile')
            ]);
            $ids->save();


        return response()->json(['data'=>$request->get('positions_id')],200);
    }

    public function ConfirmAll(Request $request, $id){
           if( $this->CheckPosition($request, $id) != ''){
                return view('admin.isConfirmed', ['msg2'=>$this->CheckPosition($request, $id),'static'=>$request->get('static'),
                    'dep_id'=>$id,'positions_id'=>$request->get('positions'), 'abonents_id'=>$request->get('abonents'),
                    'mobile'=>$request->get('mobile'), 'description'=>$request->get('description')]);
           }

        $check = $this->CheckAbon($request->get('abonents'), $id);
            if($check!='' ){
                return view('admin.isConfirmed', ['msg2'=>$this->CheckPosition($request, $id),'static'=>$request->get('static'),
                    'dep_id'=>$id,'positions_id'=>$request->get('positions'), 'abonents_id'=>$request->get('abonents'),
                    'mobile'=>$request->get('mobile'), 'description'=>$request->get('description')]);
        }
    }

    public  function GetAnswer(Request $request){
        return response()->json([ 'data' => $request->get('answer')],200);

//        $id=$request->get('id');
//        $answer =$request->get('answer');
//
//        $check = $this->CheckAbon($request->get('abonents_id'), $id);
//        if($answer== true){
//            if($check!='' ){
//                return response()->json([ 'data' => $check],200);
//            }
//        }
//        return redirect()->back();
    }


    public function addPositions(Request $request,$id){
//        dd($request);
        $ids = new Ids([
            'departments_id'=>$id,
            'positions_id'=>$request->get('positions'),
            'abonents_id'=>$request->get('abonents'),
            'mobiles_id'=>$request->get('mobile')
        ]);
        $ids->save();
//return response()->json(['data'=>$id]);
        StaticTel::where('id',$request->get('static'))
            ->update(['positions_id'=>$request->get('positions'),
                'description'=>$request->get('description'),
                'departments_id'=>$id
        ]);
        return redirect()->back();
    }

    public function edit(Request $request,$id){
    positions::find($id)->update(['name'=>$request->get('name')]);
        return redirect()->back();
    }


    public function AllPositions(){
        $ids =Ids::all();
        $departments= Departments::all();
        return view('admin.positions', ['departments'=>$departments, 'ids'=>$ids]);
    }

    public function updateAllRecords(Request $request)
    {
         $id = $request->input('id');
        $data = $request->input('data');
        $data_abon = $request->input('data_abon');
        $data_stat = $request->input('data_stat');
        $data_mob = $request->input('data_mob');
        $ids = Ids::where('departments_id', $id)->get();
        foreach($ids as $key => $info){
            $info->positions_id = $data[$key];
            $info->abonents_id = $data_abon[$key];
//            $info->statics_id = $data_stat[$key];
            $info->mobiles_id = $data_mob[$key];
            $info->save();
        }
        return response()->json([ 'data' => $data_mob],200);
    }

    public function update(Request $request, $id){
        $name = $request->input('name');
        $pos = positions::find($id);
        $pos->name=$name;
        $pos->save();
        return response()->json([ 'name' => $request->input('name'), 'id'=>$id]);
    }

    public function destroyRecord($id, Request $request){

    StaticTel::where('positions_id', $request->get('pos_id'))
        ->where('departments_id',$request->get('dep_id'))
        ->update(['positions_id' => 0, 'departments_id' => $request->get('dep_id')]);
        Ids::where('id', $id)->delete();
        return redirect()->back();
    }


}
