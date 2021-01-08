<?php 
 include '_loader.php';
 $setTemplate=true;
 if(isset($_GET['trang'])){
    $trang=$_GET['trang'];
  }
  else{
    $trang='trangchu';
  }
  ob_start();
  $file='_trang/'.$trang.'.php';
  if(!file_exists($file)){
    include '_trang/error.php';
  }
  else{
    include $file;
  }
  $content = ob_get_contents();
  ob_end_clean();
  
  if($setTemplate==true){
    if($session->get("logged")!==true){
      redirect(url('login'));
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include '_layouts/head.php'?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
  include '_layouts/header.php';
  include '_layouts/sidebar.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$tieude?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$tieude?></li>
      </ol>
    </section>
<?php
  echo $content;
?>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
  include '_layouts/footer.php';
  include '_layouts/javascript.php';
?>
</div>
</body>
</html>
<?php } else {
  echo $content;
}


if(isset($fileJs)){
  include '_trang/js/'.$fileJs.'.php';
}
?>