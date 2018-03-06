<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tin extends Model
{
    
    protected $table   = 'tin';
    protected $primaryKey = 'idTin';
    public $timestamps = false;

    public function BinhLuan(){

    	return $this->hasMany('App\BinhLuan', 'idTin', 'idTin');
    }
    public function LoaiTin(){

    	return $this->belongsTo('App\LoaiTin', 'idLoaiTin', 'idLoaiTin');
    }
}
