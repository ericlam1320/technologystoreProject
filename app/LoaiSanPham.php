<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiSanPham extends Model
{
    
    protected $table   = 'loaisanpham';
    protected $primaryKey = 'idLoaiSP';
    public $timestamps = false;

    public function SanPham(){

    	return $this->hasMany('App\SanPham', 'idLoaiSP', 'idLoaiSP');
    }
}
