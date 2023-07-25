<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
	<link href="<?= base_url('assets/css/print.css'); ?>" rel="stylesheet">
</head>

<body>
	<?php
	foreach ($ht_pembelian as $h) {
		$locale = "id_ID";
		$dateType = IntlDateFormatter::MEDIUM;
		$timeType = IntlDateFormatter::NONE;
		$formatter = new IntlDateFormatter($locale, $dateType, $timeType);
		$dateTime = new DateTime($h->waktu);
		$formatter->setPattern('d MMMM YYYY');
		$tanggalku = $formatter->format($dateTime);
	?>
		<div class="container mt-5 mb-3">
			<div class="row d-flex justify-content-center">
				<div class="col-sm-7 col-lg-5">
					<div class="card">
						<div class="d-flex flex-row mx-auto pt-3 pb-2 pl-2 pr-2">
							<img width="50" src="<?= base_url('assets/img/lp3i.jpg'); ?>" class="rounded-circle img-fluid mr-3">
							<div class="d-flex flex-column">
								<span class="font-weight-bold">Ruang Enterpreneur</span>
								<small><?= $h->id ?></small>
							</div>
						</div>
						<hr>
						<div class="table-responsive pl-2 pr-2">
							<table class="table table-borderless">
								<tbody>
									<tr class="add">
										<td class="text-center" colspan="4">Detail Transaksi</td>
									</tr>
									<tr class="content">
										<td class="font-weight-bold">Supplier<br>Tanggal<br>Waktu<br>Kasir</td>
										<td class="font-weight-bold text-center">:<br>:<br>:<br>:</td>
										<td class="font-weight-bold"><?= $h->nama_supplier ?><br><?= $tanggalku ?><br><?= date('H:i', strtotime($h->waktu)) ?><br><?= $h->kasir ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<hr>
						<div class="products p-2">
							<table class="table table-borderless">
								<tbody>
									<tr class="add">
										<td class="text-center">Nama Produk</td>
										<td class="text-center">Harga</td>
										<td class="text-center">Kuantitas</td>
										<td class="text-center">Total</td>
									</tr>
									<?php foreach ($dt_pembelian as $d) { ?>
										<tr class="content">
											<td><?= $d->nama_produk ?></td>
											<td>Rp<span class="float-right"><?= number_format($d->harga_beli, 0, ".", "."); ?></span></td>
											<td class="text-center"><?= $d->kuantitas ?></td>
											<td>Rp<span class="float-right"><?= number_format($d->harga_beli * $d->kuantitas, 0, ".", "."); ?></span></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<hr>
						<div class="products p-2">
							<table class="table table-borderless">
								<tbody>
									<tr class="add">
										<td colspan="4" width="33.33%" class="text-right">Total Transaksi</td>
									</tr>
									<tr class="content">
										<td colspan="4" width="33.33%" class="text-right">Rp <?= number_format($totals, 0, ".", "."); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<hr>
						<div class="address p-2 text-center">
							<table class="table table-borderless">
								<tbody>
									<tr class="add">
										<td>PERHATIAN</td>
									</tr>
									<tr class="content">
										<td>Wajib menyimpan struk ini!<br>Untuk memudahkan pendataan cashflow.</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</body>

</html>