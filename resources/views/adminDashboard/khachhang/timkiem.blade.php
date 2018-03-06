@extends('adminDashboard.layout.master')

@section('tittle')
    Danh sách khách hàng
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
                    <li class="">
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
                        <div class="col-md-12">

							@if (count($khachhang)>0)
                            <div class="">
                                Tìm thấy {{count($khachhang)}} khách hàng.
                            </div>
                            <div class="card">
                                <div class="card-header" data-background-color="purple">

                                    <div class="row">
                                        <div class="col-md-11">
                                            <h4 class="title">Danh sách khách hàng</h4>
                                        </div>
                                        <div class="col-md-1">
                                            <a href='admin/khachhang/them'><button type="button" class="btn-primary-outline btn-circle btn-lg"> + </button></a>
                                        </div>
                                    </div>    
                                    
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Mã</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Ngày sinh</th>
                                            <th>Điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày đăng kí</th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                            @foreach ($khachhang as $key=>$kh)
                                            <tr>
                                                <td>{{$kh->id}}</td>
                                                <td>{{$kh->HoTen}}</td>
                                                <td>{{$kh->Email}}</td>
                                                <td>{{$kh->NgaySinh}}</td>
                                                <td>{{$kh->DienThoai}}</td>
                                                <td>{{$kh->Diachi}}</td>
                                                <td>{{$kh->NgayDangKy}}</td>
                                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/khachhang/xoa/{{$kh->id}}" onclick="return xac_nhan_xoa('Bạn có chắc muốn xóa?')"> Delete</a></td>
                                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/khachhang/sua/{{$kh->id}}"> Edit</a></td>
                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							@endif

							@if (count($sanpham)>0)
                            <div class="">
                                Tìm thấy {{count($sanpham)}} sản phẩm.
                            </div>
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                        
                                    <div class="row">
                                        <div class="col-md-11">
                                            <h4 class="title">Danh sách các sản phẩm</h4>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="admin/sanpham/them"><button type="button" class="btn-primary-outline btn-circle btn-lg"> + </button></a>
                                        </div>
                                    </div>    
                                    
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Mã</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Hãng sản xuất</th>
                                            <th>Giá</th>
                                            <th>Khuyến mãi</th>
                                            <th>Tồn kho</th>
                                            <th>Sản phẩm mới</th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($sanpham as $key=>$sp)
                                            <tr>
                                                <td>{{$sp->idSP}}</td>
                                                <td>{{$sp->TenSP}}</td>
                                                <td>{{$sp->TenHangSX}}</td>
                                                <td>{{number_format($sp->GiaSP)}}</td>
                                                <td>{{$sp->GiaKhuyenMai}}</td>
                                                <td>{{$sp->TonKho}}</td>
                                                <td>{{$sp->SanPhamMoi}}</td>
                                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/sanpham/xoa/{{$sp->idSP}}" onclick="return xac_nhan_xoa('Bạn có chắc muốn xóa sản phẩm này?')"> Delete</a></td>
                                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sanpham/sua/{{$sp->idSP}}"> Edit</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							@endif
							
							@if(count($tintuc)>0)
							 <div class="">
                                Tìm thấy {{count($tintuc)}} tin tức.
                            </div>
								<div class="card">
                                <div class="card-header" data-background-color="purple">

                                    <div class="row">
                                        <div class="col-md-11">
                                            <h4 class="title">Danh sách tin tức</h4>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="admin/tintuc/them"><button type="button" class="btn-primary-outline btn-circle btn-lg"> + </button></a>
                                        </div>
                                    </div>    
                                    
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table">
                                        <thead class="text-primary">
                                            <th>Mã</th>
                                            <th>Loại</th>
                                            <th>Tiêu đề</th>
                                            <th>Tóm tắt</th>
                                            <th>Lần xem</th>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($tintuc as $key=>$t)
                                            <tr>
                                                <td>{{$t->idTin}}</td>
                                                <td>{{$t->TieuDeLoaiTin}}</td>
                                                <td>{{$t->TieuDe}}</td>
                                                <td>{{$t->TomTat}}</td>
                                                <td>{{$t->SoLanXem}}</td>
                                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$t->idTin}}" onclick="return xac_nhan_xoa('Bạn có chắc muốn xóa?')"> Delete</a></td>
                                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$t->idTin}}"> Edit</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							@endif

                        </div>
                    </div>

                </div>
            </div>

@endsection

							