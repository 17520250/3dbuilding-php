<?php
$title = "Loại kiến trúc";
$tieude = $title;
$url = 'loaikientruc';

if (isset($_POST['luu'])) {

	// kiểm tra xác nhận
	$validation = null;
	// kiểm tra xem tên loai kt đã tồn tại chưa
	if ($_POST['maloaikientruc'] != "") {
		$db->where('MaLoaiKienTruc !=' . $_POST['maloaikientruc']);
	}
	$db->where('TenLoaiKienTruc', $_POST['tenloaikientruc']);
	$db->get('loaikientruc');
	if ($db->count > 0) {
		$validation[] = 'Tên loại kiến trúc đã tồn tại';
	}
	// tên loai kt không thể để trống
	if ($_POST['tenloaikientruc'] == '') {
		$validation[] = 'Tên loại kiến trúc không được để trống';
	}

	if (count($validation) > 0) {
		$setTemplate = false;
		$session->set('error_validation', $validation);
		$session->set('error_value', $_POST);
		redirect($_SERVER['HTTP_REFERER']);
		return false;
	}
	// kiểm tra xác nhận

	$data['TenLoaiKienTruc'] = $_POST['tenloaikientruc'];
	$data['Symbol'] = $_POST['symbol'];
	$data['Color'] = $_POST['color'];
	$data['Size'] = $_POST['size'];
	$data['Width'] = $_POST['width'];
	$data['Height'] = $_POST['height'];

	if ($_POST['maloaikientruc'] == "") {
		$exec = $db->insert("loaikientruc", $data);
		$info = '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Thành công!</h4> Đã thêm dữ liệu thành công </div>';
	} else {
		$db->where('MaLoaiKienTruc', $_POST['maloaikientruc']);
		$exec = $db->update("loaikientruc", $data);
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
	$db->where('MaLoaiKienTruc', $ma);
	$db->get('kientruc');
	if ($db->count > 0) {
		$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Quá trình không thành công<br> Loại kiến trúc đang được sử dụng trong kiến trúc
              </div>');
	} else {
		$db->where("MaLoaiKienTruc", $_GET['id']);
		$exec = $db->delete("loaikientruc");
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
	$ma_loai_kien_truc = "";
	$ten_loai_kien_truc = "";
	$_symbol = "";
	$_color = "";
	$_size = "0";
	$_width = "0";
	$_height = "0";
	if (isset($_GET['sua']) and isset($_GET['id'])) {
		$id = $_GET['id'];
		$db->where('MaLoaiKienTruc', $id);
		$row = $db->ObjectBuilder()->getOne('loaikientruc');
		if ($db->count > 0) {
			$ma_loai_kien_truc = $row->MaLoaiKienTruc;
			$ten_loai_kien_truc = $row->TenLoaiKienTruc;
			$_symbol = $row->Symbol;
			$_color = $row->Color;
			$_size = $row->Size;
			$_width = $row->Width;
			$_height = $row->Height;
		}
	}
	// giá trị trong quá trình xác thực
	if ($session->get('error_value')) {
		extract($session->pull('error_value'));
	}
?>
	<?= content_open('Thông tin loại kiến trúc') ?>
	<form method="post" enctype="multipart/form-data">
		<?php
		// trả về lỗi xác thực
		if ($session->get('error_validation')) {
			foreach ($session->pull('error_validation') as $key => $value) {
				echo '<div class="alert alert-danger">' . $value . '</div>';
			}
		}
		?>
		<?= input_hidden('maloaikientruc', $ma_loai_kien_truc) ?>
		<div class="form-group">
			<label>Tên loại kiến trúc</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_text('tenloaikientruc', $ten_loai_kien_truc) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Symbol</label>
			<div class="row">
				<div class="col-md-4">
					<!-- <-?= input_text('symbol', $_symbol) ?> -->
					<?php
					$op = null;
					$op['polygon-3d'] = 'polygon-3d';
					$op['line-3d'] = 'line-3d';
					echo select('symbol', $op, $_symbol);
					?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Size</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_text('size', $_size) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Width</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_text('width', $_width) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Height</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_text('height', $_height) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Color</label>
			<div class="row">
				<div class="col-md-3">
					<?= input_color('color', $_color) ?>
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
	<?= content_open('Danh sách loại kiến trúc') ?>

	<a href="<?= url($url . '&them') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm loại kiến trúc</a>
	<hr>
	<?= $session->pull("info") ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên loại kiến trúc</th>
				<th>Symbol</th>
				<th>Size</th>
				<th>Width</th>
				<th>Height</th>
				<th>Color</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$getdata = $db->ObjectBuilder()->get('loaikientruc');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $row->TenLoaiKienTruc ?></td>
					<td><?= $row->Symbol ?></td>
					<td><?= $row->Size ?></td>
					<td><?= $row->Width ?></td>
					<td><?= $row->Height ?></td>
					<td style="background: <?= $row->Color ?>"></td>
					<td>
						<a href="<?= url($url . '&sua&id=' . $row->MaLoaiKienTruc) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Sửa</a>
						<a href="<?= url($url . '&xoa&id=' . $row->MaLoaiKienTruc) ?>" class="btn btn-danger" onclick="return confirm('Xóa dữ liệu?')"><i class="fa fa-trash"></i> Xóa</a>
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