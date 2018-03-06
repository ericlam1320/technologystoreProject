<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HinhSanPham;
use App\SanPham;
use DB;

class HinhSanPhamController extends Controller
{

    public function getDanhSach(){

    	$hinhsanpham = DB::table('hinhsanpham')
    				->join('sanpham', 'sanpham.idSP', '=', 'hinhsanpham.idSP') // Gộp bảng
    				->get([
    						'sanpham.TenSP',
    						'hinhsanpham.idHinh',
    						'hinhsanpham.TenHinh'
    					]);
    	return view('adminDashboard.hinhsanpham.danhsach', compact('hinhsanpham'));
    }

    public function getThem(){

    	$sanpham = SanPham::all();
    	return view('adminDashboard.hinhsanpham.them', compact('sanpham'));
    }
    public function postThem(Request $request){   // Request: lấy thông tin từ form

      $hinhsanpham = new HinhSanPham;
      $hinhsanpham->idSP = $request->SanPham;

      if ($request->hasFile('hinh')) {  //ktra có up hình or not
        $file = $request->file('hinh');
        $duoi = $file->getClientOriginalExtension();  //lấy đuôi file
        if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
          return redirect('admin/hinhsanpham/them')->with('loi',' Chỉ được chọn file có phần mở rộng là jpg, jpeg, png');
        }
        $name = $file->getClientOriginalName();  //lấy tên hình nguyên bản
        $hinh = str_random(4)."_".$name;  //tên hình khi save lại : "4 ký tự random" + "_" + name nguyên bản
        while (file_exists("clientassets/upload/sanpham/".$hinh)) {  //ktra đã tồn tại hình có tên tương tự chưa
          $hinh = str_random(4)."_".$name;    //thì random tiếp
        }
        $file->move("clientassets/upload/sanpham/",$hinh);  // move hình đã upload vào folder upload
        $hinhsanpham->TenHinh = $hinh;
      }
      else {
        $hinhsanpham->TenHinh = "";
      }

      $hinhsanpham->save();
      
      return redirect('admin/hinhsanpham/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($idHinh){

    	$hinhsanpham = HinhSanPham::find($idHinh);
    	$hinhsanpham->delete();

    	return redirect('admin/hinhsanpham/danhsach')->with('thongbao', 'Xóa thành công.');
    }

    public function getSua($idHinh){

    	$sanpham = SanPham::all();
    	$hinhsanpham = HinhSanPham::find($idHinh);
    	return view('adminDashboard.hinhsanpham.sua', compact('sanpham', 'hinhsanpham'));
    }
    public function postSua($idHinh, Request $request){

    	$hinhsanpham = HinhSanPham::find($idHinh);
        $hinhsanpham->idSP = $request->SanPham;

      if ($request->hasFile('hinh')) {  //ktra có up hình or not
        $file = $request->file('hinh');
        $duoi = $file->getClientOriginalExtension();  //lấy đuôi file
        if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
          return redirect('admin/hinhsanpham/them')->with('loi',' Chỉ được chọn file có phần mở rộng là jpg, jpeg, png');
        }
        $name = $file->getClientOriginalName();  //lấy tên hình nguyên bản
        $hinh = str_random(4)."_".$name;  //tên hình khi save lại : "4 ký tự random" + "_" + name nguyên bản
        while (file_exists("clientassets/upload/sanpham/".$hinh)) {  //ktra đã tồn tại hình có tên tương tự chưa
          $hinh = str_random(4)."_".$name;    //thì random tiếp
        }
        $file->move("clientassets/upload/sanpham/",$hinh);  // move hình đã upload vào folder upload
        $hinhsanpham->TenHinh = $hinh;
      }

      $hinhsanpham->save();
      
      return redirect('admin/hinhsanpham/sua/'.$idHinh)->with('thongbao','Cập nhật thành công');
    }
}
