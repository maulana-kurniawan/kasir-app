<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
	<style>
		body {
			background-color: #f1f1f1;
		}

		.vertical-center {
			min-height: 100vh;
		}
	</style>
</head>

<body>
	<div class="d-flex align-items-center vertical-center">
		<div class="container">
			<div class="text-center ">
				<h1>😮</h1>
				<h2>Halaman Tidak Ditemukan</h2>
				<p>Maaf, halaman yang anda cari tidak ada.</p>
				<a href="<?= $this->session->userdata('sebelumnya') ?>" class="text-success">Kembali ke Beranda</a>
			</div>
		</div>
	</div>
</body>

<?php $this->load->view('includes/script'); ?>

</html>
