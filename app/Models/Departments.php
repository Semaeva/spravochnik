<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='departments';
    protected $fillable=['name'];


    public function ids() {
        return $this->hasMany(Ids::class, 'departments_id','id' );
    }

    public function abonents()
    {
        return $this->belongsToMany(Abonents::class,'ids'
            ,'departments_id','abonents_id')
//            ->withPivot('positions_id')
            ;
    }
//    public function positions()
//    {
//        return $this->belongsToMany(positions::class
//            ,'ids','departments_id ','positions_id');
//    }
}
