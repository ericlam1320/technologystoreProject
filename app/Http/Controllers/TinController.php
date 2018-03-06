<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tin;
use App\LoaiTin;
use DB;

class TinController extends Controller
{
    public function getDanhSach(){

    	$tin = DB::table('tin')
    			  ->join('loaitin', 'loaitin.idLoaiTin', 'tin.idLoaiTin')
    			  
    			  ->get([

    			  		'idTin',
    			  		'loaitin.idLoaiTin',
    			  		'TieuDe',
    			  		'TomTat',
    			  		'SoLanXem',
    			  		'TieuDeLoaiTin'

    			  ]);

    	return view('adminDashboard.tintuc.danhsach', compact('tin'));
    }

    public function getThem(){

        $loai = LoaiTin::all();
        $tin  = Tin::all();

        return view('adminDashboard.tintuc.them', compact('loai', 'tin'));
    }
    public function postThem(Request $request){
      $this->validate($request,[
        'LoaiTin'=>'required',
        'tieuDe'=>'required|min:3|unique:tin,TieuDe',  //Tên ko empty, ko trùng vs Tin tức tiêu đề
        'tomTat'=> 'required',
        'noiDung'=>'required'
      ],
      [
        'LoaiTin.required' => 'Chưa chọn loại tin ',
        'tieuDe.required'=>'Chưa nhập tiêu đề',
        'tieuDe.min'=>'Tiêu đề quá ngắn',
        'tieuDe.unique'=>'Tiêu đề đã tồn tại',
        'tomTat.required' =>'Chưa nhập tóm tắt',
        'noiDung.required'=>'Chưa nhập nội dung'
      ]);

      $tintuc = new Tin;
      $tintuc->TieuDe = $request->tieuDe;
      $tintuc->idLoaiTin = $request->LoaiTin;
      $tintuc->TomTat = $request->tomTat;
      $tintuc->NoiDung = $request->noiDung;
      $tintuc->NgayDang = $request->ngayDang;
      $tintuc->SoLanXem = $request->soLanXem;

      if ($request->hasFile('hinh')) {  //ktra có up hình or not
        $file = $request->file('hinh');
        $duoi = $file->getClientOriginalExtension();  //lấy đuôi file
        if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
          return redirect('admin/tintuc/them')->with('loi',' Chỉ được chọn file có phần mở rộng là jpg, jpeg, png');
        }
        $name = $file->getClientOriginalName();  //lấy tên hình nguyên bản
        $hinh = str_random(4)."_".$name;  //tên hình khi save lại : "4 ký tự random" + "_" + name nguyên bản
        while (file_exists("clientassets/upload/tintuc/".$hinh)) {  //ktra đã tồn tại hình có tên tương tự chưa
          $hinh = str_random(4)."_".$name;    //thì random tiếp
        }
        $file->move("clientassets/upload/tintuc/",$hinh);  // move hình đã upload vào folder upload
        $tintuc->urlHinhTin = $hinh;
      }
      else {
        $tintuc->urlHinhTin = "";
      }

      $tintuc->save();
      
      return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($idTin){

        $tintuc = Tin::find($idTin);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Đã xoá thành công.');
    }

    public function getSua($idTin){

        $loai = LoaiTin::all();
        $tin  = Tin::find($idTin);

        return view('adminDashboard.tintuc.sua', compact('loai', 'tin'));
    }
    public function postSua($idTin, Request $request){

    $this->validate($request,[
            'tieuDe'=>'required',  
            'tomTat'=> 'required',
            'noiDung'=>'required'
          ],
          [
            'tieuDe.required'=>'Chưa nhập tiêu đề',
            'tomTat.required' =>'Chưa nhập tóm tắt',
            'noiDung.required'=>'Chưa nhập nội dung'
          ]);

          $tintuc = Tin::find($idTin);
          $tintuc->TieuDe = $request->tieuDe;
          $tintuc->idLoaiTin = $request->LoaiTin;
          $tintuc->TomTat = $request->tomTat;
          $tintuc->NoiDung = $request->noiDung;
          $tintuc->NgayDang = $request->ngayDang;
          $tintuc->SoLanXem = $request->soLanXem;

          if ($request->hasFile('hinh')) {  //ktra có up hình or not
        $file = $request->file('hinh');
        $duoi = $file->getClientOriginalExtension();  //lấy đuôi file
        if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
          return redirect('admin/tintuc/them')->with('loi',' Chỉ được chọn file có phần mở rộng là jpg, jpeg, png');
        }
        $name = $file->getClientOriginalName();  //lấy tên hình nguyên bản
        $hinh = str_random(4)."_".$name;  //tên hình khi save lại : "4 ký tự random" + "_" + name nguyên bản
        while (file_exists("clientassets/upload/tintuc/".$hinh)) {  //ktra đã tồn tại hình có tên tương tự chưa
          $hinh = str_random(4)."_".$name;    //thì random tiếp
        }
        $file->move("clientassets/upload/tintuc/",$hinh);  // move hình đã upload vào folder upload
        $tintuc->urlHinhTin = $hinh;
      }

          $tintuc->save();
          
          return redirect('admin/tintuc/sua/'. $idTin)->with('thongbao','Cập nhật thành công');
    }
}
