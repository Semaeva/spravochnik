<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonents extends Model
{
    use HasFactory;
public $timestamps=false;
    protected $table='abonents';

protected $fillable =['name'];

    public function departments()
    {
        return $this->belongsToMany(Departments::class
            ,'ids','abonents_id','departments_id');
//            ->withPivot('name'
//            );
    }

    public function staticTel()
    {
        return $this->hasMany(StaticTel::class, 'positions_id', 'id');
    }

//    public function telephones()
//    {
//        return $this->hasMany(telephone::class);
//    }

//    public function positions()
//    {
//        return $this->belongsToMany(positions::class
//            ,'ids','abonents_id','positions_id');
//    }


    public function ids(){
        return $this->hasMany(Ids::class, 'abonents_id');
    }


}
