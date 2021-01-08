<?php
$setTemplate=false;
$session->destroy('_Webgis', true);

$session->set("info",'<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Thoát thành công!</h4> Nhập tài khoản để đăng nhập
      </div>');
redirect(url('login'));
?>