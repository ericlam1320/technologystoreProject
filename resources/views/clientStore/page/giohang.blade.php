

@extends('clientStore.layout.master')

@section('content')
<div class="main">
        	<div class="container">
        		<div class="row" style="margin-top: 20px;"></div>
                <div class="cart">
                	<form>
                    <div class="table-responsive">


                   @if (count($content)>0)
                	<table class="table custom-table">
                        <thead>
                            <tr class="first last">
                                <th>Xoá</th>
                                <th>Hình sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Cập nhật</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php $count=1; ?>
                         @foreach ($content as $sanpham)
                            <form action="" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                        	<tr>
            					<td class="text-center"><a id="remove-ajax" class="btn-remove" href="{{ route('xoahang', $sanpham->rowId) }}"><span class="fa fa-trash-o"></span></a></td>
            					<td><a class="product-image" title="Primis in faucibus" href="{{route('sanpham_chitiet', $sanpham->options->id)}}">
                                	<img alt="Primis in faucibus" src="clientassets/upload/sanpham/{{$sanpham->options->img}}">
                                </a></td>
            					<td>
                                	<a href="{{route('sanpham_chitiet', $sanpham->options->id)}}">{{$sanpham->name}}</a>
                                </td>
                        		<td class="qty">
                               		<div class="input-group">

                                        <!-- <span class="input-group-btn">
                                            <button class="btn btn-left" type="button">-</button>
                                        </span> -->

                                        <input type="text" class="form-control qty" value="{{$sanpham->qty}}" id="quantity{{$sanpham->rowId}}" name="qty">

                                        <!-- <span class="input-group-btn ">
                                            <button class="btn btn-right" type="button">+</button>
                                        </span> -->

                                    </div><!-- /input-group -->
                            	</td>
                        		<td class="subtotal">{{ number_format($sanpham->price) }}</td>

                                <td class="text-center"><a href="#" onclick="return false;" style="font-size: 15px;" class="btn-update btn-link" id="{{$sanpham->rowId}}">Cập nhật</a></td>

                				<td class="grandtotal">{{ number_format($sanpham->price*$sanpham->qty) }}</td>
        					</tr>
                           
                            </form>
                              @endforeach
                              <?php $count++; ?>
                    	</tbody>
                    </table>
                   


                    </div>
                    <div class="text-right">
                    	<a href="./" class="btn btn-default btn-md">Tiếp tục mua hàng</a>
                       
                    </div>
                    <div class="line2"></div>
                    <div class="row">
                    	<div class="col-sm-8"></div>

                    	<div class="col-sm-4">
                        	<table class="table table-cart-total" >
                            	<tr >
                                	<td style="color: red; font-size: 20px;font-weight: bold">Tổng tiền:</td>
                                    <td style="color: red; font-size: 20px;font-weight: bold" class="text-right">{{ $total }} đồng</td>
                                </tr>
                            </table>
							<div class="text-right">
                            	<p><a href="{{route('thanhtoan')}}" class="btn btn-default btn-md fwb">Đặt hàng</a></p>
                            </div>
                        </div>
                    </div>

                    </form>
                    @else
                    <div class="text-center" style="margin-bottom: 120px;">
                        <h2>Giỏ hàng rỗng</h2>
                    </div>
                   @endif
                </div>
            </div>
        </div><!-- /.main -->
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
         $('.btn-update').click(function(){

            var id  = $(this).attr('id');
            var qty = $('#quantity'+id).val();
            var token = $("input[name='_token']").val();

            //alert(qty);
            
            $.ajax({
                url: 'capnhat/'+id+'/'+qty,
                //url: 'giohang',
                type: 'GET',
                cache:false,
                data:{"_token":token, "id":id, "qty":qty},
                success:function(data){
                     if(data == 'true'){
                        window.location="giohang";
                     }
                }
            });
        });   

         // $(document).ready(function(){

         //        var quantitiy=0;
         //        var id  = $('.btn-update').attr('id');
         //        $('.btn-right').click(function(e){

         //            // Stop acting like a button
         //            e.preventDefault();
         //            // Get the field name
         //            var quantity = parseInt($('#quantity'+id).val());

         //            $('#quantity'+id).val(quantity + 1);
                
         //         });

         //        $('.btn-left').click(function(e){
         //            // Stop acting like a button
         //            e.preventDefault();
         //            // Get the field name
         //            var quantity = parseInt($('#quantity'+id).val());
                    
         //            if(quantity>0){
         //                $('#quantity'+id).val(quantity - 1);
         //            }
         //        });
         // });

       </script>
@stop