@extends ('clientStore.layout.master')

@section ('content')
<div class="main">
            <div class="container">
                <div class="row" style="margin-top: 20px;"></div>
                <div class="row">
                    <div class="col-sm-9 col-right">


                        
                        <div class="product-view">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="product-img-box">
                                        <p class="product-image">
                                            <a href="#" class="cloud-zoom" id="ma-zoom1">
                                                <img src="clientassets/upload/sanpham/{{$chitiet->urlHinhSP}}" alt="Fusce aliquam" title="Fusce aliquam" />
                                            </a>
                                        </p>
                                        <div class="more-views thumbnail-container">
                                            <ul class="bxslider">

                                                @foreach ($hinhsanpham as $hinh)
                                                <li class="thumbnail-item">
                                                    <a href="clientassets/upload/sanpham/{{$hinh->TenHinh}}" class="cloud-zoom-gallery" title="" name="clientassets/upload/sanpham/{{$hinh->TenHinh}}" rel="useZoom: 'ma-zoom1', smallImage: 'clientassets/upload/sanpham/{{$hinh->TenHinh}}'">
                                                        <img src="clientassets/upload/sanpham/{{$hinh->TenHinh}}" alt="" height="80px" />
                                                    </a>
                                                </li>
                                                @endforeach
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-shop col-sm-7">
                                    <div class="product-name">
                                        <h1>{{$chitiet->TenSP}}</h1>
                                    </div>
                                    
                                    <div class="box-container2"> 
                                        @if ($chitiet->GiaKhuyenMai != 0)
                                        <div class="price-box">
                                            <p class="special-price">
                                                <span class="price-label">Giá khuyến mãi: </span>
                                            <span id="product-price-1" class="price">{{number_format($chitiet->GiaKhuyenMai)}}</span>
                                            </p>
                                            <p class="old-price">
                                                <span class="price-label">Giá: </span>
                                                <span id="old-price-1" class="price">{{number_format($chitiet->GiaSP)}}</span>
                                            </p>
                                        </div>
                                        @else
                                        <div class="price-box">
                                            <p class="price">
                                                <span class="price-label">Giá: </span>
                                                <span id="old-price-1" class="price">{{number_format($chitiet->GiaSP)}}</span>
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="short-description">
                                        <div class="std">{!!$chitiet->MoTaSP!!}</div>
                                    </div>
                                    <p class="availability in-stock">Còn: <span>{{$chitiet->TonKho . ' sản phẩm'}}</span></p>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-3 control-label">Số lượng: </label>
                                            <div class="col-md-3 col-sm-5">
                                                <div class="input-group qty">

                                                    <input type="text" class="form-control" value="1" disabled>
     
                                                </div><!-- /input-group -->
                                            </div>
                                        </div>
                                        <a class="btn btn-danger btn-cart link-cart" href="{{ route('muahang', $chitiet->idSP) }}">Mua hàng</a>

                                    </form>
                                </div><!-- /.product-shop -->
                            </div>
                            <div class="product-tab tab-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#product-desc" data-toggle="tab">Thông tin sản phẩm</a></li>
                                
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="product-desc">
                                        {!! $chitiet->ChiTietSP !!}
                                    </div>
                                </div>
                            </div><!-- /.product-tab -->
                        </div><!-- /.product-view -->
                        


                        <div class="featuredproductslider-container"> 
                            <div class="title-group1"><h2>Sản phẩm liên quan</h2></div>
                            <div id="featured-products" class="owl-container">
                                <div class="owl">

                                    @foreach ($sanpham_lienquan as $lienquan)
                                    <div class='productslider-item item'>
                                        <div class="item-inner">
                                            <div class="images-container">
                                                <div class="product_icon">
                                                    <div class='new-icon'><span>Mới</span></div>
                                                </div>
                                                <a href="{{ route('sanpham_chitiet', $lienquan->idSP) }}" title="Nunc facilisis" class="product-image">
                                                    <img src="clientassets/upload/sanpham/{{$lienquan->urlHinhSP}}" alt="Nunc facilisis" height="200px" />
                                                </a>
                                                <div class="box-hover">
                                                    <ul class="add-to-links">
                                                        <li><a href="{{ route('sanpham_chitiet', $lienquan->idSP) }}" class="link-quickview">Xem chi tiet</a></li>
                                                        <li><a href="{{ route('muahang', $lienquan->idSP) }}" class="link-cart">Mua hàng</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="des-container">
                                                <h2 class="product-name"><a href="{{ route('sanpham_chitiet', $lienquan->idSP) }}" title="Nunc facilisis">{{$lienquan->TenSP}}</a></h2>
                                                <div class="price-box">
                                                    @if ($lienquan->GiaKhuyenMai != 0)
                                                    <p class="special-price">
                                                        <span class="price-label">Giá khuyến mãi: </span>
                                                        <span class="price">{{ number_format($lienquan->GiaKhuyenMai) }}</span>
                                                    </p>
                                                    <p class="old-price">
                                                        <span class="price-label">Giá: </span>
                                                        <span class="price">{{ number_format($lienquan->GiaSP) }}</span>
                                                    </p>
                                                    @else
                                                    <p class="price">
                                                        <span class="price-label">Giá: </span>
                                                        <span class="price">{{ number_format($lienquan->GiaSP) }}</span>
                                                    </p>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                   
                                </div>
                            </div>
                        </div><!-- /.featuredproductslider-container -->
                    </div><!-- /.col-right -->
                  

                    </div><!-- /.col-left -->
                </div>
            </div>
        </div><!-- /.main -->
@stop