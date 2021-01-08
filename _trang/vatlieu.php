<?php
$title = "Vật liệu";
$tieude = $title;
$url = 'vatlieu';

if (isset($_POST['luu'])) {

	// kiểm tra xác nhận
	$validation = null;
	// kiểm tra xem tên vật liệu đã tồn tại chưa
	if ($_POST['mavatlieu'] != "") {
		$db->where('MaVatLieu !=' . $_POST['mavatlieu']);
	}
	$db->where('TenVatLieu', $_POST['tenvatlieu']);
	$db->get('vatlieu');
	if ($db->count > 0) {
		$validation[] = 'Tên vật liệu đã tồn tại';
	}
	// tên vật liệu không thể để trống
	if ($_POST['tenvatlieu'] == '') {
		$validation[] = 'Tên vật liệu không được để trống';
	}

	if (count($validation) > 0) {
		$setTemplate = false;
		$session->set('error_validation', $validation);
		$session->set('error_value', $_POST);
		redirect($_SERVER['HTTP_REFERER']);
		return false;
	}
	// kiểm tra xác nhận


	$data['TenVatLieu'] = $_POST['tenvatlieu'];

	if ($_POST['mavatlieu'] == "") {
		$exec = $db->insert("vatlieu", $data);
		$info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Thành công!</h4> Đã thêm dữ liệu thành công </div>';
	} else {
		$db->where('MaVatLieu', $_POST['mavatlieu']);
		$exec = $db->update("vatlieu", $data);
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

if (isset($_GET['xoa'])) {
	$setTemplate = false;

	$ma = $_GET['id'];
	$db->where('MaVatLieu', $ma);
	$db->get('kientruc');
	if ($db->count > 0) {
		$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Quá trình không thành công<br> Vật liệu đang được sử dụng trong kiến trúc
              </div>');
	} else {

		$db->where("MaVatLieu", $_GET['id']);

		$exec = $db->delete("vatlieu");
		$info = '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Thành công!</h4> Đã xóa dữ liệu thành công </div>';
		if ($exec) {
			$session->set('info', $info);
		} else {
			$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Quá trình không thành công
              </div>');
		}
	}
	redirect(url($url));
} else if (isset($_GET['them']) or isset($_GET['sua'])) {
	$ma_vat_lieu = "";
	$ten_vat_lieu = "";
	if (isset($_GET['sua']) and isset($_GET['id'])) {
		$id = $_GET['id'];
		$db->where('MaVatLieu', $id);
		$row = $db->ObjectBuilder()->getOne('vatlieu');
		if ($db->count > 0) {
			$ma_vat_lieu = $row->MaVatLieu;
			$ten_vat_lieu = $row->TenVatLieu;
		}
	}
	// giá trị trong quá trình xác thực
	if ($session->get('error_value')) {
		extract($session->pull('error_value'));
	}
?>
	<?= content_open('Thông tin vật liệu') ?>
	<form method="post" enctype="multipart/form-data">
		<?php
		// trả về lỗi xác thực
		if ($session->get('error_validation')) {
			foreach ($session->pull('error_validation') as $key => $value) {
				echo '<div class="alert alert-danger">' . $value . '</div>';
			}
		}
		?>
		<?= input_hidden('mavatlieu', $ma_vat_lieu) ?>
		<div class="form-group">
			<label>Tên vật liệu</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_text('tenvatlieu', $ten_vat_lieu) ?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<button type="submit" name="luu" class="btn btn-info"><i class="fa fa-save"></i> Lưu</button>
			<a href="<?= url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Trở về</a>
		</div>
	</form>
	<?= content_close() ?>

<?php  } else { ?>
	<?= content_open('Danh sách vật liệu') ?>

	<a href="<?= url($url . '&them') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm vật liệu</a>
	<hr>
	<?= $session->pull("info") ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên vật liệu</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$getdata = $db->ObjectBuilder()->get('vatlieu');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $row->TenVatLieu ?></td>


					<td>
						<a href="<?= url($url . '&sua&id=' . $row->MaVatLieu) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Sửa</a>
						<a href="<?= url($url . '&xoa&id=' . $row->MaVatLieu) ?>" class="btn btn-danger" onclick="return confirm('Xóa dữ liệu?')"><i class="fa fa-trash"></i> Xóa</a>
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