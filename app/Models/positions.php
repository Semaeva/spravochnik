<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class positions extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public $timestamps=false;
    /**
     * @var mixed
     */

    public function telephones()
    {
        return $this->hasMany(telephone::class);
    }
    public function ids(){
        return $this->hasMany(Ids::class, 'positions_id');
    }

//        public function staticTel()
//    {
//        return $this->hasMany(StaticTel::class, 'positions_id', 'id');
//    }

//    public function abonents(){
//        return $this->belongsToMany(Abonents::class, 'ids', 'positions_id','abonents_id');
//    }
//
//
//    public function departments()
//    {
//        return $this->belongsToMany(Departments::class
//            ,'ids','positions_id','departments_id');
//    }




}
