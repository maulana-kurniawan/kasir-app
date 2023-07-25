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
							<h1 class="m-0">Produk</h1>
						</div>
						<div class="col-sm-6">
							<button class="btn bg-green float-sm-right" onclick="return tambah()">
								<i class="fas fa-plus-circle fa-fw"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="card card-green">
								<div class="card-header">
									<h3 class="card-title">Daftar Produk</h3>
								</div>
								<div class="card-body">
									<table id="tabelku" class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center">No.</th>
												<th class="text-center">Produk</th>
												<th class="text-center">Owner</th>
												<th class="text-center">Kuantitas</th>
												<th class="text-center">Harga Beli</th>
												<th class="text-center">Harga Jual</th>
												<th class="text-center">Margin</th>
												<th class="text-center">Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($read as $d) {
												$margin = $d->harga_jual - $d->harga_beli; ?>
												<tr>
													<td class="text-center"><?= $no++ ?>.</td>
													<td><?= $d->nama_produk ?></span></td>
													<td class="text-center"><?= $d->nama_owner ?></span></td>
													<td class="text-center"><?= $d->kuantitas ?></span></td>
													<td>Rp<span class="float-right"><?= number_format($d->harga_beli, 0, ".", "."); ?></span></td>
													<td>Rp<span class="float-right"><?= number_format($d->harga_jual, 0, ".", "."); ?></td>
													<td>Rp<span class="float-right"><?= number_format($margin, 0, ".", "."); ?></td>
													<td class="text-center">
														<div class="btn-group">
															<a class="btn bg-green" onclick="return ubah(`<?= $d->id ?>`, `<?= $d->id_kategori ?>`, `<?= $d->id_owner ?>`, `<?= $d->nama_owner ?>`, `<?= $d->nama_produk ?>`, `<?= $d->kuantitas ?>`, `<?= $d->harga_beli ?>`, `<?= $d->harga_jual ?>`)"><i class="fas fa-edit fa-fw"></i></a>
															<a class="btn bg-red" onclick="return hapus(`<?= $d->id ?>`, `<?= $d->nama_produk ?>`)"><i class="fas fa-trash fa-fw"></i></a>
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
								<label>Kategori</label>
								<select id="id_kategori" name="id_kategori" class="form-control select2-green" data-dropdown-css-class="select2-green" style="width: 100%;" data-placeholder="Nama Kategori">
									<?php foreach ($kategori as $k) { ?>
										<option value="<?= $k->id; ?>"><?= $k->nama_kategori; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Owner</label>
								<select id="id_owner" name="id_owner" class="form-control select2-green" data-dropdown-css-class="select2-green" style="width: 100%;" data-placeholder="Nama Owner">
									<?php foreach ($owner as $o) { ?>
										<option value="<?= $o->id; ?>"><?= $o->nama_owner; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Nama Produk</label>
								<input id="nama_produk" name="nama_produk" type="text" class="form-control" maxlength="50" placeholder="Nama Produk">
							</div>
							<div class="form-group">
								<label>Kuantitas</label>
								<input id="kuantitas" name="kuantitas" type="number" class="form-control" max="999" placeholder="Kuantitas">
							</div>
							<div class="form-group">
								<label>Harga Beli</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Rp</span>
									</div>
									<input id="harga_beli" name="harga_beli" type="text" class="form-control" placeholder="Harga Beli">
								</div>
							</div>
							<div class="form-group">
								<label>Harga Jual</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">Rp</span>
									</div>
									<input id="harga_jual" name="harga_jual" type="text" class="form-control" placeholder="Harga Jual">
								</div>
							</div>
						</span>
						<span id="modal-body-delete">
							Apakah anda yakin ingin menghapus <b id="name-delete"></b> dari tabel ini?
						</span>
					</div>
					<div class="modal-footer justify-content-between">
						<div class="col-12">
							<button id="modal-button" type="submit" class="btn btn-block">Oke</button>
							<button id="batal" type="button" class="btn btn-block" data-dismiss="modal">Batal</button>
						</div>
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
				id_kategori: {
					required: true
				},
				id_owner: {
					required: true
				},
				nama_produk: {
					required: true
				},
				kuantitas: {
					required: true
				},
				harga_beli: {
					required: true
				},
				harga_jual: {
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
	});

	function tambah() {
		$('#Modal').modal('show');
		$('#formulir').attr('action', '<?= base_url('master/produk/tambah'); ?>');
		$('#judul-modal').html('Tambah Data');
		$('#modal-body-update-or-create').removeClass('d-none');
		$('#modal-body-delete').addClass('d-none');
		$('#id').val('');
		$('#id_kategori').select2({
			dropdownParent: $('#Modal')
		}).val(null).trigger('change');
		$('#id_owner').select2({
			dropdownParent: $('#Modal')
		}).val(null).trigger('change');
		$('#nama_produk').val('');
		$('#kuantitas').val('');
		$('#harga_beli').inputmask({
			alias: 'numeric',
			groupSeparator: '.',
			digits: 0,
			digitsOptional: true
		}).val('');
		$('#harga_jual').inputmask({
			alias: 'numeric',
			groupSeparator: '.',
			digits: 0,
			digitsOptional: true
		}).val('');
		$('#modal-button').removeClass('bg-red').addClass('bg-green');
		$('#batal').removeClass('bg-green').addClass('bg-red');
	}

	function ubah(id, id_kategori, id_owner, nama_owner, nama_produk, kuantitas, harga_beli, harga_jual) {
		$('#Modal').modal('show');
		$('#formulir').attr('action', '<?= base_url('master/produk/ubah'); ?>');
		$('#judul-modal').html('Ubah Data');
		$('#modal-body-update-or-create').removeClass('d-none');
		$('#modal-body-delete').addClass('d-none');
		$('#id').val(id);
		$('#id_kategori').select2({
			dropdownParent: $('#Modal')
		}).val(id_kategori).trigger('change');
		$('#id_owner').select2({
			dropdownParent: $('#Modal')
		}).val(id_owner).trigger('change');
		$('#nama_produk').val(nama_produk);
		$('#kuantitas').val(kuantitas);
		$('#harga_beli').inputmask({
			alias: 'numeric',
			groupSeparator: '.',
			digits: 0,
			digitsOptional: true
		}).val(harga_beli);
		$('#harga_jual').inputmask({
			alias: 'numeric',
			groupSeparator: '.',
			digits: 0,
			digitsOptional: true
		}).val(harga_jual);
		$('#modal-button').removeClass('bg-red').addClass('bg-green');
		$('#batal').removeClass('bg-green').addClass('bg-red');
	}

	function hapus(id, nama_produk) {
		$('#Modal').modal('show');
		$('#formulir').attr('action', '<?= base_url('master/produk/hapus'); ?>');
		$('#judul-modal').html('Hapus Data');
		$('#modal-body-update-or-create').addClass('d-none');
		$('#modal-body-delete').removeClass('d-none');
		$('#id').val(id);
		$('#name-delete').html(nama_produk);
		$('#modal-button').removeClass('bg-green').addClass('bg-red');
		$('#batal').removeClass('bg-red').addClass('bg-green');
	}
</script>

</html>
