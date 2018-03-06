@extends('adminDashboard.layout.master')

@section('tittle')
    Cập nhật Sản Phẩm
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
    <style type="text/css" media="screen">
    .hinh{
        width: 200px !important;
    }
    </style>

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
                                    <h4 class="title">Cập nhật sản phẩm</h4>
                                </div>
                                <div class="card-content">

                                    <form method="POST" action="admin/sanpham/sua/{{$sanpham->idSP}}" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Chọn loại sản phẩm</label>
                                                    <select class="form-control" name="LoaiSanPham" id="LoaiSanPham">
                                                      @foreach($loaisp as $loai)
                                                        <option value="{{$loai->idLoaiSP}}" @if($sanpham->idLoaiSP == $loai->idLoaiSP) {{'selected'}} @endif>{{$loai->TenLoaiSP}}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Chọn hãng sản xuất</label>
                                                    <select class="form-control" name="HangSX" id="HangSX">
                                                      @foreach($hangSX as $hang)
                                                        <option value="{{$hang->idHangSX}}" @if($sanpham->idHangSX == $hang->idHangSX) {{'selected'}} @endif>{{$hang->TenHangSX}}</option>
                                                      @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tên sản phẩm</label>
                                                    <input type="text" class="form-control" name="tenSP" value="{{$sanpham->TenSP}}">
                                                </div>
                                            </div>   
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Giá sản phẩm</label>
                                                    <input type="text" class="form-control" name="giaSP" value="{{$sanpham->GiaSP}}">
                                                </div>
                                            </div>   
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Giá khuyến mãi</label>
                                                    <input type="text" class="form-control" name="khuyenmaiSP" value="{{$sanpham->GiaKhuyenMai}}">
                                                </div>
                                            </div>   
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label class="control-label">Mô tả</label>
                                                    <textarea id="demo" class="form-control ckeditor" rows="8" name="mota">{{$sanpham->MoTaSP}}</textarea>
                                                    <script type="text/javascript">ckeditor("mota")</script>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label class="control-label">Chi tiết</label>
                                                    <textarea id="demo" class="form-control ckeditor" rows="8" name="chitiet">{{$sanpham->ChiTietSP}}</textarea>
                                                    <script type="text/javascript">ckeditor("chitiet")</script>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                  <label class="control-label">Hình ảnh</label>
                                                  <img class="hinh" src="clientassets/upload/sanpham/{{$sanpham->urlHinhSP}}" alt="">
                                                  <input type="hidden" name="hinh_sp" value="{{$sanpham->urlHinhSP}}">
                                                  <input type="file" name="hinh" value="{{old('hinh_sp')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Ngày đăng</label>
                                                    <input type="date" class="form-control date" placeholder="Ngày đăng"  name="ngaydang" value="<?= date('Y-m-d') ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Tồn kho</label>
                                                    <input type="number" value="{{$sanpham->TonKho}}" class="form-control"  name="tonkho">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Ghi chú</label>
                                                    <input type="text" value="{{$sanpham->GhiChu}}" class="form-control"  name="ghichu">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Số lần mua</label>
                                                    <input type="number" value="{{$sanpham->SoLanMua}}" class="form-control"  name="solanmua">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Số lần xem</label>
                                                    <input type="number" value="{{$sanpham->SoLanXem}}" class="form-control"  name="solanxem">
                                                </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Sản phẩm mới</label>
                                                    <input type="number" value="{{$sanpham->SanPhamMoi}}" class="form-control"  name="sanphammoi">
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