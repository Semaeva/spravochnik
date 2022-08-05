<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class telephone extends Model
{
    use HasFactory;
    protected $fillable=['static_tel', 'abonents_id', 'mobile_tel'];
    public $timestamps=false;

//    public function abonent()
//    {
//        return $this->belongsTo(telephone::class);
//    }

//    public function positions()
//    {
//        return $this->belongsToMany(Pos ::class);
//    }
}
