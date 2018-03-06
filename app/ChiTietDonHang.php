<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    
    protected $table   = 'chitietdonhang';
    protected $primaryKey = 'idChiTietDonHang';
    public $timestamps = false;

    public function DonHang(){

    	return $this->belongsTo('App\DonHang', 'idDonHang', 'idDonHang');
    }
    public function SanPham(){

    	return $this->belongsTo('App\SanPham', 'idSP', 'idSP');
    }
}
