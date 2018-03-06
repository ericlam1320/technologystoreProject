@extends('adminDashboard.layout.master')

@section('tittle')
    Sản Phẩm
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
                    <li class="active">
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
                            @if(session('thongbao'))
                                  <div class="alert alert-success">
                                    {{session('thongbao')}}
                                  </div>
                                @endif
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
                                                <td>{{number_format($sp->GiaKhuyenMai)}}</td>
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
                        </div>
                    </div>

                </div>
            </div>

@endsection