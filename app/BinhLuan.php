<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    
    protected $table   = 'binhluan';
    public $timestamps = false;

    public function KhachHang(){

    	return $this->belongsTo('App\KhachHang', 'idKhachHang', 'id');
    }
    public function Tin(){

    	return $this->belongsTo('App\Tin', 'idTin', 'idTin');
    }
}
