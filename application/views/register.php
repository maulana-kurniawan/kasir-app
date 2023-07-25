<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
</head>

<body class="register-page">
	<div class="register-box">
		<div class="card card-outline card-green">
			<div class="card-header text-center">
				<a href="#" class="h1 text-dark"><b>Kasir</b> RE</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Daftarkan pengguna anda</p>
				<form id="formulir" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
					<div class="input-group mb-3">
						<input id="username" name="username" type="text" class="form-control" placeholder="Username" maxlength="25">
					</div>
					<div class="input-group mb-3">
						<input id="password" name="password" type="password" class="form-control" placeholder="Password">
					</div>
					<div class="input-group mb-3">
						<input id="nama" name="nama" type="text" class="form-control" placeholder="Nama lengkap" maxlength="30">
					</div>
					<div class="input-group mb-3">
						<select id="akses" name="akses" class="form-control">
							<option hidden selected disabled value="">Akses</option>
							<option value="User">User</option>
							<option value="Admin">Admin</option>
						</select>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-green">
								<input id="cek" type="checkbox">
								<label for="cek">Tampilkan password</label>
							</div>
						</div>
					</div>
					<div class="social-auth-links text-center mt-2 mb-3">
						<button type="submit" class="btn bg-green btn-block">Daftar</button>
					</div>
					<a href="<?= base_url('home'); ?>" class="text-center text-green">Ingin login? Klik disini!</a>
				</form>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('includes/script'); ?>
<script>
	$(function() {
		var form = $('#formulir');
		var username = $('#username');
		var password = $('#password');
		var nama = $('#nama');
		var akses = $('#akses');
		username;
		form.on('submit', function(e) {
			e.preventDefault();
			if (!username.val() || !password.val() || !nama.val() || !akses.val()) {
				return false;
			} else {
				$.ajax({
					url: '<?= base_url('register'); ?>',
					type: 'POST',
					dataType: 'JSON',
					data: form.serialize(),
					success: function(data) {
						if (data.hasil == 'success') {
							$('.register-box').addClass('d-none');
							Swal.fire({
								icon: 'success',
								title: 'Perhatian!',
								html: 'User <b>' + data.nama + '</b> berhasil ditambahkan. Apakah anda ingin dialihkan ke halaman <b>Login</b>?',
								allowOutsideClick: false,
								showCancelButton: true,
								confirmButtonColor: '#3d9970',
								cancelButtonColor: '#dc3545',
								confirmButtonText: '<i class="fas fa-check fa-fw"></i>',
								cancelButtonText: '<i class="fas fa-x fa-fw"></i>'
							}).then((result) => {
								if (result.isConfirmed) {
									window.location.href = '<?= base_url('home'); ?>';
								} else {
									$('.register-box').removeClass('d-none');
									form.trigger('reset');
								}
							});
						} else if (data.hasil == 'duplicate') {
							Toast.fire({
								icon: 'warning',
								html: 'User <b>' + data.username + '</b> sudah digunakan'
							});
						} else {
							Toast.fire({
								icon: 'error',
								html: 'Pendaftaran gagal dilakukan'
							});
						}
					},
					error: function(data) {
						Toast.fire({
							icon: 'error',
							html: 'Terjadi kesalahan pada server'
						});
					}
				});
			}
		}).validate({
			rules: {
				username: {
					required: true
				},
				password: {
					required: true
				},
				nama: {
					required: true
				},
				akses: {
					required: true
				}
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.input-group').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});
	});
</script>

</html>
