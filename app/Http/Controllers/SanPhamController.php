<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SanPham;
use App\HangSanXuat;
use App\LoaiSanPham;
use DB;

class SanPhamController extends Controller
{
    public function getDanhSach(){

    	$sanpham = DB::table('sanpham')
    				  ->join('hangsanxuat', 'sanpham.idHangSX', 'hangsanxuat.idHangSX')
    				  ->get([

    				  	     'idSP',
    				  	     'TenHangSX',
    				  	     'TenSP',
    				  	     'GiaSP',
    				  	     'GiaKhuyenMai',
    				  	     'TonKho',
    				  	     'SanPhamMoi'

    				  ]);

    	return view('adminDashboard.sanpham.danhsach', compact('sanpham'));
    }

    public function getThem(){

        $loaisp = LoaiSanPham::all();
        $hangSX = HangSanXuat::all();

        return view('adminDashboard.sanpham.them', compact('loaisp', 'hangSX'));
    }
    public function postThem(Request $request){

    $this->validate($request,[
        'tenSP'=>'required|unique:sanpham,TenSP',
        'giaSP'=>'required|numeric', 
        'mota'=> 'required',
        'chitiet'=>'required'
      ],
      [
        'tenSP.required' => 'Chưa nhập tên sản phẩm.',
        'tenSP.unique'=>'Tên đã tồn tại',
        'giaSP.required'=>'Chưa nhập giá',
        'giaSP.numeric'=>'Giá phải là số',
        'mota.required' =>'Chưa nhập mô tả',
        'chitiet.required'=>'Chưa nhập chi tiết'
      ]);

      $sanpham = new SanPham;
      $sanpham->idLoaiSP = $request->LoaiSanPham;
      $sanpham->idHangSX = $request->HangSX;    
      $sanpham->TenSP = $request->tenSP;
      $sanpham->GiaSP = $request->giaSP;
      $sanpham->GiaKhuyenMai = $request->khuyenmaiSP;
      $sanpham->MoTaSP = $request->mota;
      $sanpham->ChiTietSP = $request->chitiet;
      $sanpham->NgayDang = $request->ngaydang;
      $sanpham->TonKho = $request->tonkho;
      $sanpham->GhiChu = $request->ghichu;
      $sanpham->SoLanMua = $request->solanmua;
      $sanpham->SoLanXem = $request->solanxem;
      $sanpham->SanPhamMoi = $request->sanphammoi;

      if ($request->hasFile('hinh')) {  //ktra có up hình or not
        $file = $request->file('hinh');
        $duoi = $file->getClientOriginalExtension();  //lấy đuôi file
        if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
          return redirect('admin/sanpham/them')->with('loi',' Chỉ được chọn file có phần mở rộng là jpg, jpeg, png');
        }
        $name = $file->getClientOriginalName();  //lấy tên hình nguyên bản
        $hinh = str_random(4)."_".$name;  //tên hình khi save lại : "4 ký tự random" + "_" + name nguyên bản
        while (file_exists("clientassets/upload/sanpham/".$hinh)) {  //ktra đã tồn tại hình có tên tương tự chưa
          $hinh = str_random(4)."_".$name;    //thì random tiếp
        }
        $file->move("clientassets/upload/sanpham/",$hinh);  // move hình đã upload vào folder upload
        $sanpham->urlHinhSP = $hinh;
      }
      else {
        $sanpham->urlHinhSP = "";
      }

      $sanpham->save();
      
      return redirect('admin/sanpham/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($idSP){

        $sanpham = SanPham::find($idSP);
        $sanpham->delete();

        return redirect('admin/sanpham/danhsach')->with('thongbao', 'Đã xoá thành công.');
    }

    public function getSua($idSP){

        $loaisp  = LoaiSanPham::all();
        $hangSX  = HangSanXuat::all();
        $sanpham = SanPham::find($idSP);

        return view('adminDashboard.sanpham.sua', compact('loaisp', 'hangSX', 'sanpham'));
    }
    public function postSua($idSP, Request $request){

    $this->validate($request,[
        'tenSP'=>'required',
        'giaSP'=>'required|numeric', 
        'mota'=> 'required',
        'chitiet'=>'required'
      ],
      [
        'tenSP.required' => 'Chưa nhập tên sản phẩm.',
        'giaSP.required'=>'Chưa nhập giá',
        'giaSP.numeric'=>'Giá phải là số',
        'mota.required' =>'Chưa nhập mô tả',
        'chitiet.required'=>'Chưa nhập chi tiết'
      ]);

      $sanpham = SanPham::find($idSP);
      $sanpham->idLoaiSP = $request->LoaiSanPham;
      $sanpham->idHangSX = $request->HangSX;    
      $sanpham->TenSP = $request->tenSP;
      $sanpham->GiaSP = $request->giaSP;
      $sanpham->GiaKhuyenMai = $request->khuyenmaiSP;
      $sanpham->MoTaSP = $request->mota;
      $sanpham->ChiTietSP = $request->chitiet;
      $sanpham->NgayDang = $request->ngaydang;
      $sanpham->TonKho = $request->tonkho;
      $sanpham->GhiChu = $request->ghichu;
      $sanpham->SoLanMua = $request->solanmua;
      $sanpham->SoLanXem = $request->solanxem;
      $sanpham->SanPhamMoi = $request->sanphammoi;

      if ($request->hasFile('hinh')) {  //ktra có up hình or not
        $file = $request->file('hinh');
        $duoi = $file->getClientOriginalExtension();  //lấy đuôi file
        if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
          return redirect('admin/sanpham/them')->with('loi',' Chỉ được chọn file có phần mở rộng là jpg, jpeg, png');
        }
        $name = $file->getClientOriginalName();  //lấy tên hình nguyên bản
        $hinh = str_random(4)."_".$name;  //tên hình khi save lại : "4 ký tự random" + "_" + name nguyên bản
        while (file_exists("clientassets/upload/sanpham/".$hinh)) {  //ktra đã tồn tại hình có tên tương tự chưa
          $hinh = str_random(4)."_".$name;    //thì random tiếp
        }
        $file->move("clientassets/upload/sanpham/",$hinh);  // move hình đã upload vào folder upload
        $sanpham->urlHinhSP = $hinh;
      }

      $sanpham->save();
      
      return redirect('admin/sanpham/sua/'.$idSP)->with('thongbao','Cập nhật thành công');
    }
}
