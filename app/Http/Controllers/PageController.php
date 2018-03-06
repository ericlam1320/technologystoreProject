<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use App\SanPham;
use App\HangSanXuat;
use App\Tin;
use App\HinhSanPham;
use App\KhachHang;
use App\DonHang;
use App\ChiTietDonHang;
use App\BinhLuan;
use Cart;
use DB, Mail;

class PageController extends Controller
{
    
    public function getIndex(){

    	$san_pham_moi = SanPham::where('SanPhamMoi', 1)->orderBy('idSP','DESC')->limit(8)->get();
    	$san_pham_noi_bat = SanPham::OrderBy('SoLanXem', 'DESC')->limit(8)->get();
    	$san_pham_giam_gia = SanPham::where('GiaKhuyenMai', '<>', 0)->limit(3)->get();
    	$san_pham_ban_chay = SanPham::OrderBy('SoLanMua', 'DESC')->limit(3)->get();
    	$phu_kien = SanPham::where('idLoaiSP', '3')->limit(3)->get();

    	//dd($san_pham_ban_chay);

    	$tin_tuc = Tin::orderBy('idTin','DESC')->limit(6)->get();

    	return view('clientStore.page.trangchu', compact('san_pham_moi','san_pham_noi_bat', 'tin_tuc','san_pham_giam_gia', 'san_pham_ban_chay', 'phu_kien'));
    }



    public function getContact(){
        
        return view('clientStore.page.lienhe');
    }
    public function postContact(Request $request){

        $data = ['hoten'=>$request->hoten,'tinnhan'=>$request->message];
        Mail::send('clientStore.page.mail',$data,function($message) use($request){
            $message->from('mail.technologystore96@gmail.com', 'technologyStore.tk');
            $message->to($request->email)->subject("Cảm ơn bạn đã góp ý với chúng tôi. Chúng tôi sẽ trả lời mail cho bạn sớm nhất.");

            echo "<script>
   
            alert('Cảm ơn bạn đã góp ý. Chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất.');
            window.location='".url('./')."'

            </script>";
        });
    }



    public function getNews(){

        $tintuc = Tin::all();
        return view('clientStore.page.tintuc', compact('tintuc'));
    }
    public function getProduct(){

        //$sanpham = SanPham::all();
        $sanpham = SanPham::paginate(8);
        return view('clientStore.page.sanpham', compact('sanpham'));
    }
    public function getNewsDetail($tin){

        $tintuc = Tin::where('idTin', $tin)->first();
        $binhluan = BinhLuan::where('idTin',$tin)->get();
        $so_binhluan = BinhLuan::where('idTin',$tin)->count();
        return view('clientStore.page.tintuc_chitiet', compact('tintuc', 'binhluan', 'so_binhluan'));
    }
    public function postNewsDetail($tin, Request $request){

        $this->validate($request,[
        'NoiDungBinhLuan' => 'required|min:10',
      ],
      [
        
        'NoiDungBinhLuan.required'=>'Chưa nhập chi tiết',
        'NoiDungBinhLuan.min'=>'Bình luận phải tối thiểu 10 ký tự'

      ]);

        $binhluan = new BinhLuan;
        $binhluan->idTin = $tin;
        $binhluan->idKhachHang = 1;
        $binhluan->NgayDang = date('Y-m-d');
        $binhluan->NoiDungBinhLuan = $request->NoiDungBinhLuan;
        $binhluan->save();
 
        return redirect()->back();
    }


    public function getMuaHang($idSanPham){

        $sanpham = DB::table('sanpham')->where('idSP', $idSanPham)->first();

        if($sanpham->GiaKhuyenMai != 0){

             Cart::add(array('id'=>$idSanPham, 'name'=>$sanpham->TenSP, 'qty'=>1, 'price'=>$sanpham->GiaKhuyenMai, 'options'=>array('img'=>$sanpham->urlHinhSP, 'id'=>$sanpham->idSP)));
        }
        else{

            Cart::add(array('id'=>$idSanPham, 'name'=>$sanpham->TenSP, 'qty'=>1, 'price'=>$sanpham->GiaSP, 'options'=>array('img'=>$sanpham->urlHinhSP, 'id'=>$sanpham->idSP)));
        }
        
        $content = Cart::content();
        //print_r($content);
        //return redirect()->route('giohang');
        return redirect()->back()->with('error',5);
    }
    public function getGioHang(){

        $content = Cart::content();
        $total   = Cart::subtotal(0,',','.');
        //print_r($total);
        return view('clientStore.page.giohang', compact('content', 'total'));
    }
    public function getXoaHang($idSanPham){

        Cart::remove($idSanPham);
        return redirect()->back();
    }
    public function getCapNhat(){
        if(Request::ajax()){
            $id = Request::get('id');
            $qty = Request::get('qty');
            Cart::update($id, $qty);
            echo 'true';
        }
    }
    public function getCheckout(){

        return view('clientStore.page.thanhtoan');
    }
    public function postCheckout(Request $request){

        $khachhang = new KhachHang;
        $khachhang->HoTen=$request->hoten;
        $khachhang->password=0;
        $khachhang->NgaySinh=date('Y-m-d');
        $khachhang->NgayDangKy=date('Y-m-d');
        $khachhang->KichHoat=0;
        $khachhang->remember_token=0;
        $khachhang->Email=$request->email;
        $khachhang->DienThoai=$request->sodienthoai;
        $khachhang->DiaChi=$request->diachi;
        $khachhang->GioiTinh=$request->gioitinh;
        $khachhang->save();

        $donhang = new DonHang;
        $donhang->idKhachHang=$khachhang->id;
        $donhang->NgayDatHang=date('Y-m-d');
        $donhang->NgayGiaoHang=date('Y-m-d');
        $donhang->TrangThaiGiaoHang=0;
        $donhang->TrangThaiThanhToan=0;
        $donhang->TenNguoiNhan=$request->hoten;
        $donhang->DiaDiemGiao=$request->diachi;
        $donhang->DienThoai=$request->sodienthoai;
        $donhang->Email=$request->email;
        $donhang->GhiChu=$request->ghichu;
        $donhang->save();

        $total=Cart::subtotal(0,',','');
        $content=Cart::content();
        foreach($content as $key=>$value){
            $chitietdonhang = new ChiTietDonHang;
            $chitietdonhang->idDonHang=$donhang->idDonHang;
            $chitietdonhang->idSP=$value->options->id;
            $chitietdonhang->SoLuong=$value->qty;
            $chitietdonhang->GiaSP=$value->price;
            $chitietdonhang->GiaKhuyenMai=0;
            $chitietdonhang->ThanhTien=$total;
            $chitietdonhang->save();
        }

        
        $data = ['hoten'=>$request->hoten];
        Mail::send('clientStore.page.mailXacNhan',$data,function($message) use($request){
            $message->from('mail.technologystore96@gmail.com', 'technologyStore.tk');
            $message->to($request->email)->subject("Xác nhận đơn hàng.");
        });

        Cart::destroy();

        return redirect()->back()->with('thongbao', 'Đặt hàng thành công. Bạn vui lòng xác nhận email.');

    }




