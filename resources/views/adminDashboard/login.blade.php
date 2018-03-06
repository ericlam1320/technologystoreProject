<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="adminassets/assets/css/styleLogin.css">

  
</head>

<body>
  
<!-- Mixins-->
<!-- Pen Title-->
<div class="rerun"><a href="./"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></div>
<div class="container">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
      @foreach ($errors->all() as $err)
      {{$err}} <br>
      @endforeach
      </div>
      @endif

      @if (session('thongbao'))
      <div class="alert alert-danger">
      {{session('thongbao')}} 
      </div>
      @endif
  <div class="card"> 
     
  </div>
  <div class="card">
    <h1 class="title">Đăng nhập</h1>
    <form method="POST" action="">
     
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="input-container">
        <input type="text" id="#{label}" name="username" />
        <label for="#{label}">Tên đăng nhập</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="#{label}"  name="password" />
        <label for="#{label}">Mật khẩu</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span>Đăng nhập</span></button>
      </div>
      <div class="footer"><a href="#">Quên mật khẩu?</a></div>
    </form>
  </div>
  <!-- <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Đăng kí
      <div class="close"></div>
    </h1>
    <form>
      <div class="input-container">
        <input type="text" id="#{label}" required="required"/>
        <label for="#{label}">Tên đăng nhập</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="password" id="#{label}" required="required"/>
        <label for="#{label}">Mật khẩu</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">Nhập lại mật khẩu</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button><span>Đăng kí</span></button>
      </div>
    </form>
  </div> -->
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="adminassets/assets/js/indexLogin.js"></script>
</body>
</html>
