<?php
$title = "Bảo trì kiến trúc";
$tieude = $title;
$url = 'baotri';

if (isset($_POST['luu'])) {

	$data['MucCanhBaoBT'] = $_POST['muccanhbaobt'];
	$data['HanBaoTri'] = $_POST['hanbaotri'];

	//Nếu hạn bảo trì - ngày hiện tại < mức cảnh báo bảo trì => Trạng thái bảo trì: màu đỏ #ff0000
	$muc_canh_bao_bt = $_POST['muccanhbaobt'];
	$han_bao_tri = $_POST['hanbaotri'];
	$today = date('Y-m-d');
	$first_date = strtotime($han_bao_tri);
	$second_date = strtotime($today);
	$datediff = abs($first_date - $second_date);
	$result =  floor($datediff / (60 * 60 * 24));

	$data['SoNgayDenBT'] = $result;

	if ($result <= $muc_canh_bao_bt) {
		$data['TrangThaiBT'] = '#ff0000';
	} else {
		$data['TrangThaiBT'] = '#00ff00';
	}

	if ($_POST['makientruc'] == "") {
		$exec = $db->insert("kientruc", $data);
		$info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Thành công!</h4> Đã thêm dữ liệu thành công </div>';
	} else {
		$db->where('MaKienTruc', $_POST['makientruc']);
		$exec = $db->update("kientruc", $data);
		$info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Thành công!</h4> Đã sửa dữ liệu thành công </div>';
	}

	if ($exec) {
		$session->set('info', $info);
	} else {
		$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Quá trình không thành công
              </div>');
	}
	redirect(url($url));
}

if (isset($_GET['capnhat'])) {
	$setTemplate = false;

	$getdata = $db->ObjectBuilder()->get('kientruc');
	foreach ($getdata as $row) {
		$han_bao_tri = $row->HanBaoTri;
		$today = date('Y-m-d');
		$first_date = strtotime($han_bao_tri);
		$second_date = strtotime($today);
		$datediff = abs($first_date - $second_date);
		$result =  floor($datediff / (60 * 60 * 24));

		$data['SoNgayDenBT'] = $result;
		$db->where("MaKienTruc", $row->MaKienTruc);
		$exec = $db->update("kientruc", $data);
	}
	$info = '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Thành công!</h4> Đã cập nhật số ngày còn lại đến hạn bảo trì thành công </div>';
	if ($exec) {
		$session->set('info', $info);
	} else {
		$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Quá trình không thành công
              </div>');
	}
	redirect(url($url));
} else if (isset($_GET['them']) or isset($_GET['sua'])) {
	$ma_kien_truc = "";
	$ten_kien_truc = "";
	$han_bao_tri = date('Y-m-d');
	$muc_canh_bao_bt = "";
	$trang_thai_bt = "";

	if (isset($_GET['sua']) and isset($_GET['id'])) {
		$id = $_GET['id'];
		$db->where('MaKienTruc', $id);
		$row = $db->ObjectBuilder()->getOne('kientruc');
		if ($db->count > 0) {
			$ma_kien_truc = $row->MaKienTruc;
			$ten_kien_truc = $row->TenKienTruc;
			$han_bao_tri = $row->HanBaoTri;
			$muc_canh_bao_bt = $row->MucCanhBaoBT;
			$trang_thai_bt = $row->TrangThaiBT;
		}
	}
?>
	<?= content_open('Thông tin bảo trì kiến trúc') ?>
	<form method="post" enctype="multipart/form-data">
		<?= input_hidden('makientruc', $ma_kien_truc) ?>
		<div class="form-group">
			<label>Tên kiến trúc</label>
			<div class="row">
				<div class="col-md-4">
					<!-- <-?= input_text('tenkientruc', $ten_kien_truc) ?> -->
					<?= $ten_kien_truc ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Hạn bảo trì</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_date('hanbaotri', $han_bao_tri) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Mức cảnh báo bảo trì</label>
			<div class="row">
				<div class="col-md-3">
					<?= input_number('muccanhbaobt', $muc_canh_bao_bt) ?>
				</div>
				<p style="padding: 6px; margin: 0;">Ngày</p>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" name="luu" class="btn btn-info"><i class="fa fa-save"></i> Lưu</button>
			<a href="<?= url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Trở về</a>
		</div>
	</form>
	<?= content_close() ?>

<?php  } else { ?>
	<?= content_open('Danh sách bảo trì kiến trúc') ?>

	<a href="<?= url($url) . '&capnhat' ?>" class="btn btn-success"><i class="fa fa-plus"></i> Cập nhật số ngày còn lại đến hạn bảo trì</a>
	<hr>
	<?= $session->pull("info") ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên kiến trúc</th>
				<th>Hạn bảo trì</th>
				<th>Mức cảnh báo bảo trì</th>
				<th>Số ngày đến hạn bảo trì</th>
				<th>Trạng thái bảo trì</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$getdata = $db->ObjectBuilder()->get('kientruc');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $row->TenKienTruc ?></td>
					<td><?= $row->HanBaoTri ?></td>
					<td><?= $row->MucCanhBaoBT ?> ngày</td>
					<td><?= $row->SoNgayDenBT ?> ngày</td>
					<td style="background: <?= $row->TrangThaiBT ?>"></td>
					<td>
						<a href="<?= url($url . '&sua&id=' . $row->MaKienTruc) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Sửa</a>
						<!-- <a href="<-?= url($url . '&xoa&id=' . $row->MaKienTruc) ?>" class="btn btn-danger" onclick="return confirm('Xóa dữ liệu?')"><i class="fa fa-trash"></i> Xóa</a> -->
					</td>
				</tr>
			<?php
				$no++;
			}

			?>
		</tbody>
	</table>
	<?= content_close() ?>
<?php } ?>