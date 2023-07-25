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
							<h1 class="m-0">Laporan</h1>
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
									<h3 class="card-title">Laporan Piutang</h3>
								</div>
								<form action="<?= base_url('laporan/piutang/cetak'); ?>" target="_blank">
									<div class="card-body">
										<div class="form-group">
											<label>Dari</label>
											<input type="date" id="dari" name="dari" class="form-control" value="<?= $dari; ?>">
										</div>
										<div class="form-group">
											<label>Sampai</label>
											<input type="date" id="sampai" name="sampai" class="form-control" value="<?= $sampai; ?>">
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" class="btn btn-block bg-green"><i class="fas fa-print fa-fw"></i></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('includes/footer'); ?>
	</div>
</body>
<?php $this->load->view('includes/script'); ?>

</html>