    public function getProductDetail($id_sanpham){

        $chitiet = SanPham::where('idSP', $id_sanpham)->first();
        //$sanpham_lienquan = SanPham::where('idHangSX', $chitiet->idHangSX)->limit(8)->get(); // giới hạn 8 
        $sanpham_lienquan = SanPham::where('idLoaiSP', $chitiet->idLoaiSP)->limit(8)->get();
        $hinhsanpham = HinhSanPham::where('idSP', $id_sanpham)->get();
        return view('clientStore.page.sanpham_chitiet', compact('chitiet', 'sanpham_lienquan','hinhsanpham'));
    }
    public function getProductByProvider($id_hangSX){

        $sanpham_hangSX = SanPham::where('idHangSX', $id_hangSX)->get();
        $hangsanxuat = HangSanXuat::where('idHangSX', $id_hangSX)->first();
        return view('clientStore.page.sanpham_theoHangSX', compact('sanpham_hangSX', 'hangsanxuat'));
    }
    public function getMayTinhBang(){

        $sanpham = SanPham::where('idLoaiSP', 2)->get();
        return view('clientStore.page.maytinhbang', compact('sanpham'));
    }
    public function getSanPhamMoi(){

        $sanpham = SanPham::where('SanPhamMoi', 1)->get();
        return view('clientStore.page.sanphammoi', compact('sanpham'));
    }
    public function getSanPhamBanChay(){

        $sanpham = SanPham::orderBy('SoLanMua', 'DESC')->get();
        return view('clientStore.page.sanphambanchay', compact('sanpham'));
    }
    public function getSanPhamKhuyenMai(){

        $sanpham = SanPham::where('GiaKhuyenMai', '<>', 0)->get();
        return view('clientStore.page.sanphamkhuyenmai', compact('sanpham'));
    }
    public function getPhuKien(){

        $sanpham = SanPham::where('idLoaiSP', 3)->get();
        return view('clientStore.page.phukien', compact('sanpham'));
    }


    public function getSearch(Request $request){

        $sanpham = SanPham::where('TenSP', 'like', "%".$request->key."%")->paginate(8);
        $key = $request->key;
        return view('clientStore.page.danhsachtimkiem', compact('sanpham', 'key'));
    }


    public function getGiaTangDan(){
        $sanpham = SanPham::orderBy('GiaSP', 'ASC')->paginate(8);
        return view('clientStore.page.sanpham', compact('sanpham'));
    }
    public function getGiaGiamDan(){
        $sanpham = SanPham::orderBy('GiaSP', 'DESC')->paginate(8);
        return view('clientStore.page.sanpham', compact('sanpham'));
    }
    public function getSearchGiaTangDan($key){
        $sanpham = SanPham::where('TenSP', 'like', "%".$key."%")->orderBy('GiaSP', 'ASC')->paginate(8);
        $key = $key;
        return view('clientStore.page.danhsachtimkiem', compact('sanpham', 'key'));
    }
    public function getSearchGiaGiamDan($key){
        $sanpham = SanPham::where('TenSP', 'like', "%".$key."%")->orderBy('GiaSP', 'DESC')->paginate(8);
        $key = $key;
        return view('clientStore.page.danhsachtimkiem', compact('sanpham', 'key'));
    }


    public function getIntroduce(){

        return view('clientStore.page.gioithieu');
    }
    public function getWarranty(){

        return view('clientStore.page.chinhsachbaohanh');
    }
    public function getChinhSachTraGop(){

        return view('clientStore.page.chinhsachtragop');
    }
    public function getChinhSachDoiTra(){

        return view('clientStore.page.chinhsachdoitra');
    }

}
