<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiSanPham;
use App\SanPham;

class LoaiSanPhamController extends Controller
{
    public function getDanhSach(){

    	$loaiSanPham = LoaiSanPham::all();

    	return view('adminDashboard.loaisanpham.danhsach', compact('loaiSanPham'));
    }

    public function getThem(){

    	return view('adminDashboard.loaisanpham.them');
    }
    public function postThem(Request $request){

    	$this->validate($request, [
    	
    		'tenLoaiSP' => 'required|unique:LoaiSanPham,TenLoaiSP'
    	], 
    	[
    		'tenLoaiSP.required' => 'Bạn chưa nhập tên loại sản phẩm.',
    		'tenLoaiSP.unique'   => 'Tên sản phẩm đã trùng. Xin nhập lại tên khác.'
    	]);

    	$loaisp = new LoaiSanPham;
    	$loaisp->TenLoaiSP = $request->tenLoaiSP;
    	$loaisp->save();

    	return redirect('admin/loaisanpham/them')->with('thongbao','Thêm loại sản phẩm thành công.');
    }

    public function getXoa($idLoaiSP){

        $so_sanpham_trong_loai_sanpham = SanPham::with('loaisanpham')->where('idLoaiSP',$idLoaiSP)->count();
        if($so_sanpham_trong_loai_sanpham == 0){
            $loaisp = LoaiSanPham::find($idLoaiSP);
            $loaisp->delete();
            return redirect('admin/loaisanpham/danhsach')->with('thongbao','Xóa thành công.');
        }else{
            return redirect('admin/loaisanpham/danhsach')->with('loi','Xóa không thành công. Bạn không thể xóa loại sản phẩm này.');
        }
    	
    }

    public function getSua($idLoaiSP){

    	$loaisp = LoaiSanPham::find($idLoaiSP);
    	return view('adminDashboard.loaisanpham.sua', compact('loaisp'));
    }
    public function postSua($idLoaiSP, Request $request){

    	$this->validate($request, [
    	
    		'tenLoaiSP' => 'required'
    	], 
    	[
    		'tenLoaiSP.required' => 'Bạn chưa nhập tên loại sản phẩm.',
    	]);

    	$loaisp = LoaiSanPham::find($idLoaiSP);
    	$loaisp->TenLoaiSP = $request->tenLoaiSP;
    	$loaisp->save();

    	return redirect('admin/loaisanpham/sua/' . $idLoaiSP)->with('thongbao','Cập nhật loại sản phẩm thành công.');
    }
}
