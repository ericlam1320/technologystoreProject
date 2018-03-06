<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\Tin;

class LoaiTinController extends Controller
{
    public function getDanhSach(){

    	$loaiTin = LoaiTin::all();

    	return view('adminDashboard.loaitin.danhsach', compact('loaiTin'));
    }

    public function getThem(){

    	return view('adminDashboard.loaitin.them');
    }
    public function postThem(Request $request){

    	$this->validate($request, [
    	
    		'tenLoaiTin' => 'required|unique:loaitin,TieuDeLoaiTin'
    	], 
    	[
    		'tenLoaiTin.required' => 'Bạn chưa nhập tên loại tin.',
    		'tenLoaiTin.unique'   => 'Tên loại tin đã trùng. Xin nhập lại tên khác.'
    	]);

    	$loaitin = new LoaiTin;
    	$loaitin->TieuDeLoaiTin = $request->tenLoaiTin;
    	$loaitin->save();

    	return redirect('admin/loaitin/them')->with('thongbao','Thêm loại sản phẩm thành công.');
    }

    public function getXoa($idLoaiTin){

        $so_tin_trong_loaitin = Tin::with('loaitin')->where('idLoaiTin',$idLoaiTin)->count();

        if($so_tin_trong_loaitin == 0){
            $loaitin = LoaiTin::find($idLoaiTin);
            $loaitin->delete();
            return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công.');
        }
        else{
            return redirect('admin/loaitin/danhsach')->with('loi','Xóa không thành công. Bạn không thể xóa loại tin này.');
        }
    	
    }

    public function getSua($idLoaiTin){

    	$loaitin = LoaiTin::find($idLoaiTin);

    	return view('adminDashboard.loaitin.sua', compact('loaitin'));
    }
    public function postSua($idLoaiTin, Request $request){

    	$this->validate($request, [
    	
    		'tenLoaiTin' => 'required'
    	], 
    	[
    		'tenLoaiTin.required' => 'Bạn chưa nhập tên loại tin.',
    	]);

    	$loaitin = LoaiTin::find($idLoaiTin);
    	$loaitin->TieuDeLoaiTin = $request->tenLoaiTin;
    	$loaitin->save();

    	return redirect('admin/loaitin/sua/' . $idLoaiTin)->with('thongbao','Cập nhật loại tin thành công.');
    
    }
}
