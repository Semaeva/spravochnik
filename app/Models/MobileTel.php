<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileTel extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public $timestamps=false;
    protected $table= 'mobile_tel';

    public function ids() {
        return $this->hasMany(Ids::class, 'mobiles_id','id' );
    }
}
