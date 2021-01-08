<?php
$title = "ArcGIS - 3D Building";
$tieude = $title;
$url = 'arcgis-3dbuilding';
$fileJs = 'arcgis-3dbuildingJs';

$ma_tang = (isset($_GET['matang'])) ? $_GET['matang'] : 'tatca';
$ma_loai_kien_truc=(isset($_GET['maloaikientruc'])) ? $_GET['maloaikientruc'] : 'tatca';
$ma_kien_truc = (isset($_GET['makientruc'])) ? $_GET['makientruc'] : 'tatca';
$ma_vat_lieu = (isset($_GET['mavatlieu'])) ? $_GET['mavatlieu'] : 'tatca';
$trang_thai_bt = (isset($_GET['trangthaibt'])) ? $_GET['trangthaibt'] : 'tatca';
?>
<?= content_open($title) ?>
<form>
  <div class="row">
    <?= input_hidden('trang', $url) ?>
    <div class="col-md-2">
      <label>Tầng</label>
      <?php
      $op['tatca'] = 'Tất cả';
      $db->join('tang b', 'a.MaTang=b.MaTang', 'LEFT');
      foreach ($db->ObjectBuilder()->get('kientruc a') as $row) {
        $op[$row->MaTang] = $row->TenTang;
      }
      ?>
      <?= select('matang', $op, $ma_tang) ?>
    </div>
    <div class="col-md-2">
      <label>Loại kiến trúc</label>
      <?php
      $op2['tatca'] = 'Tất cả';
      $db->join('loaikientruc b', 'a.MaLoaiKienTruc=b.MaLoaiKienTruc', 'LEFT');
      foreach ($db->ObjectBuilder()->get('kientruc a') as $row) {
        $op2[$row->MaLoaiKienTruc] = $row->TenLoaiKienTruc;
      }
      ?>
      <?= select('maloaikientruc', $op2, $ma_loai_kien_truc) ?>
    </div>
    <div class="col-md-2">
      <label>Tên kiến trúc</label>
      <?php
      $op3['tatca'] = 'Tất cả';
      foreach ($db->ObjectBuilder()->get('kientruc') as $row) {
        $op3[$row->MaKienTruc] = $row->TenKienTruc;
      }
      ?>
      <?= select('makientruc', $op3, $ma_kien_truc) ?>
    </div>
    <div class="col-md-2">
      <label>Vật liệu</label>
      <?php
      $op4['tatca'] = 'Tất cả';
      $db->join('vatlieu b', 'a.MaVatLieu=b.MaVatLieu', 'LEFT');
      foreach ($db->ObjectBuilder()->get('kientruc a') as $row) {
        $op4[$row->MaVatLieu] = $row->TenVatLieu;
      }
      ?>
      <?= select('mavatlieu', $op4, $ma_vat_lieu) ?>
    </div>
    <div class="col-md-2">
      <label>Trạng thái bảo trì</label>
      <?php
      $op5['tatca'] = 'Tất cả';
      foreach ($db->ObjectBuilder()->get('kientruc a') as $row) {
        if ($row->TrangThaiBT == '#00ff00') {
          $op5[$row->TrangThaiBT] = 'Xa hạn bảo trì';         
        }
        else {
          $op5[$row->TrangThaiBT] = 'Sắp đến hạn bảo trì';
        }
      }
      ?>
      <?= select('trangthaibt', $op5, $trang_thai_bt) ?>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-info" style="margin-top:25px;">Tìm kiếm</button>
    </div>
  </div>
</form>
<hr>
<div id="mapid"></div>
<?= content_close() ?>