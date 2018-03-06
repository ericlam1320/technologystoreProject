@extends('adminDashboard.layout.master')

@section('tittle')
    Cập nhật khách hàng
@endsection

@section('sidebar')

    <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hangsanxuat') }}">
                            <i class="fa fa-building-o"></i>
                            <p>Hãng sản xuất</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ route('khachhang') }}">
                            <i class="fa fa-users fa-fw"></i>
                            <p>Khách hàng</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loaisanpham') }}">
                            <i class="fa fa-list"></i>
                            <p>Loại sản phẩm</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('loaitin') }}">
                            <i class="fa fa-list"></i>
                            <p>Loại tin tức</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sanpham') }}">
                            <i class="fa fa-archive"></i>
                            <p>Sản phẩm</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tintuc') }}">
                            <i class="fa fa-newspaper-o"></i>
                            <p>Tin tức</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('donhang') }}">
                            <i class="fa fa-cart-plus"></i>
                            <p>Đơn hàng</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('chitietdonhang') }}">
                            <i class="fa fa-file-text"></i>
                            <p>Chi tiết đơn hàng</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('hinhsanpham') }}">
                            <i class="fa fa-picture-o"></i>
                            <p>Hình sản phẩm</p>
                        </a>
                    </li>
                </ul>
            </div>

@endsection

@section('content')

    <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">  <!--div đỏ  -->
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                                </div>
                            @endif

                            @if (session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}} 
                            </div>
                            @endif

                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Cập nhật khách hàng</h4>
                                </div>
                                <div class="card-content">

                                    <form method="POST" action="admin/khachhang/sua/{{$khachhang->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Họ tên</label>
                                                    <input type="text" class="form-control" name="tenKhachHang" value="{{ $khachhang->HoTen }}">
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Địa chỉ Email</label>
                                                    <input type="email" class="form-control" name="emailKhachHang" value="{{ $khachhang->Email }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <br>
                                                <label class="checkbox-inline"><input type="checkbox" name="changePassword" id="changePassword"> Đổi mật khẩu</label>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                   
                                                    <label class="control-label">Mật khẩu</label>
                                                    <input type="password" class="form-control password"  name="matkhauKhachHang" value="{{ $khachhang->MatKhau }}"  disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Nhập lại mật khẩu</label>
                                                    <input type="password" class="form-control password"  name="matkhaunhaplaiKhachHang" value="{{ $khachhang->MatKhau }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Địa chỉ</label>
                                                    <input type="text" class="form-control" name="diachiKhachHang" value="{{ $khachhang->Diachi }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Điện thoại</label>
                                                    <input type="text" class="form-control" name="dienthoaiKhachHang" value="{{ $khachhang->DienThoai }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Ngày sinh</label>
                                                    <input type="date" class="form-control date" placeholder="Ngày sinh"  name="ngaysinhKhachHang" value="{{ $khachhang->NgaySinh }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Ngày đăng ký</label>
                                                    <input type="date" class="form-control date" placeholder="Ngày đăng ký"  name="ngaydangkyKhachHang" value="{{ $khachhang->NgayDangKy }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label><input type="radio" name="gioitinh" value="1" {{$khachhang->GioiTinh == 1 ? 'checked' : ''}}> Nam</label>
                                                    <label><input type="radio" name="gioitinh" value="0" {{$khachhang->GioiTinh == 0 ? 'checked' : ''}}> Nữ</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label><input type="radio" name="kichhoat" value="1" @if($khachhang->KichHoat == 1) {{"checked"}} @endif> Admin</label>
                                                     <label><input type="radio" name="kichhoat" value="0"@if($khachhang->KichHoat == 0) {{"checked"}} @endif> Khách hàng</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                                        <div class="clearfix"></div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>



@endsection
