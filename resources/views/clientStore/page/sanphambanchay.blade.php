@extends ('clientStore.layout.master')

@section ('content')
<style type="text/css" media="screen">
    .price{
        font-size: 16px !important;
        font-weight: bold !important;
    }
</style>
<div class="main">
            <div class="container">
                <div class="row">

                    <div class="col-sm-3 col-left"></div>

                    <div class="col-sm-9 col-right">
                        <div class="banner">
                            <a href="#"><img alt="" src="images/ads/ads-17.jpg"></a>
                        </div>
                        <div class="page-title">
                            <h1>Sản phẩm</h1>
                        </div>

                        <div class="row products">
                            
                            @foreach ($sanpham as $sp)
                            <div class="col-md-3 col-sm-6">
                                <div class='productslider-item item'>
                                    <div class="item-inner">
                                        <div class="images-container">

                                                @if($sp->SanPhamMoi==1)
                                                <div class="product_icon">
                                                    <div class='new-icon'><span>Mới</span></div>
                                                </div>
                                                @endif
                                                @if($sp->GiaKhuyenMai != 0)
                                                <div class="product_icon">
                                                    <div class="sale-icon"><span>Giảm</span></div>
                                                </div>
                                                @endif

                                            <a href="{{ route('sanpham_chitiet', $sp->idSP) }}" title="Nunc facilisis" class="product-image">
                                                <img src="clientassets/upload/sanpham/{{$sp->urlHinhSP}}" alt="Nunc facilisis" height="250px" />
                                            </a>
                                            <div class="box-hover">
                                                <ul class="add-to-links">
                                                    <li><a href="{{ route('sanpham_chitiet', $sp->idSP) }}" class="link-quickview">Xem chi tiết</a></li>
                                                    
                                                    <li><a href="{{ route('muahang', $sp->idSP) }}" class="link-cart">Mua hàng</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="des-container">
                                            <h2 class="product-name"><a href="{{ route('sanpham_chitiet', $sp->idSP) }}" title="Nunc facilisis">{{$sp->TenSP}}</a></h2>
                                            <div class="price-box">
                                                @if ($sp->GiaKhuyenMai != 0)
                                                <p class="special-price price">
                                                    <span class="price-label">Khuyến mãi: </span>
                                                    <span class="price">{{number_format($sp->GiaKhuyenMai)}}</span>
                                                </p>
                                                <p class="old-price price">
                                                    <span class="price-label">Giá: </span>
                                                    <span class="price">{{number_format($sp->GiaSP)}}</span>
                                                </p>
                                                @else
                                                <p class="price price">
                                                    <span class="price-label">Giá: </span>
                                                    <span class="price">{{number_format($sp->GiaSP)}}</span>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div><!-- /.product -->
                    </div><!-- /.col-right -->
                </div>
            </div>
        </div><!-- /.main -->
@stop