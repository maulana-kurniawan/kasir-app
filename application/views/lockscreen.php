<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
</head>

<body class="lockscreen">
	<div class="lockscreen-wrapper">
		<div class="lockscreen-logo">
			<a href="#"><b>Kasir</b> RE</a>
		</div>
		<div class="lockscreen-name">Halaman Registrasi</div>
		<div class="lockscreen-item">
			<div class="lockscreen-image">
				<img src="<?= base_url('assets/img/icon.png'); ?>" alt="Kasir">
			</div>
			<div class="lockscreen-credentials">
				<form id="formulir" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
					<div class="input-group">
						<input id="password" name="password" type="password" class="form-control" placeholder="Masukkan password">
						<div class="input-group-append">
							<button type="submit" class="btn">
								<i class="fas fa-arrow-right text-muted fa-fw"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="help-block text-center">
			Masukkan password untuk masuk ke halaman registrasi.
		</div>
		<div class="text-center">
			<a href="<?= base_url('home'); ?>" class="text-green">Atau kembali ke halaman login.</a>
		</div>
		<div class="lockscreen-footer text-center">
			Copyright &copy; 2022 <b><a href="https://github.com/maulana-kurniawan" class="text-green">Maulana Kurniawan</a></b><br>
			Aplikasi Kasir.
		</div>
	</div>
</body>
<?php $this->load->view('includes/script'); ?>
<script>
	$(function() {
		var form = $('#formulir');
		var password = $('#password');
		password;
		form.on('submit', function(e) {
			e.preventDefault();
			if (!password.val()) {
				return false;
			} else {
				$.ajax({
					url: '<?= base_url('confirm'); ?>',
					type: 'POST',
					dataType: 'JSON',
					data: form.serialize(),
					success: function(data) {
						if (data.confirmed == true) {
							Alert.fire({
								icon: 'success',
								html: 'Anda terkonfirmasi sebagai <b>' + data.nama + '</b>',
							}).then(function() {
								window.location.href = '<?= base_url('registration'); ?>';
							});
						} else {
							Toast.fire({
								icon: 'error',
								html: 'Maaf password tersebut tidak valid!'
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
