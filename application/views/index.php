<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
</head>

<body class="layout-top-nav">
	<div class="wrapper">
		<?php
		$this->load->view("includes/preloader");
		$this->load->view("includes/navbar");
		?>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Dashboard</h1>
						</div>
					</div>
				</div>
			</div>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-green">
								<div class="card-header">
									<h3 class="card-title">Grafik Data Keseluruhan</h3>
								</div>
								<div class="card-body">
									<canvas id="grafikData" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card card-green">
								<div class="card-header">
									<h3 class="card-title">Grafik Transaksi</h3>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="grafikBar" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>Supplier</h3>
									<p><?= count($supplier); ?> Record</p>
								</div>
								<div class="icon">
									<i class="fas fa-industry fa-fw"></i>
								</div>
								<a href="<?= base_url('master/supplier'); ?>" class="small-box-footer">Buka Halaman <i class="fas fa-arrow-circle-right fa-fw"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>Owner</h3>
									<p><?= count($owner); ?> Record</p>
								</div>
								<div class="icon">
									<i class="fas fa-shield-alt fa-fw"></i>
								</div>
								<a href="<?= base_url('master/owner'); ?>" class="small-box-footer">Buka Halaman <i class="fas fa-arrow-circle-right fa-fw"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>Kategori</h3>
									<p><?= count($kategori); ?> Record</p>
								</div>
								<div class="icon">
									<i class="fas fa-list-ul fa-fw"></i>
								</div>
								<a href="<?= base_url('master/kategori'); ?>" class="small-box-footer">Buka Halaman <i class="fas fa-arrow-circle-right fa-fw"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>Produk</h3>
									<p><?= count($produk); ?> Record</p>
								</div>
								<div class="icon">
									<i class="fas fa-boxes fa-fw"></i>
								</div>
								<a href="<?= base_url('master/produk'); ?>" class="small-box-footer">Buka Halaman <i class="fas fa-arrow-circle-right fa-fw"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>Customer</h3>
									<p><?= count($customer); ?> Record</p>
								</div>
								<div class="icon">
									<i class="fas fa-user-tie fa-fw"></i>
								</div>
								<a href="<?= base_url('master/customer'); ?>" class="small-box-footer">Buka Halaman <i class="fas fa-arrow-circle-right fa-fw"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>Penjualan</h3>
									<p><?= count($penjualan); ?> Record</p>
								</div>
								<div class="icon">
									<i class="fas fa-shopping-bag fa-fw"></i>
								</div>
								<a href="<?= base_url('transaksi/penjualan'); ?>" class="small-box-footer">Buka Halaman <i class="fas fa-arrow-circle-right fa-fw"></i></a>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<div class="small-box bg-green">
								<div class="inner">
									<h3>Pembelian</h3>
									<p><?= count($pembelian); ?> Record</p>
								</div>
								<div class="icon">
									<i class="fas fa-shopping-cart fa-fw"></i>
								</div>
								<a href="<?= base_url('transaksi/pembelian'); ?>" class="small-box-footer">Buka Halaman <i class="fas fa-arrow-circle-right fa-fw"></i></a>
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
<script>
	$(function() {
		var grafikDataCanvas = $('#grafikData').get(0).getContext('2d')
		var isiGrafikData = {
			labels: [
				'Supplier',
				'Owner',
				'Kategori',
				'Produk',
				'Customer',
				'Penjualan',
				'Pembelian',
			],
			datasets: [{
				data: [<?= count($supplier) ?>, <?= count($owner) ?>, <?= count($kategori) ?>, <?= count($produk) ?>, <?= count($customer) ?>, <?= count($penjualan) ?>, <?= count($pembelian) ?>],
				backgroundColor: ['#007bff', '#605ca8', '#e83e8c', '#ff851b', '#01ff70', '#39cccc', '#ffc107'],
			}]
		}
		var pieOptions = {
			maintainAspectRatio: false,
			responsive: true,
		}
		new Chart(grafikDataCanvas, {
			type: 'pie',
			data: isiGrafikData,
			options: pieOptions
		});
		var grafikBarCanvas = $('#grafikBar').get(0).getContext('2d')
		var grafikBarData = {
			labels: ['Penjualan', 'Pembelian', 'Laba'],
			datasets: [{
				label: 'Total',
				backgroundColor: '#28a745',
				borderColor: '#28a745',
				pointRadius: false,
				pointColor: '#28a745',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [<?= $total_harga_jual ?>, <?= $total_harga_beli ?>, <?= $total_harga_jual - $total_harga_beli ?>]
			}]
		}
		var grafikBarOptions = {
			responsive: true,
			maintainAspectRatio: false,
			datasetFill: false,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						precision: 0,
					}
				}]
			}
		}
		new Chart(grafikBarCanvas, {
			type: 'bar',
			data: grafikBarData,
			options: grafikBarOptions
		})
	});
</script>

</html>
