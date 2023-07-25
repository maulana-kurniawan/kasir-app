<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
</head>

<body class="layout-top-nav">
	<div class="wrapper">
		<?php
		$this->load->view('includes/preloader');
		$this->load->view('includes/navbar');
		?>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Penjualan</h1>
						</div>
						<div class="col-sm-6">
							<div class="btn-group float-sm-right">
								<button class="btn bg-green" onclick="return filterin()">
									<i class="fas fa-filter fa-fw"></i>
								</button>
								<button class="btn bg-green" onclick="return tambah()">
									<i class="fas fa-plus-circle fa-fw"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body p-0">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center">Total Bayar</th>
												<th class="text-center">Total Piutang</th>
												<th class="text-center">Total Omset</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-right"><span class="float-left">Rp</span><?= number_format($total_bayar, 0, ".", "."); ?></td>
												<td class="text-right"><span class="float-left">Rp</span><?= number_format($total_piutang, 0, ".", "."); ?></td>
												<td class="text-right"><span class="float-left">Rp</span><?= number_format($total_omset, 0, ".", "."); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="card card-green">
								<div class="card-header">
									<h3 class="card-title">Daftar Penjualan</h3>
								</div>
								<div class="card-body">
									<table id="tabelku" class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center">No.</th>
												<th class="text-center">Customer</th>
												<th class="text-center">Tanggal</th>
												<th class="text-center">Waktu</th>
												<th class="text-center">Total</th>
												<th class="text-center">Tunai</th>
												<th class="text-center">Piutang</th>
												<th class="text-center">Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($read as $d) {
												$locale = "id_ID";
												$dateType = IntlDateFormatter::MEDIUM;
												$timeType = IntlDateFormatter::NONE;
												$formatter = new IntlDateFormatter($locale, $dateType, $timeType);
												$dateTime = new DateTime($d->waktu);
												$formatter->setPattern('d MMMM YYYY');
												$tanggalku = $formatter->format($dateTime);
											?>
												<tr>
													<td class="text-center"><?= $no++ ?>.</td>
													<td><?= $d->nama_customer ?></td>
													<td class="text-center"><?= $tanggalku; ?></td>
													<td class="text-center"><?= date('H:i', strtotime($d->waktu)); ?></td>
													<td class="text-right"><span class="float-left">Rp</span><?= number_format($d->total_omset, 0, ".", "."); ?></td>
													<td class="text-right"><span class="float-left">Rp</span><?= number_format($d->total_bayar, 0, ".", "."); ?></td>
													<td class="text-right"><span class="float-left">Rp</span><?= number_format($d->total_omset - $d->total_bayar, 0, ".", "."); ?></td>
													<td class="text-center">
														<div class="btn-group">
															<a class="btn bg-green" href="<?= base_url('transaksi/penjualan/cetak?id=' . $d->id); ?>" target="_blank"><i class="fas fa-print fa-fw"></i></a>
															<?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'admin') { ?>
																<a class="btn bg-red" onclick="return hapus(`<?= $d->id ?>`, `<?= $d->nama_customer ?>`)"><i class="fas fa-trash fa-fw"></i></a>
															<?php } ?>
														</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('includes/footer'); ?>
	</div>
	<form id="formulir" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
		<div id="Modal" class="modal fade" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 id="judul-modal" class="modal-title"></h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input id="id" name="id" type="hidden">
						<span id="modal-body-update-or-create">
							<div class="form-group">
								<label>Customer</label>
								<select id="id_customer" name="id_customer" class="form-control select2-green" data-dropdown-css-class="select2-green" style="width: 100%;" data-placeholder="Nama Customer" onchange="return cek_customer()">
									<?php foreach ($customer as $c) { ?>
										<option value="<?= $c->id; ?><?= $c->status; ?>"><?= $c->nama_customer; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="card card-green">
								<div class="card-header">
									<h3 class="card-title">Transaksi</h3>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label>Produk</label>
										<select id="id_produk" name="id_produk" class="form-control select2-green" data-dropdown-css-class="select2-green" style="width: 100%;" data-placeholder="Nama Produk" onchange="return get_produk()">
											<?php foreach ($produk as $p) { ?>
												<option value="<?= $p->id; ?>"><?= $p->nama_produk; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
										<input id="nama_produk" type="text" class="form-control d-none" readonly>
									</div>
									<div class="form-group">
										<label>Harga Jual</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
											<input id="harga_jual" type="text" class="form-control" readonly>
										</div>
									</div>
									<div class="form-group">
										<label>Kuantitas</label>
										<input id="kuantitas" name="kuantitas" type="number" class="form-control" placeholder="Kuantitas" max="999">
									</div>
								</div>
								<div class="card-footer">
									<button type="button" class="btn btn-block bg-green" onclick="return simpan()">Tambah ke Keranjang</button>
								</div>
							</div>
							<div id="total-bayar" class="form-group d-none">
								<label>Total Bayar</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											Rp
										</div>
									</div>
									<input id="total_bayar" name="total_bayar" type="text" class="form-control" placeholder="Total Bayar">
								</div>
							</div>
							<div class="card card-green">
								<div class="card-header">
									<h3 class="card-title">Keranjang</h3>
								</div>
								<div class="card-body p-0">
									<table class="table">
										<thead>
											<tr>
												<th class="text-center">Produk</th>
												<th class="text-center">Kuantitas</th>
												<th class="text-center">Harga</th>
												<th class="text-center">Total</th>
												<th class="text-center">Opsi</th>
											</tr>
										</thead>
										<tbody id="keranjang">
											<tr>
												<td class="text-center" colspan="5">Keranjang masih kosong!</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</span>
						<span id="modal-body-filter">
							<div class="form-group">
								<label>Dari</label>
								<input type="date" id="dari" name="dari" class="form-control" value="<?= $dari; ?>">
							</div>
							<div class="form-group">
								<label>Sampai</label>
								<input type="date" id="sampai" name="sampai" class="form-control" value="<?= $sampai; ?>">
							</div>
						</span>
						<span id="modal-body-delete">
							Apakah anda yakin ingin menghapus <b id="name-delete"></b> dari tabel ini?
						</span>
					</div>
					<div class="modal-footer justify-content-between">
						<button id="modal-button" type="submit" class="btn btn-block">Oke</button>
						<button id="batal" type="button" class="btn btn-block" data-dismiss="modal">Batal</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
<?php $this->load->view('includes/script'); ?>
<script>
	$(function() {
		$('#tabelku').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': true,
			'ordering': true,
			'info': true,
			'autoWidth': false,
			'responsive': true,
			'language': {
				'url': '<?= base_url('assets/plugins/datatables/i18n/id.json'); ?>'
			}
		});
		$('#formulir').validate({
			rules: {
				id_customer: {
					required: true
				},
				total_bayar: {
					required: true
				}
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});
		<?php if ($this->session->flashdata('emptycart')) { ?>
			Toast.fire({
				icon: 'warning',
				html: 'Pilih dulu <b>produk</b> dan <b>kuantitas</b> yang diinginkan!'
			});
		<?php } ?>
	});

	function cek_customer() {
		$('#id_customer').on('change', function() {
			var id = $(this).val().replace(/^\d/g, '');
			$('#total_bayar').inputmask({
				alias: 'numeric',
				groupSeparator: '.',
				digits: 0,
				digitsOptional: true
			});
			if (id == 'Karyawan') {
				$('#total-bayar').removeClass('d-none');
			} else {
				$('#total-bayar').addClass('d-none');
			}
		});
	}

	function get_produk() {
		var id = $('#id_produk').val();
		if (!id) {
			return false;
		} else {
			$.ajax({
				url: "<?= base_url('dapatkan-produk'); ?>",
				method: 'GET',
				dataType: 'JSON',
				data: {
					id: id
				},
				success: function(data) {
					$('#nama_produk').val(data[0].nama_produk);
					$('#harga_jual').val(data[0].harga_jual).inputmask({
						alias: 'numeric',
						groupSeparator: '.',
						digits: 0,
						digitsOptional: true
					});
				},
			})
		}
	}

	function simpan() {
		var id = $('#id_produk').val();
		var qty = $('#kuantitas').val();
		if (id == null || qty > 999) {
			Toast.fire({
				icon: 'warning',
				html: 'Pilih dulu <b>produk</b> dan <b>kuantitas</b> yang diinginkan!'
			});
		} else {
			$.ajax({
				url: '<?= base_url('transaksi/penjualan/simpan'); ?>',
				method: 'GET',
				dataType: false,
				data: {
					id: id,
					qty: qty,
				},
				success: function(data) {
					$('#keranjang').html(data);
					$('#id_produk').val(null).trigger('change');
					$('#kuantitas').val('');
				},
			});
		}
	}

	function tambahin(row_id, qty) {
		$.ajax({
			url: '<?= base_url('transaksi/penjualan/keranjang/tambah'); ?>',
			method: 'GET',
			dataType: false,
			data: {
				rowid: row_id,
				qty: qty,
			},
			success: function(data) {
				$('#keranjang').html(data);
			},
		});
	}

	function kurangin(row_id, qty) {
		$.ajax({
			url: '<?= base_url('transaksi/penjualan/keranjang/kurang'); ?>',
			method: 'GET',
			dataType: false,
			data: {
				rowid: row_id,
				qty: qty,
			},
			success: function(data) {
				$('#keranjang').html(data);
			},
		});
	}

	function batalin(row_id) {
		$.ajax({
			url: '<?= base_url('transaksi/penjualan/keranjang/hapus'); ?>',
			method: 'GET',
			dataType: false,
			data: {
				rowid: row_id,
			},
			success: function(data) {
				$('#keranjang').html(data);
			},
		});
	}

	function filterin() {
		$('#Modal').modal('show');
		$('.modal-dialog').removeClass('modal-lg');
		$('#formulir').removeAttr('action');
		$('#judul-modal').html('Filter Menurut Tanggal');
		$('#modal-body-update-or-create').addClass('d-none');
		$('#modal-body-filter').removeClass('d-none');
		$('#modal-body-delete').addClass('d-none');
		$('#modal-button').removeClass('bg-red').addClass('bg-green').attr('name', 'cari');
		$('#batal').removeClass('bg-green').addClass('bg-red');
	}

	function tambah() {
		$('#Modal').modal('show');
		$('.modal-dialog').addClass('modal-lg');
		$('#formulir').attr('action', '<?= base_url('transaksi/penjualan/tambah'); ?>');
		$('#judul-modal').html('Tambah Data');
		$('#modal-body-update-or-create').removeClass('d-none');
		$('#modal-body-filter').addClass('d-none');
		$('#modal-body-delete').addClass('d-none');
		$('#total-bayar').addClass('d-none');
		$('#id').val('');
		$('#id_customer').select2({
			dropdownParent: $('#Modal'),
		}).val(null).trigger('change');
		$('#id_produk').select2({
			dropdownParent: $('#Modal'),
		}).val(null).trigger('change');
		$('#kuantitas').val('');
		$('#modal-button').removeClass('bg-red').addClass('bg-green').removeAttr('name');
		$('#batal').removeClass('bg-green').addClass('bg-red');
	}

	<?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'admin') { ?>

		function hapus(id, nama_customer) {
			$('#Modal').modal('show');
			$('.modal-dialog').removeClass('modal-lg');
			$('#formulir').attr('action', '<?= base_url('transaksi/penjualan/hapus'); ?>');
			$('#judul-modal').html('Hapus Data');
			$('#modal-body-update-or-create').addClass('d-none');
			$('#modal-body-filter').addClass('d-none');
			$('#modal-body-delete').removeClass('d-none');
			$('#id').val(id);
			$('#name-delete').html(nama_customer);
			$('#modal-button').removeClass('bg-green').addClass('bg-red').removeAttr('name');
			$('#batal').removeClass('bg-red').addClass('bg-green');
		}
	<?php } ?>
</script>

</html>
