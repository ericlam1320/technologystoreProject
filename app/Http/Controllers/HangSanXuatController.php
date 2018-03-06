<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HangSanXuat;
use App\SanPham;

class HangSanXuatController extends Controller
{
    public function getDanhSach(){

    	$hangsanxuat = HangSanXuat::all();

    	return view('adminDashboard.hangsanxuat.danhsach', compact('hangsanxuat'));
    }

    public function getThem(){

    	return view('adminDashboard.hangsanxuat.them');
    }

    public function postThem(Request $request){

    	$this->validate($request,[
                                  'tenHangSX' =>'required|unique:HangSanXuat,tenHangSX',
                                ],
                                [
                                  'tenHangSX.required'=>'Chưa nhập tên hãng sản xuất',
                                  'tenHangSX.unique' =>'Tên đã tồn tại',
                                ]);

        $HangSanXuat = new HangSanXuat;
        $HangSanXuat->TenHangSX = $request->tenHangSX;
        $HangSanXuat->save();

        return redirect('admin/hangsanxuat/them')->with('thongbao','Bạn đã thêm thành công');
    }

    public function getXoa($idHangSX){

        $so_sanpham_theo_hang = SanPham::with('HangSanXuat')->where('idHangSX',$idHangSX)->count();

        if($so_sanpham_theo_hang == 0){

            $hangsanxuat = HangSanXuat::find($idHangSX);
            $hangsanxuat->delete($idHangSX);

            return redirect('admin/hangsanxuat/danhsach')->with('thongbao', 'Xóa thành công');
        }else{

            return redirect('admin/hangsanxuat/danhsach')->with('loi', 'Xóa không thành công. Bạn không thể xóa hãng sản xuất này.');
        }

        
    }

    public function getSua($idHangSX){

        $hangsanxuat  = HangSanXuat::find($idHangSX);

        return view('adminDashboard.hangsanxuat.sua', compact('hangsanxuat'));
    }
    public function postSua($idHangSX, Request $request){

        $this->validate($request,[
                                  'tenHangSX' =>'required|unique:HangSanXuat,tenHangSX',
                                ],
                                [
                                  'tenHangSX.required'=>'Chưa nhập tên hãng sản xuất',
                                  'tenHangSX.unique' =>'Tên đã tồn tại',
                                ]);

        $HangSanXuat = HangSanXuat::find($idHangSX);
        $HangSanXuat->TenHangSX = $request->tenHangSX;
        $HangSanXuat->save();

        return redirect('admin/hangsanxuat/sua/' . $idHangSX )->with('thongbao','Bạn đã cập nhật thành công');
    }
}
