<!DOCTYPE html>
<html lang="id-ID">

<head>
	<?php $this->load->view('includes/head'); ?>
	<link href="<?= base_url('assets/css/print.css'); ?>" rel="stylesheet">
</head>

<body>
	<?php
	foreach ($ht_penjualan as $h) {
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
										<td class="font-weight-bold">Customer<br>Tanggal<br>Waktu<br>Kasir</td>
										<td class="font-weight-bold text-center">:<br>:<br>:<br>:</td>
										<td class="font-weight-bold"><?= $h->nama_customer ?><br><?= $tanggalku ?><br><?= date('H:i', strtotime($h->waktu)) ?><br><?= $h->kasir ?></td>
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
									<?php foreach ($dt_penjualan as $d) { ?>
										<tr class="content">
											<td><?= $d->nama_produk ?></td>
											<td>Rp<span class="float-right"><?= number_format($d->harga_jual, 0, ".", "."); ?></span></td>
											<td class="text-center"><?= $d->kuantitas ?></td>
											<td>Rp<span class="float-right"><?= number_format($d->harga_jual * $d->kuantitas, 0, ".", "."); ?></span></td>
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
										<td width="33.33%" class="text-center">Total Transaksi</td>
										<td width="33.33%" class="text-center">Tunai</td>
										<td width="33.33%" class="text-center">Piutang</td>
									</tr>
									<tr class="content">
										<td width="33.33%" class="text-center">Rp <?= number_format($total_omset, 0, ".", "."); ?></td>
										<td width="33.33%" class="text-center">Rp <?= number_format($total_bayar, 0, ".", "."); ?></td>
										<td width="33.33%" class="text-center">Rp <?= number_format($total_piutang, 0, ".", "."); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<hr>
						<div class="address p-2 text-center">
							<table class="table table-borderless">
								<tbody>
									<tr class="add">
										<td>TERIMA KASIH</td>
									</tr>
									<tr class="content">
										<td>Terima kasih telah berbelanja!<br>Semoga puas dan datang kembali ya! ^_^</td>
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