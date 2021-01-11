<?php
$title = "Trang chủ";
$tieude = $title;
?>
<?= content_open('Thống kê') ?>
<?= $session->pull("info") ?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <?php
        $dem = 0;
        $get_tang = $db->ObjectBuilder()->get('tang');
        foreach ($get_tang as $row) {
          $dem++;
        }
        ?>
        <h3><?= $dem ?></h3>

        <p>Tầng</p>
      </div>
      <?php if ($session->get('level') == 'Admin') : ?>
        <a href="#" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
      <?php endif ?>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <?php
        $dem = 0;
        $get_loai_kt = $db->ObjectBuilder()->get('loaikientruc');
        foreach ($get_loai_kt as $row) {
          $dem++;
        }
        ?>
        <h3><?= $dem ?></h3>

        <p>Loại kiến trúc</p>
      </div>
      <?php if ($session->get('level') == 'Admin') : ?>
        <a href="<?= url('loaikientruc') ?>" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
      <?php endif ?>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <?php
        $dem = 0;
        $get_vatlieu = $db->ObjectBuilder()->get('vatlieu');
        foreach ($get_vatlieu as $row) {
          $dem++;
        }
        ?>
        <h3><?= $dem ?></h3>
        <p>Vật liệu</p>
      </div>
      <?php if ($session->get('level') == 'Admin') : ?>
        <a href="<?= url('vatlieu') ?>" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
      <?php endif ?>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <?php
        $dem = 0;
        $get_kientruc = $db->ObjectBuilder()->get('kientruc');
        foreach ($get_kientruc as $row) {
          $dem++;
        }
        ?>
        <h3><?= $dem ?></h3>

        <p>Kiến trúc</p>
      </div>
      <?php if ($session->get('level') == 'Admin') : ?>
        <a href="<?= url('kientruc') ?>" class="small-box-footer">Xem thêm <i class="fa fa-arrow-circle-right"></i></a>
      <?php endif ?>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

<div class="row">
  <div class="col-md-3">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Thông tin công trình 3D</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-condensed">
          <?php
          $getdata = $db->ObjectBuilder()->get('toanha');
          foreach ($getdata as $row) {
          ?>
            <tr>
              <td><b>Tên tòa nhà:</b></td>
              <td><?= $row->TenToaNha ?></td>
            </tr>
            <tr>
              <td><b>Số tầng:</b></td>
              <td><?= $row->SoTang ?></td>
            </tr>
            <tr>
              <td><b>Vị trí:</b></td>
              <td><?= $row->ViTri ?></td>
            </tr>
            <tr>
              <td><b>Năm hoàn thành:</b></td>
              <td><?= $row->NamHoanThanh ?></td>
            </tr>
          <?php
          } ?>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Thống kê tình trạng bảo trì</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-striped">
          <tr>
            <th>STT</th>
            <th>Trạng thái bảo trì</th>
            <th>Số kiến trúc</th>
          </tr>
          <?php
          $red = '';
          $green = '';
          $getdata = $db->ObjectBuilder()->get('kientruc');
          foreach ($getdata as $row) {
            if ($row->TrangThaiBT == '#00ff00') {
              $green++;
            } else {
              $red++;
            }
          }
          ?>
          <tr>
            <td>1.</td>
            <td>Sắp đến hạn bảo trì</td>
            <td><span class="badge bg-red"><?= $red ?></span></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Xa hạn bảo trì</td>
            <td><span class="badge bg-green"><?= $green ?></span></td>
          </tr>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Thống kê loại kiến trúc được sử dụng</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-striped">
          <tr>
            <th>STT</th>
            <th>Loại kiến trúc</th>
            <th>Số kiến trúc</th>
          </tr>
          <?php
          $no = 1;
          $dem = 0;
          $get_loaikt = $db->ObjectBuilder()->get('loaikientruc');
          foreach ($get_loaikt as $row) {
            $ma_loai_kt = $row->MaLoaiKienTruc;
            $get_kientruc = $db->ObjectBuilder()->get('kientruc');
            foreach ($get_kientruc as $row1) {
              if ($row1->MaLoaiKienTruc == $ma_loai_kt) {
                $dem++;
              }
            } ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $row->TenLoaiKienTruc ?></td>
              <td><?= $dem ?></td>
            </tr>

          <?php
            $no++;
            $dem = 0;
          }
          ?>

        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Thống kê vật liệu được sử dụng</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-striped">
          <tr>
            <th>STT</th>
            <th>Vật liệu</th>
            <th>Số kiến trúc</th>
          </tr>
          <?php
          $no = 1;
          $dem = 0;
          $get_vatlieu = $db->ObjectBuilder()->get('vatlieu');
          foreach ($get_vatlieu as $row) {
            $ma_vatlieu = $row->MaVatLieu;
            $get_kientruc = $db->ObjectBuilder()->get('kientruc');
            foreach ($get_kientruc as $row1) {
              if ($row1->MaVatLieu == $ma_vatlieu) {
                $dem++;
              }
            } ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $row->TenVatLieu ?></td>
              <td><?= $dem ?></td>
            </tr>

          <?php
            $no++;
            $dem = 0;
          }
          ?>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Thống kê số kiến trúc mỗi tầng</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-striped">
          <tr>
            <th>STT</th>
            <th>Tên tầng</th>
            <th>Số kiến trúc</th>
          </tr>
          <?php
          $no = 1;
          $dem = 0;
          $get_tang = $db->ObjectBuilder()->get('tang');
          foreach ($get_tang as $row) {
            $ma_tang = $row->MaTang;
            $get_kientruc = $db->ObjectBuilder()->get('kientruc');
            foreach ($get_kientruc as $row1) {
              if ($row1->MaTang == $ma_tang) {
                $dem++;
              }
            } ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $row->TenTang ?></td>
              <td><?= $dem ?></td>
            </tr>

          <?php
            $no++;
            $dem = 0;
          }
          ?>

        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<?= content_close() ?>