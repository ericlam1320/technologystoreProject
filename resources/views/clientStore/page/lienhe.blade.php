@extends('clientStore.layout.master')

@section('content')
<div class="main">
        	<div class="container">
            	<div class="row" style="margin-top: 20px;">
                	<div class="col-sm-9">
                    	<div class="page-title page-title-line">
                        	<div class="col-md-4"></div>
                            <div class="col-md-8"><h1>Liên hệ</h1></div>
                        </div>

                        <form action="{{ route('postLienhe') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="row">
	                        <div class="col-md-4"></div>
	                        <div class="col-md-8">
	                        	<div class="row">
	                            <div class="col-sm-6">
	                                <div class="form-group">
	                                	<label>Họ tên*</label>
	                                	<input type="text" class="form-control" required name="hoten">
	                                </div>
	                            </div>
	                            <div class="col-sm-6">
	                                <div class="form-group">
	                                	<label>Email*</label>
	                                	<input type="email" class="form-control" name="email">
	                                </div>
	                            </div>
	                            <div class="col-sm-12">
	                                <div class="form-group">
	                                	<label>Tiêu đề*</label>
	                                	<input type="text" class="form-control" required>
	                                </div>
	                            </div>
	                            <div class="col-sm-12">
	                            	<div class="form-group">
	                                	<label>Nội dung*</label>
	                                	<textarea class="form-control" rows="7" required name="message"></textarea>
	                                </div>
	                            </div>
	                        	</div>
	                        	 <button type="submit" class="btn btn-default btn-lg">Gửi đi</button>
	                        </div>
                        </div>
                         
                        </form>

                        <br>
                    </div>
                    <div class="col-sm-3">
                    	<div class="block">
                            <div class="block-title">
                                <strong><span>Thông tin liên hệ</span></strong>
                            </div>
                            <div class="block-content">
                                <div class="email add">
                            		<p>technologystore96@gmail.com</p>
                            	</div>
                            	<div class="phone add">
                            		<p>0906482639</p>
                            	</div>
                            	<div class="address add">Địa chỉ: 
                            		<p>180 Cao Lỗ, Q8, Thành phố Hồ Chí Minh</p>
                            	</div>
                           	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.main -->
@endsection