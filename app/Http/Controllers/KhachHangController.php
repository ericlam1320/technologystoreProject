<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

use App\KhachHang;
use App\DonHang;
use App\SanPham;
use App\Tin;
use DB;

class KhachHangController extends Controller
{
    
    public function getDashboard(){

    	$dashboard = DB::table('khachhang')
    				->join('donhang', 'donhang.idKhachHang', '=', 'khachhang.id') // Gộp bảng
    				->get([
    						'khachhang.id',
    					 	'HoTen', 
    					 	'khachhang.DienThoai',
    					    'Diachi', 
    					    'NgayGiaoHang', 
    					    'TrangThaiGiaoHang', 
    					    'TrangThaiThanhToan'
    					]);

    	return view('adminDashboard.page.dashboard', compact('dashboard'));
    }
    public function getDanhSach(){

        $khachhang = KhachHang::all();

    	return view('adminDashboard.khachhang.danhsach', compact('khachhang'));
    }

    public function getThem(){

        return view('adminDashboard.khachhang.them');
    }

    public function postThem(Request $request){

       $this->validate($request,[
        'tenKhachHang'=>'required',
        'emailKhachHang'=> 'required|email|unique:khachhang,Email', // không trùng : tên bảng, tên cột
        'matkhauKhachHang'=>'required|min:6',
        'matkhaunhaplaiKhachHang' => 'required|same:matkhauKhachHang',
        'diachiKhachHang'=>'required',
        'dienthoaiKhachHang'=>'required|numeric|regex:/(0)[0-9]{9,10}/'

        
      ],
      [
        'tenKhachHang.required'=>'Chưa nhập tên',
        'emailKhachHang.required'=>'Chưa nhập email',
        'emailKhachHang.email'=>'Email không đúng định dạng',
        'emailKhachHang.unique'=>'Email đã tồn tại',
        'matkhauKhachHang.required'=>'Chưa nhập mật khẩu.',
        'matkhauKhachHang.min'=>'Mật khẩu phải có ít nhất 6 kí tự.',
        'matkhaunhaplaiKhachHang.required'=>'Chưa nhập lại mật khẩu.',
        'matkhaunhaplaiKhachHang.same'=>'Mật khẩu nhập lại chưa khớp',
        'diachiKhachHang.required'=>'Bạn chưa nhập địa chỉ.',
        'dienthoaiKhachHang.required'=>'Bạn chưa nhập số điện thoại.',
        'dienthoaiKhachHang.numeric'=>'Số điện thoại bạn nhập chưa đúng.',
        'dienthoaiKhachHang.regex'=>'Số điện thoại bạn nhập chưa đúng. Số điện thoại phải là 10 số hoặc 11 số.'

      ]);

      $khachhang = new KhachHang;
      $khachhang ->HoTen = $request->tenKhachHang;
      $khachhang ->Email = $request->emailKhachHang;
      $khachhang ->password = Hash::make($request->matkhauKhachHang);   //bcrypt: mã hóa pass
      $khachhang ->DienThoai = $request->dienthoaiKhachHang;
      $khachhang ->DiaChi = $request->diachiKhachHang;
      $khachhang ->NgaySinh = $request->ngaysinhKhachHang;
      $khachhang ->GioiTinh = $request->gioitinh;
      $khachhang ->NgayDangKy = $request->ngaydangkyKhachHang;
      $khachhang ->KichHoat = $request ->kichhoat;
      // $khachhang ->remember_token = 0;

      $khachhang->save();

      return redirect('admin/khachhang/them')->with('thongbao','Thêm thành công');
    }

    public function getXoa($idKhachHang){

        $khachhang = KhachHang::find($idKhachHang);
        $khachhang->delete();

        return redirect('admin/khachhang/danhsach')->with('thongbao', 'Xóa thành công');
    }

    public function getSua($idKhachHang){

        $khachhang = KhachHang::find($idKhachHang);

        return view('adminDashboard.khachhang.sua', compact('khachhang'));
    }

    public function postSua($idKhachHang, Request $request){

        $this->validate($request,[
        'tenKhachHang'=>'required',
        'diachiKhachHang'=>'required',
        'dienthoaiKhachHang'=>'required|numeric|regex:/(0)[0-9]{9,10}/'
      ],
      [
        'tenKhachHang.required'=>'Chưa nhập tên',
        'diachiKhachHang.required'=>'Bạn chưa nhập địa chỉ.',
        'dienthoaiKhachHang.required'=>'Bạn chưa nhập số điện thoại.',
        'dienthoaiKhachHang.numeric'=>'Số điện thoại bạn nhập chưa đúng.',
        'dienthoaiKhachHang.regex'=>'Số điện thoại bạn nhập chưa đúng. Số điện thoại phải là 10 số hoặc 11 số.'


      ]);

      $khachhang = KhachHang::find($idKhachHang);
      $khachhang->HoTen = $request->tenKhachHang;
      $khachhang->DienThoai = $request->dienthoaiKhachHang;
      $khachhang->DiaChi = $request->diachiKhachHang;
      $khachhang->NgaySinh = $request->ngaysinhKhachHang;
      $khachhang->GioiTinh = $request->gioitinh;
      $khachhang->NgayDangKy = $request->ngaydangkyKhachHang;
      $khachhang->KichHoat = $request ->kichhoat;

      if($request->changePassword ==  "on"){
        $this->validate($request,[
          'matkhauKhachHang'=>'required|min:6',
          'matkhaunhaplaiKhachHang' => 'required|same:matkhauKhachHang',
        ],
        [
           'matkhauKhachHang.required'=>'Chưa nhập mật khẩu.',
           'matkhauKhachHang.min'=>'Mật khẩu phải có ít nhất 6 kí tự.',
           'matkhaunhaplaiKhachHang.required'=>'Chưa nhập lại mật khẩu.',
           'matkhaunhaplaiKhachHang.same'=>'Mật khẩu nhập lại chưa khớp'
        ]);

        $khachhang->password = Hash::make($request->matkhauKhachHang);   //bcrypt: mã hóa pass

      }

      $khachhang->save();

      return redirect('admin/khachhang/sua/' . $idKhachHang)->with('thongbao','Cập nhật thành công');
    }

    public function getSearch(Request $request){

      $khachhang = KhachHang::where('HoTen', 'like', '%'.$request->key.'%')->get();
      $sanpham = SanPham::where('TenSP', 'like', '%'.$request->key.'%')->get();
      $tintuc  = Tin::where('TieuDe', 'like', '%'.$request->key.'%')->get();

      return view('adminDashboard.khachhang.timkiem',compact('khachhang', 'sanpham', 'tintuc'));
    }

    public function getLogin(){
        return view('adminDashboard.login');
    }
    public function postLogin(Request $request){

         $this->validate($request,[
            'username'=>'required|email',
            'password'=>'required'
          ],[
            'username.required' => 'Bạn chưa nhập tên đăng nhập.',
            'username.email' => 'Tên đăng nhập phải là email.',
            'password.required' => 'Bạn chưa nhập mật khẩu.'
          ]);

        $login = array(
            'Email' => $request->username,
            'password' => $request->password,
            'KichHoat'=> 1
        );
        if(Auth::attempt($login)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('thongbao', 'Tên đăng nhập hoặc mật khẩu không đúng.');
        }
    }
    public function getLogout(){
      Auth::logout();
      return redirect('dangnhap');
    }
}
