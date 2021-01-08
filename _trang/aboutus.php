<?php
  $title="Về chúng tôi";
  $tieude=$title;
?>
<?=content_open('Về chúng tôi')?>
    <?=$session->pull("info")?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <div class="home-wrapper">
            <a href="">
              <h1 class="icon-main text-custom"><img src="./assets/icons/building.png" width="100" height="100"></h1>
            </a>
            <h1 class="home-text"><span class="rotate">Quản lý chất lượng công trình 3D</span></h1>
            <p class="m-t-0 text-muted cd-text">
              Phần mềm quản lý chất lượng công trình 3D phiên bản v1.0<br>
              Phần mềm này là đồ án cuối kì của môn Hệ thống thông tin địa lý 3 chiều (IE402.L11), được phát triển bởi nhóm 5 khoa Khoa học và kỹ thuật thông tin, ĐH CNTT.<br>
              &copy; Quản lý chất lượng công trình 3D.<br />
              Hãy đóng góp ý kiến cho chúng tôi để hoàn thiện hệ thống hơn nữa.<br />
            </p>

          </div>
        </div>
      </div>
    </div>
<?=content_close()?>
