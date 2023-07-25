<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
</head>

<body class="login-page">
	<div class="login-box">
		<div class="card card-outline card-green">
			<div class="overlay d-none">
				<i class="fas fa-2x fa-sync fa-spin"></i>
			</div>
			<div class="card-header text-center">
				<a href="#" class="h1 text-dark"><b>Kasir</b> RE</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Masuk untuk memulai sesi anda</p>
				<form id="formulir" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
					<div class="input-group mb-3">
						<input id="username" name="username" type="text" class="form-control" placeholder="Username">
					</div>
					<div class="input-group mb-3">
						<input id="password" name="password" type="password" class="form-control" placeholder="Password">
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
						<button type="submit" class="btn bg-green btn-block">Masuk</button>
					</div>
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
		form.on('submit', function(e) {
			e.preventDefault();
			if (!username.val() || !password.val()) {
				return false;
			} else {
				$.ajax({
					url: '<?= base_url('login'); ?>',
					type: 'POST',
					dataType: 'JSON',
					data: form.serialize(),
					success: function(data) {
						if (data.logged == true) {
							$('.overlay').removeClass('d-none');
							Toast.fire({
								icon: 'success',
								html: 'Selamat datang <b>' + data.nama + '</b>',
							}).then(function() {
								window.location.href = '<?= base_url('dashboard'); ?>';
							});
						} else if (data.logged == 'blank') {
							Toast.fire({
								icon: 'warning',
								html: 'Tidak ada user dengan nama <b>' + data.username + '</b>',
							});
						} else {
							Toast.fire({
								icon: 'error',
								html: 'Maaf password tersebut tidak valid'
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
