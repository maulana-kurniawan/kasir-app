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
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Profil</h1>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-5 mx-auto">
							<div class="card card-green card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="<?= base_url('assets/img/' . $this->session->userdata('foto')); ?>" alt="User profile picture">
									</div>
									<ul class="list-group list-group-unbordered mt-3 mb-3">
										<li class="list-group-item">
											<b>Nama</b> <span class="text-green float-right"><?= $this->session->userdata('nama'); ?></span>
										</li>
										<li class="list-group-item">
											<b>Username</b> <span class="text-green float-right">@<?= $this->session->userdata('username'); ?></span>
										</li>
										<li class="list-group-item">
											<b>Akses</b> <span class="text-green float-right"><?= $this->session->userdata('akses'); ?></span>
										</li>
									</ul>
									<button id="ubah-foto" type="button" class="btn btn-block bg-green">Ubah Foto</button>
									<button id="ubah-password" type="button" class="btn btn-block bg-green">Ubah Password</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('includes/footer'); ?>
	</div>
	<div id="Modal" class="modal fade" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<span id="modal-foto">
						<div class="form-group">
							<label>Foto</label>
							<div class="input-group">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="foto">
									<label class="custom-file-label" for="foto"></label>
								</div>
							</div>
						</div>
						<div class="col-1-2">
							<div class="d-none" id="hasil-upload"></div>
						</div>
					</span>
					<span id="modal-password">
						<div class="form-group">
							<label>Password</label>
							<input id="password" name="password" type="password" class="form-control" placeholder="Masukkan password baru">
						</div>
						<div class="form-group">
							<label>Konfirmasi Password</label>
							<input id="konfir-password" name="konfir-password" type="password" class="form-control" placeholder="Konfirmasi password baru">
						</div>
						<div class="icheck-green">
							<input id="cek" type="checkbox">
							<label for="cek">Tampilkan password</label>
						</div>
					</span>
				</div>
				<div class="modal-footer justify-content-between">
					<button id="modal-button" type="button" class="btn btn-block bg-green">Oke</button>
					<button type="button" class="btn btn-block bg-red" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('includes/script'); ?>
<script>
	$(function() {
		bsCustomFileInput.init();
		$('#ubah-foto').on('click', function() {
			$('#foto').val('');
			$('.custom-file-label').html('Pilih foto');
			$('#hasil-upload').removeClass('croppie-container').addClass('d-none').html('');
			$cropFoto = $('#hasil-upload').croppie({
				enableExif: true,
				viewport: {
					width: 250,
					height: 250,
					type: 'square'
				},
				boundary: {
					width: 300,
					height: 300
				}
			});
			$('#Modal').modal('show');
			$('.modal-title').html('Ubah Foto');
			$('#modal-foto').removeClass('d-none');
			$('#modal-password').addClass('d-none');
			$('#modal-button').on('click', function(ev) {
				var foto = $('#foto');
				if (!foto.val()) {
					Toast.fire({
						icon: 'warning',
						html: 'Foto tidak boleh kosong'
					});
				} else {
					$cropFoto.croppie('result', {
						type: 'canvas',
						size: 'viewport'
					}).then(function(resp) {
						$.ajax({
							url: '<?= base_url('profil/ubah/foto'); ?>',
							type: 'POST',
							data: {
								'image': resp
							},
							success: function(data) {
								html = '<img src="' + resp + '" />';
								$('#hasil-upload').addClass('d-none').html(html);
								window.location.href = '<?= base_url('profil'); ?>';
							}
						});
					});
				}
			});
		});
		$('#foto').on('change', function() {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#hasil-upload').removeClass('d-none');
				$cropFoto.croppie('bind', {
					url: e.target.result
				}).then(function() {
					console.log('jQuery bind complete');
				});
			}
			reader.readAsDataURL(this.files[0]);
		});
		$('#ubah-password').on('click', function() {
			$('#Modal').modal('show');
			$('.modal-title').html('Ubah Password');
			$('#modal-password').removeClass('d-none');
			$('#modal-foto').addClass('d-none');
			$('#modal-button').on('click', function() {
				var password = $('#password');
				var konfir_password = $('#konfir-password');
				if (!password.val() || !konfir_password.val()) {
					Toast.fire({
						icon: 'warning',
						html: 'Password tidak boleh kosong'
					});
				} else if (password.val() != konfir_password.val()) {
					Toast.fire({
						icon: 'warning',
						html: 'Password tidak sama'
					});
				} else {
					$.ajax({
						url: '<?= base_url('profil/ubah/password'); ?>',
						type: 'POST',
						data: {
							password: password.val()
						},
						success: function(response) {
							if (response == 'done') {
								window.location.href = '<?= base_url('profil'); ?>';
							} else {
								Toast.fire({
									icon: 'error',
									html: 'Gagal mengubah password'
								});
							}
						},
						error: function(response) {
							Toast.fire({
								icon: 'error',
								html: 'Terjadi kesalahan pada server'
							});
						}
					});
				}
			});
		});
	});
</script>

</html>