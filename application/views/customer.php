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
							<h1 class="m-0">Customer</h1>
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
									<h3 class="card-title">Daftar Customer</h3>
								</div>
								<div class="card-body">
									<table id="tabelku" class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center">No.</th>
												<th class="text-center">Nama Customer</th>
												<th class="text-center">Status</th>
												<th class="text-center">Opsi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($read as $d) { ?>
												<tr>
													<td class="text-center"><?= $no++ ?>.</td>
													<td><?= $d->nama_customer ?></span></td>
													<td class="text-center"><?= $d->status ?></span></td>
													<td class="text-center">
														<div class="btn-group">
															<a class="btn bg-green" onclick="return ubah(`<?= $d->id ?>`, `<?= $d->nama_customer ?>`, `<?= $d->status ?>`)"><i class="fas fa-edit fa-fw"></i></a>
															<a class="btn bg-red" onclick="return hapus(`<?= $d->id ?>`, `<?= $d->nama_customer ?>`)"><i class="fas fa-trash fa-fw"></i></a>
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
	<form id="formulir" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
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
								<label>Nama Customer</label>
								<input id="nama_customer" name="nama_customer" type="text" class="form-control" maxlength="50" placeholder="Nama Customer">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select id="status" name="status" class="form-control">
									<option hidden selected disabled value="">Status</option>
									<option value="Mahasiswa">Mahasiswa</option>
									<option value="Karyawan">Karyawan</option>
								</select>
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
				nama_customer: {
					required: true
				},
				status: {
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
		$('#formulir').attr('action', '<?= base_url('master/customer/tambah'); ?>');
		$('#judul-modal').html('Tambah Data');
		$('#modal-body-update-or-create').removeClass('d-none');
		$('#modal-body-delete').addClass('d-none');
		$('#id').val('');
		$('#nama_customer').val('');
		$('#status').val('');
		$('#modal-button').removeClass('bg-red').addClass('bg-green');
		$('#batal').removeClass('bg-green').addClass('bg-red');
	}

	function ubah(id, nama_customer, status) {
		$('#Modal').modal('show');
		$('#formulir').attr('action', '<?= base_url('master/customer/ubah'); ?>');
		$('#judul-modal').html('Ubah Data');
		$('#modal-body-update-or-create').removeClass('d-none');
		$('#modal-body-delete').addClass('d-none');
		$('#id').val(id);
		$('#nama_customer').val(nama_customer);
		$('#status').val(status);
		$('#modal-button').removeClass('bg-red').addClass('bg-green');
		$('#batal').removeClass('bg-green').addClass('bg-red');
	}

	function hapus(id, nama_customer) {
		$('#Modal').modal('show');
		$('#formulir').attr('action', '<?= base_url('master/customer/hapus'); ?>');
		$('#judul-modal').html('Hapus Data');
		$('#modal-body-update-or-create').addClass('d-none');
		$('#modal-body-delete').removeClass('d-none');
		$('#id').val(id);
		$('#name-delete').html(nama_customer);
		$('#modal-button').removeClass('bg-green').addClass('bg-red');
		$('#batal').removeClass('bg-red').addClass('bg-green');
	}
</script>

</html>
