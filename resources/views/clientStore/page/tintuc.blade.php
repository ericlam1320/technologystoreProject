@extends('clientStore.layout.master')

@section ('content')
<div class="main">
        	<div class="container">
        		<div class="row">
        			<div class="col-sm-3"></div>
        			<div class="col-sm-9"><h2>Tin công nghệ</h2></div>
        		</div>
            	<div class="row">
                    <div class="col-sm-3"></div>
                	<div class="col-sm-9">
                    	<ol id="products-list" class="blog-list">
							@foreach ($tintuc as $tin)
                            <li class="item">
                                <div class="item-inner">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="images-container">
                                                <a class="product-image" title="Fusce aliquam" href="{{route('tintuc_chitiet', $tin->idTin)}}" rel="author"><img alt="Fusce aliquam" src="clientassets/upload/tintuc/{{$tin->urlHinhTin}}"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <h2 class="product-name"><a title="" href="{{route('tintuc_chitiet', $tin->idTin)}}">{{$tin->TieuDe}}</a></h2>
                                            <div class="blog-attr">
                                            	<span>Post by <a href="#">Admin</a></span>
                                                <span class="separator">|</span>
                                                <span>{{$tin->NgayDang}}</span>
                                            </div>
                                            <div class="desc">
                                               {!!$tin->TomTat!!}
                                            </div>
                                            <a href="{{ route('tintuc_chitiet', $tin->idTin) }}" class="btn btn-default btn-readmore">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
							@endforeach
                    	</ol>
                        <!-- <nav>
                          <ul class="pagination">
                            <li><a href="#" aria-label="Previous">Prev</a></li>
                            <li class="divider"><span>|</span></li>
                            <li><a href="#">1</a></li>
                            <li class="divider"><span>|</span></li>
                            <li><a href="#">2</a></li>
                            <li class="divider"><span>|</span></li>
                            <li><a href="#" aria-label="Next">Next</a></li>
                          </ul>
                        </nav> -->
                    </div>
                </div>
            </div>
</div><!-- /.main -->
@stop