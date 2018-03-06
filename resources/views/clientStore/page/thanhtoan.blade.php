@extends('clientStore.layout.master')

@section('content')
<div class="main">
        	<div class="container">
        		<div class="row" style="margin-top: 10px;"></div>
                <div class="checkout">
                	<div class="row">
                    	<div class="col-sm-12">
                        	<div class="checkout-step">
                        		<div class="checkout-step-item">
                                	<div class="step-title clearfix" data-toggle="collapse" data-target="#checkout-one">
                                        <!-- <span class="number">1</span> -->
                                        <h2>Đặt hàng</h2>

                                    </div>
                                    <div id="checkout-one" class="collapse in">
                                        @if(Session::has('thongbao'))
                                        <div class="alert alert-success">
                                            {{Session::get('thongbao')}}
                                        </div>
                                        @endif
                                    	<div class="step-content">

                                            <form action="{{route('thanhtoan')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <h4>Thông tin khách hàng</h4>
                                                    <div class="line2 mtb20"></div>
                                                    <div class="col-md-6"><div class="form-group">
                                                        <label class="control-label">Họ và tên *</label>
                                                        <input type="text" class="form-control" name="hoten" required placeholder="Nhập họ tên">
                                                    </div></div>
                                                    <div class="col-md-6"><div class="form-group">
                                                        <label class="control-label">Số điện thoại *</label>
                                                        <input type="text" class="form-control" name="sodienthoai" required placeholder="Nhập số điện thoại">
                                                    </div></div>
                                                    <div class="col-md-12"><div class="form-group">
                                                        <label class="control-label">Email *</label>
                                                        <input type="email" class="form-control" name="email" required placeholder="example@gmail.com">
                                                    </div></div>
                                                    <div class="col-md-12"><div class="form-group">
                                                        <label>Giới tính &nbsp;&nbsp;&nbsp;</label>
                                                        <label><input type="radio" name="gioitinh" value="1"> Nam</label>&nbsp;
                                                        <label><input type="radio" name="gioitinh" value="0"> Nữ</label>
                                                    </div></div>
                                                    <div class="col-md-12"><div class="form-group">
                                                        <label class="control-label">Địa chỉ *</label>
                                                        <input type="text" class="form-control" name="diachi" required placeholder="Nhập địa chỉ nhận hàng">
                                                    </div></div>
                                                    <div class="col-md-12"><div class="form-group">
                                                        <label class="control-label">Ghi chú thêm</label>
                                                        <textarea rows="4" class="form-control" name="ghichu" required></textarea>
                                                    </div></div>
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4>Thông tin đơn hàng</h4>
                                                    <div class="line2 mtb20"></div>

                                                    @foreach ($content as $sp)
                                                    <div class="col-md-12">
                                                        <div class="cart-listing">
    
                                                        <div class="media" id="media{{$sp->options->id}}">
                                                            <div class="media-left"><a href="{{route('sanpham_chitiet', $sp->options->id)}}"><img height="50px" src="clientassets/upload/sanpham/{{$sp->options->img}}" alt="" class="img-responsive"></a></div>
                                                            <div class="media-body">

                                                                <a id="remove-ajax" href="{{ route('xoahang', $sp->rowId) }}" class="remove-cart-item" value="{{$sp->options->id}}">&times;</a>

                                                                <h4 style="font-size: 18px">{{$sp->name}}</h4>
                                                                <div class="mini-cart-qty">Số lượng: {{$sp->qty}}</div>
                                                                <div class="mini-cart-price">Giá: {{number_format($sp->price)}} đồng</div>

                                                            </div>
                                                        </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" style="margin-top: 20px;"></div>
                                                    @endforeach
                                                    
                                                    <div class="rows">
                                                    <div class="col-md-12 text-right"><p style="margin-top: 20px; color: red; font-size: 18px">Tổng tiền: {{$total}}</p></div>

                                                    <div class="col-md-12">
                                                    <div class="form-group text-right" style="margin-top: 20px;">
                                                        <button type="submit" class="btn btn-danger btn-md fwb"><i class="fa fa-shopping-cart" >&nbsp;&nbsp; Đặt hàng</i></button>
                                                    </div>
                                                    </div>
                                                    </div>

                                                </div>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="checkout-step-item">
                                	<div class="step-title clearfix collapsed" data-toggle="collapse" data-target="#checkout-two">
                                        <span class="number">2</span>
                                        <h2>Hình thức thanh toán</h2>
                                    </div>
                                    <div id="checkout-two" class="collapse">
                                    	<div class="step-content">
                                    		Billing Information
                                        </div>
                                    </div>
                                </div> -->

                               
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- /.main -->

        
@stop