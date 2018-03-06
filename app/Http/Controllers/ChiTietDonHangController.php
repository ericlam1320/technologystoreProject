<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChiTietDonHang;
use DB;
use App\SanPham;
use App\DonHang;

class ChiTietDonHangController extends Controller
{
    
    public function getDanhSach(){

    	$chitiet = DB::table('chitietdonhang')
    				->join('sanpham', 'sanpham.idSP', '=', 'chitietdonhang.idSP') // Gộp bảng
    				->get([
    						'chitietdonhang.idChiTietDonHang',
    						'chitietdonhang.idDonHang',
    						'chitietdonhang.idSP',
    					 	'SoLuong', 
    					    'chitietdonhang.GiaSP', 
    					    'chitietdonhang.GiaKhuyenMai',
    					    'ThanhTien',
    					    'sanpham.TenSP',
    					]);
    	return view('adminDashboard.chitietdonhang.danhsach', compact('chitiet'));
    }

    public function getThem(){

    	$sanpham = SanPham::all();
    	$donhang = DonHang::all();
    	$chitiet = ChiTietDonHang::all();
    	return view('adminDashboard.chitietdonhang.them', compact('sanpham', 'donhang', 'chitiet'));
    }
    public function postThem(Request $request){   // Request: lấy thông tin từ form

    	$this->validate($request,[
        'SoLuong'=>'required',
      ],
      [
        'SoLuong.required' => 'Bạn cần nhập số lượng. ',
      ]);

      $chitietdonhang = new ChiTietDonHang;
      $chitietdonhang->idDonHang = $request->DonHang;
      $chitietdonhang->idSP = $request->SanPham;
      $chitietdonhang->SoLuong = $request->SoLuong;
      $chitietdonhang->GiaSP = $request->GiaSP;
      $chitietdonhang->GiaKhuyenMai = $request->GiaKhuyenMai;
      $chitietdonhang->ThanhTien = $request->ThanhTien;

      $chitietdonhang->save();
      
      return redirect('admin/chitietdonhang/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($idChiTietDonHang){

    	$chitietdonhang = ChiTietDonHang::find($idChiTietDonHang);
    	$chitietdonhang->delete();

    	return redirect('admin/chitietdonhang/danhsach')->with('thongbao', 'Đã xóa thành công.');
    }

    public function getSua($idChiTietDonHang){

    	$sanpham = SanPham::all();
    	$donhang = DonHang::all();
    	$chitietdonhang = ChiTietDonHang::find($idChiTietDonHang);
    	return view('adminDashboard.chitietdonhang.sua', compact('sanpham', 'donhang', 'chitietdonhang'));
    }
    public function postSua($idChiTietDonHang, Request $request){

    	$this->validate($request,[
        'SoLuong'=>'required',
      ],
      [
        'SoLuong.required' => 'Bạn cần nhập số lượng. ',
      ]);

      $chitietdonhang = ChiTietDonHang::find($idChiTietDonHang);
      $chitietdonhang->idDonHang = $request->DonHang;
      $chitietdonhang->idSP = $request->SanPham;
      $chitietdonhang->SoLuong = $request->SoLuong;
      $chitietdonhang->GiaSP = $request->GiaSP;
      $chitietdonhang->GiaKhuyenMai = $request->GiaKhuyenMai;
      $chitietdonhang->ThanhTien = $request->ThanhTien;

      $chitietdonhang->save();
      
      return redirect('admin/chitietdonhang/sua/'.$idChiTietDonHang)->with('thongbao','Cập nhật thành công');
    }
}
