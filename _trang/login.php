<?php
	$setTemplate=false;
	if(isset($_POST['login'])){
    $ten_user=$_POST['ten_user'];
    $mat_khau=$_POST['mat_khau'];
    $db->where("TenUser",$ten_user);
    $data=$db->ObjectBuilder()->getOne("users");
    if($db->count>0){
      // nếu tên người dùng tồn tại
      $hash = $data->MatKhau;
      if (password_verify($mat_khau, $hash)) {
          $session->set("logged",true);
          $session->set("ten_user",$data->TenUser);
          $session->set("ma_user",$data->MaUser);
          $session->set("level",$data->Level);
          $session->set("info",'<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Thành công!</h4> Chào mừng <b>'.$data->TenUser.'</b> trên Trang chủ của phần mềm
                  </div>');
          redirect(url("trangchu"));
      } else {
         $session->set("logged",false);
         $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Tên đăng nhập hoặc mật khẩu không chính xác
              </div>');
        redirect(url("login"));
      }
    }
    else{
      $session->set("logged",false);
      $session->set("info",'<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Tên đăng nhập hoặc mật khẩu không chính xác
              </div>');
      redirect(url("login"));
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form Login</title>
	<?php include '_layouts/head.php'?>
	<link rel="stylesheet" href="<?=templates()?>plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Đăng Nhập</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Đăng nhập phần mềm Quản lý chất lượng công trình 3D</p>
    <?=$session->pull("info")?>
    <form  method="post">
      <label>Tên người dùng</label>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="ten_user" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <label>Mật Khẩu</label>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="mat_khau"  placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
<?php
  include '_layouts/javascript.php';
?>
<script src="<?=templates()?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</html>