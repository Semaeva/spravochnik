<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ids extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $table='ids';
    protected $fillable=['abonents_id','positions_id','departments_id', 'statics_id','mobiles_id'];

    public function departments()
    {
        return $this->belongsTo(Departments::class, 'departments_id');
    }
    public function positions()
    {
        return $this->belongsTo(positions::class, 'positions_id');
    }
    public function abonents()
    {
        return $this->belongsTo(Abonents:: class, 'abonents_id');
    }
    public function staticTel()
    {
        return $this->belongsTo(StaticTel:: class, 'statics_id');
    }
    public function mobileTel()
    {
        return $this->belongsTo(MobileTel:: class, 'mobiles_id');
    }
}
