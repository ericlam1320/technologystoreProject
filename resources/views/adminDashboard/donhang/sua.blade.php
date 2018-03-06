@extends('adminDashboard.layout.master')

@section('tittle')
    Đơn hàng
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
                    <li >
                        <a href="{{ route('hangsanxuat') }}">
                            <i class="fa fa-building-o"></i>
                            <p>Hãng sản xuất</p>
                        </a>
                    </li>
                    <li>
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
                    <li class="active">
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

                            @if (session('loi'))
                            <div class="alert alert-danger">
                                {{session('loi')}} 
                            </div>
                            @endif

                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Cập nhật đơn hàng</h4>
                                </div>
                                <div class="card-content">

                                    <form method="POST" action="admin/donhang/sua/{{$donhang->idDonHang}}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Chọn khách hàng</label>
                                                    <select class="form-control" name="KhachHang" id="LoaiTin">
                                                      @foreach($khachhang as $k)
                                                        <option value="{{$k->id}}" @if($donhang->idKhachHang==$k->id) {{'selected'}} @endif>{{$k->HoTen}}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Ngày đặt hàng</label>
                                                    <input type="text" class="form-control" name="NgayDatHang" value="{{$donhang->NgayDatHang}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tên người nhận</label>
                                                    <input type="text" class="form-control" name="TenNguoiNhan" value="{{$donhang->TenNguoiNhan}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" class="form-control" name="email" value="{{$donhang->Email}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Số điện thoại</label>
                                                    <input type="text" class="form-control" name="sdt"
                                                    value="{{$donhang->DienThoai}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Ngày giao</label>
                                                    <input type="text" class="form-control" name="NgayGiaoHang" value="{{$donhang->NgayGiaoHang}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Địa điểm giao</label>
                                                    <input type="text" class="form-control" name="DiaDiem" value="{{$donhang->DiaDiemGiao}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Ghi chú</label>
                                                    <input type="text" class="form-control" name="GhiChu" value="{{$donhang->GhiChu}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Trạng thái giao hàng</label>
                                                    <input type="text" class="form-control" name="TrangThaiGiaoHang" value="{{$donhang->TrangThaiGiaoHang}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Trạng thái thanh toán</label>
                                                    <input type="text" class="form-control" name="TrangThaiThanhToan" value="{{$donhang->TrangThaiThanhToan}}">
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