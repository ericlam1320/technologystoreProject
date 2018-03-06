<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    
    protected $table   = 'donhang';
     protected $primaryKey = 'idDonHang';
    public $timestamps = false;

    public function ChiTietDonHang(){

    	return $this->hasMany('App\ChiTietDonHang', 'idDonHang', 'idDonHang');
    }
    public function KhachHang(){

    	return $this->belongsTo('App\KhachHang', 'idKhachHang', 'id');
    }
}
