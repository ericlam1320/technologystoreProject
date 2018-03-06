
$(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        $("#changePassword").change(function(){       //sự kiện thay đổi
                    if($(this).is(":checked"))  //nếu checkbox có checked (== cho phép changePassword)
                    {
                      $(".password").removeAttr('disabled');  // các class .password remove thuộc tính html disabled
                    }
                    else {
                      $(".password").attr('disabled');  //ko check thì add thuộc tính disabled
                    }
                  });

        $(".SanPham").change(function(){

          

          var idSP = $(this).val();

          $.get("admin/ajax/giasanpham/"+idSP, function(data){
             $(".GiaSP").val(data);    
          });

          $.get("admin/ajax/giaKMsanpham/"+idSP, function(data){
             $(".GiaKM").val(data);    
          });

          var SoLuong = $('.SoLuong').val();
          $.get("admin/ajax/thanhtiensanpham/"+idSP+"/"+SoLuong, function(data){
             $(".thanhtien").val(data);    
          });
        });

        $(".SoLuong").change(function(){

          var idSP = $('.SanPham').val();

          $.get("admin/ajax/giasanpham/"+idSP, function(data){

             $(".GiaSP").val(data);    
          });

          $.get("admin/ajax/giaKMsanpham/"+idSP, function(data){
             $(".GiaKM").val(data);    
          });

          var SoLuong = $('.SoLuong').val();
          $.get("admin/ajax/thanhtiensanpham/"+idSP+"/"+SoLuong, function(data){
             $(".thanhtien").val(data);    
          });
        });


});

$("div.alert").delay(5000).slideUp();

function xac_nhan_xoa(message){

	if(window.confirm(message)){
		return true;
	}
	return false;
}
