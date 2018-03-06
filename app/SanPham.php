<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    
    protected $table   = 'sanpham';
    protected $primaryKey = 'idSP';
    public $timestamps = false;

    public function LoaiSanPham(){
    	return $this->belongsTo('App\LoaiSanPham', 'idLoaiSP', 'idLoaiSP');
    }
    public function HangSanXuat(){
    	return $this->belongsTo('App\HangSanXuat', 'idHangSX', 'idHangSX');
    }
    public function ChiTietDonHang(){
    	return $this->hasMany('App\ChiTietDonHang', 'idSP', 'idSP');
    }
    public function HinhSanPham(){
    	return $this->hasMany('App\HinhSanPham', 'idSP', 'idSP');
    }
}
