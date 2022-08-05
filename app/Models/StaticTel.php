<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticTel extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable = ['name','positions_id', 'description','departments_id'];
    protected $table='static_tel';

//    public function ids() {
//        return $this->hasMany(Ids::class, 'statics_id','id' );
//    }

    public function abonents(){
        return $this->belongsTo(Abonents::class);
    }

public function departments()
{
    return $this->belongsTo(Departments::class);
}

//        public function positions(){
//        return $this->belongsTo(positions::class);
//    }
}
