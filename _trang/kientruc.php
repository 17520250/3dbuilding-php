<?php
$title = "Kiến trúc";
$tieude = $title;
$url = 'kientruc';

if (isset($_POST['luu'])) {

	// kiểm tra xác nhận
	$validation = null;
	// kiểm tra xem tên loai kt đã tồn tại chưa
	if ($_POST['makientruc'] != "") {
		$db->where('MaKienTruc !=' . $_POST['makientruc']);
	}
	$db->where('TenKienTruc', $_POST['tenkientruc']);
	$db->get('kientruc');
	if ($db->count > 0) {
		$validation[] = 'Tên kiến trúc đã tồn tại';
	}
	// tên loai kt không thể để trống
	if ($_POST['tenkientruc'] == '') {
		$validation[] = 'Tên kiến trúc không được để trống';
	}


	if (count($validation) > 0) {
		$setTemplate = false;
		$session->set('error_validation', $validation);
		$session->set('error_value', $_POST);
		redirect($_SERVER['HTTP_REFERER']);
		return false;
	}
	// kiểm tra xác nhận

	$data['MaLoaiKienTruc'] = $_POST['maloaikientruc'];
	$data['MaVatLieu'] = $_POST['mavatlieu'];
	$data['MaTang'] = $_POST['matang'];
	$data['TenKienTruc'] = $_POST['tenkientruc'];
	$data['NgayHoanThanh'] = $_POST['ngayhoanthanh'];
	$data['HanSuDungVL'] = $_POST['hansudungvl'];

	$month = $_POST['hansudungvl'];
	$ngay_hoan_thanh = $_POST['ngayhoanthanh'];
	$han_bao_tri = strtotime(date("Y-m-d", strtotime($ngay_hoan_thanh)) . " + $month month");
	$han_bao_tri = strftime("%Y-%m-%d", $han_bao_tri);
	// tính số ngày còn lại đến bảo trì
	$today = date('Y-m-d');
	$first_date = strtotime($han_bao_tri);
	$second_date = strtotime($today);
	$datediff = abs($first_date - $second_date);
	$result =  floor($datediff / (60 * 60 * 24));

	$data['SoNgayDenBT'] = $result;
	$data['HanBaoTri'] = $han_bao_tri;

	$file = upload('geojsonkientruc', 'geojson');

	if ($file != false) {
		$data['GeojsonKienTruc'] = $file;
		if ($_POST['makientruc'] != '') {
			// xóa các tệp trong thư mục
			$db->where('MaKienTruc', $_GET['id']);
			$get = $db->ObjectBuilder()->getOne('kientruc');
			$geojson_kien_truc = $get->GeojsonKienTruc;
			unlink('assets/upload/geojson/' . $geojson_kien_truc);
			// kết thúc xóa các tệp trong thư mục
		}
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

if (isset($_GET['xoa'])) {
	$setTemplate = false;

	$ma = $_GET['id'];
	$db->where('MaKienTruc', $ma);
	$getdata = $db->ObjectBuilder()->getOne('kientruc');
	if ($getdata->SoNgayDenBT > 0) {
		$session->set("info", '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4> Quá trình không thành công<br> Kiến trúc chưa đến hạn bảo trì
              </div>');
	} else {

		// xóa các tệp trong thư mục
		$db->where('MaKienTruc', $_GET['id']);
		$get = $db->ObjectBuilder()->getOne('kientruc');
		$geojson_kien_truc = $get->GeojsonKienTruc;
		unlink('assets/upload/geojson/' . $geojson_kien_truc);
		// kết thúc xóa các tệp trong thư mục

		$db->where("MaKienTruc", $_GET['id']);
		$exec = $db->delete("kientruc");
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
	$ma_kien_truc = "";
	$ma_loai_kien_truc = "";
	$ma_vat_lieu = "";
	$ma_tang = "";
	$ten_kien_truc = "";
	$ngay_hoan_thanh = date('Y-m-d');
	$han_su_dung_vl = "";
	// $han_bao_tri = date('Y-m-d');
	$geojson_kien_truc = "";

	if (isset($_GET['sua']) and isset($_GET['id'])) {
		$id = $_GET['id'];
		$db->where('MaKienTruc', $id);
		$row = $db->ObjectBuilder()->getOne('kientruc');
		if ($db->count > 0) {
			$ma_kien_truc = $row->MaKienTruc;
			$ma_loai_kien_truc = $row->MaLoaiKienTruc;
			$ma_vat_lieu = $row->MaVatLieu;
			$ma_tang = $row->MaTang;
			$ten_kien_truc = $row->TenKienTruc;
			$ngay_hoan_thanh = $row->NgayHoanThanh;
			$han_su_dung_vl = $row->HanSuDungVL;
			//$han_bao_tri = $row->HanBaoTri;			
			$geojson_kien_truc = $row->GeojsonKienTruc;
		}
	}
	// giá trị trong quá trình xác thực
	if ($session->get('error_value')) {
		extract($session->pull('error_value'));
	}
?>
	<?= content_open('Thông tin kiến trúc') ?>
	<form method="post" enctype="multipart/form-data">
		<?php
		// trả về lỗi xác thực
		if ($session->get('error_validation')) {
			foreach ($session->pull('error_validation') as $key => $value) {
				echo '<div class="alert alert-danger">' . $value . '</div>';
			}
		}
		?>
		<?= input_hidden('makientruc', $ma_kien_truc) ?>
		<div class="form-group">
			<label>Tên kiến trúc</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_text('tenkientruc', $ten_kien_truc) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Loại kiến trúc</label>
			<div class="row">
				<div class="col-md-4">
					<?php
					$op[''] = '-- Chọn loại kiến trúc --';
					foreach ($db->ObjectBuilder()->get('loaikientruc') as $row) {
						$op[$row->MaLoaiKienTruc] = $row->TenLoaiKienTruc;
					}
					?>
					<?= select('maloaikientruc', $op, $ma_loai_kien_truc) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Vật liệu</label>
			<div class="row">
				<div class="col-md-4">
					<?php
					$op[''] = '-- Chọn vật liệu --';
					foreach ($db->ObjectBuilder()->get('vatlieu') as $row) {
						$op[$row->MaVatLieu] = $row->TenVatLieu;
					}
					?>
					<?= select('mavatlieu', $op, $ma_vat_lieu) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Tầng</label>
			<div class="row">
				<div class="col-md-4">
					<?php
					$op[''] = '-- Chọn tầng --';
					foreach ($db->ObjectBuilder()->get('tang') as $row) {
						$op[$row->MaTang] = $row->TenTang;
					}
					?>
					<?= select('matang', $op, $ma_tang) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>GeoJSON</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_file('geojsonkientruc', '') ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Ngày hoàn thành</label>
			<div class="row">
				<div class="col-md-4">
					<?= input_date('ngayhoanthanh', $ngay_hoan_thanh) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>HSD vật liệu</label>
			<div class="row">
				<div class="col-md-3">
					<?= input_number('hansudungvl', $han_su_dung_vl) ?>
				</div>
				<p style="padding: 6px; margin: 0;">Tháng</p>
			</div>
		</div>

		<div class="form-group">
			<button type="submit" name="luu" class="btn btn-info"><i class="fa fa-save"></i> Lưu</button>
			<a href="<?= url($url) ?>" class="btn btn-danger"><i class="fa fa-reply"></i> Trở về</a>
		</div>
	</form>
	<?= content_close() ?>

<?php  } else { ?>
	<?= content_open('Danh sách kiến trúc') ?>

	<a href="<?= url($url . '&them') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm kiến trúc</a>
	<hr>
	<?= $session->pull("info") ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>STT</th>
				<th>Tên kiến trúc</th>
				<th>Loại kiến trúc</th>
				<th>Vật liệu</th>
				<th>Tầng</th>
				<th>GeoJSON</th>
				<th>Ngày hoàn thành</th>
				<th>HSD vật liệu</th>
				<th>Hạn bảo trì</th>
				<th>Hành động</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$db->join('loaikientruc b', 'a.MaLoaiKienTruc=b.MaLoaiKienTruc', 'LEFT');
			$db->join('vatlieu c', 'a.MaVatLieu=c.MaVatLieu', 'LEFT');
			$db->join('tang d', 'a.MaTang=d.MaTang', 'LEFT');
			$getdata = $db->ObjectBuilder()->get('kientruc a');
			foreach ($getdata as $row) {
			?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $row->TenKienTruc ?></td>
					<td><?= $row->TenLoaiKienTruc ?></td>
					<td><?= $row->TenVatLieu ?></td>
					<td><?= $row->TenTang ?></td>
					<td><a href="<?= assets('upload/geojson/' . $row->GeojsonKienTruc) ?>" target="_BLANK"><?= $row->GeojsonKienTruc ?></a></td>
					<td><?= $row->NgayHoanThanh ?></td>
					<td><?= $row->HanSuDungVL ?> tháng</td>
					<td><?= $row->HanBaoTri ?></td>

					<td>
						<a href="<?= url($url . '&sua&id=' . $row->MaKienTruc) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Sửa</a>
						<a href="<?= url($url . '&xoa&id=' . $row->MaKienTruc) ?>" class="btn btn-danger" onclick="return confirm('Xóa dữ liệu?')"><i class="fa fa-trash"></i> Xóa</a>
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