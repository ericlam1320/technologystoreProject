@extends ('clientStore.layout.master')

@section ('content')
<div class="main">
            <div class="container">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-3 col-left">
                    </div><!-- /.col-left -->
                    <div class="col-sm-9 col-right">
                        <!-- <div class="banner">
                            <a href="#"><img alt="" src="images/ads/ads-05.jpg"></a>
                        </div> -->
                        <div class="page-title">
                            <h1>Danh sách sản phẩm hãng {{$hangsanxuat->TenHangSX}}</h1>
                        </div>
                       
                        <ol id="products-list" class="products-list">

                            @foreach ($sanpham_hangSX as $hsx)
                            <li class="item">
                                <div class="item-inner">
                                    <div class="row">
                                        <div class="col-sm-4 col-sms-4 col-smb-12">
                                            <div class="images-container">
                                                <div class="product_icon">
                                                    @if ($hsx->SanPhamMoi==1)
                                                    <div class="new-icon"><span>Mới</span></div>
                                                    @endif
                                                    @if ($hsx->GiaKhuyenMai != 0)
                                                    <div class="sale-icon"><span>Giảm</span></div>
                                                    @endif
                                                </div>
                                                <a class="product-image" title="Fusce aliquam" href="{{ route('sanpham_chitiet', $hsx->idSP) }}" rel="author"><img alt="Fusce aliquam" src="clientassets/upload/sanpham/{{$hsx->urlHinhSP}}" ></a>
                                            </div>
                                        </div>
                                        <div class="product-shop col-sm-8 col-sms-8 col-smb-12">
                                            <div class="f-fix">
                                                <h2 class="product-name"><a title="" href="{{ route('sanpham_chitiet', $hsx->idSP) }}">{{$hsx->TenSP}}</a></h2>

                                                @if ($hsx->GiaKhuyenMai != 0)
                                                <div class="price-box">
                                                    <p class="special-price">
                                                        <span class="price-label">Giá khuyến mãi: </span>
                                                    <span id="product-price-1" class="price">{{number_format($hsx->GiaKhuyenMai)}}</span>
                                                    </p>
                                                    <p class="old-price">
                                                        <span class="price-label">Giá: </span>
                                                        <span id="old-price-1" class="price">{{number_format($hsx->GiaSP)}}</span>
                                                    </p>
                                                </div>
                                                @else
                                                <div class="price-box">
                                                    <p class="price">
                                                        <span class="price-label">Giá: </span>
                                                        <span id="old-price-1" class="price">{{number_format($hsx->GiaSP)}}</span>
                                                    </p>
                                                </div>
                                                @endif

                                                <div class="desc std">
                                                   {!!$hsx->MoTaSP!!} <br>
                                                   <a class="link-learn" title="Fusce aliquam" href="{{route('sanpham_chitiet', $hsx->idSP)}}" style="font-size: 18px; color:orange">Xem chi tiết</a>
                                                </div>
                                                <div class="actions">
                                                    <div class="actions-inner">
                                                        <a href="{{ route('muahang', $hsx->idSP) }}" class="btn btn-danger" title="Add to Cart" type="button">Mua hàng</a>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        
                        </ol>
                    </div><!-- /.col-right -->
                </div>
            </div>
        </div>
@stop