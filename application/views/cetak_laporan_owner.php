<!DOCTYPE html>
<html lang="id-ID">

<head>
	<link rel="stylesheet" href="<?= base_url('assets/css/paper.css'); ?>">
	<?php $this->load->view('includes/head'); ?>
</head>

<body class="A4 landscape">
	<div class="sheet">
		<table class="text-center mt-10 mb-2">
			<td>
				<pre><img src="https://plb.ac.id/new/wp-content/uploads/2022/01/logo-Politeknik-LP3I.png" width="110px" height="110px"></pre>
			</td>
			<td class="text-center">
				<h1>RE Politeknik LP3I Kampus Tasikmalaya</h1>
				<h4>Jalan Ir. H. Juanda KM. 2 No. 106, Panglayungan, Kec. Cipedes, Tasikmalaya, Jawa Barat 46151 Telepon: (0265) 311766</h4>
			</td>
		</table>
		<hr noshade size=4 width="98%">
		<div class="text-center">
			<h3 class="text-bold">Laporan Penjualan Owner</h3>
			<h5><?= $nama_owner ?></h5>
			<?= date('d-m-Y', strtotime($dari)); ?> s/d <?= date('d-m-Y', strtotime($sampai)); ?><br>
		</div>
		<div class="m-3">
			<table class="table table-bordered text-sm">
				<thead>
					<tr>
						<th class="text-center">No.</th>
						<th class="text-center">Nama Produk</th>
						<th class="text-center">Penjualan</th>
						<th class="text-center">Kuantitas</th>
						<th class="text-center">Harga Jual</th>
						<th class="text-center">Harga Beli</th>
						<th class="text-center">Total Harga Beli</th>
						<th class="text-center">(%) margin</th>
						<th class="text-center">Margin</th>
						<th class="text-center">Total Margin</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$total_penjualan = 0;
					$total_qty = 0;
					$harga_jual = 0;
					$harga_beli = 0;
					$total_harga_beli = 0;
					$persen_margin = 0;
					$margin = 0;
					$total_margin = 0;
					foreach ($penjualan as $d) {
						$total_penjualan += $d->harga_jual * $d->kuantitas;
						$total_qty += $d->kuantitas;
						$harga_jual += $d->harga_jual;
						$harga_beli += $d->harga_beli;
						$total_harga_beli += $d->harga_beli * $d->kuantitas;
						$persen_margin += $d->harga_beli / ($d->harga_jual - $d->harga_beli);
						$margin += $d->harga_jual - $d->harga_beli;
						$total_margin += ($d->harga_jual - $d->harga_beli) * $d->kuantitas; ?>
						<tr>
							<td class="text-center"><?= $no++; ?>.</td>
							<td><?= $d->nama_produk ?></td>
							<td class="text-right">
								<span class="float-left">Rp</span>
								<?= number_format($d->harga_jual * $d->kuantitas, 0, ".", "."); ?>
							</td>
							<td class="text-center"><?= $d->kuantitas ?></td>
							<td class="text-right">
								<span class="float-left">Rp</span>
								<?= number_format($d->harga_jual, 0, ".", "."); ?>
							</td>
							<td class="text-right">
								<span class="float-left">Rp</span>
								<?= number_format($d->harga_beli, 0, ".", "."); ?>
							</td>
							<td class="text-right">
								<span class="float-left">Rp</span>
								<?= number_format($d->harga_beli * $d->kuantitas, 0, ".", "."); ?>
							</td>
							<td class="text-center">
								<?= number_format($d->harga_beli / ($d->harga_jual - $d->harga_beli), 2, ".", "."); ?> %
							</td>
							<td class="text-right">
								<span class="float-left">Rp</span>
								<?= number_format($d->harga_jual - $d->harga_beli, 0, ".", "."); ?>
							</td>
							<td class="text-right">
								<span class="float-left">Rp</span>
								<?= number_format(($d->harga_jual - $d->harga_beli) * $d->kuantitas, 0, ".", "."); ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr class="text-bold">
						<td class="text-center" colspan="2">TOTAL</td>
						<td class="text-right">
							<span class="float-left">Rp</span><?= number_format($total_penjualan, 0, '.', '.'); ?>
						</td>
						<td class="text-center"><?= $total_qty ?></td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($harga_jual, 0, ".", "."); ?>
						</td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($harga_beli, 0, ".", "."); ?>
						</td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($total_harga_beli, 0, ".", "."); ?>
						</td>
						<td class="text-center"><?= number_format($persen_margin, 2, ".", "."); ?> %</td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($margin, 0, ".", "."); ?>
						</td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($total_margin, 0, ".", "."); ?>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<table class="float-right w-25"><br>
			<tr class="text-center">
				<td>Tasikmalaya, <?= date('d F Y'); ?></td>
			</tr>
			<tr class="text-center">
				<td>Mengetahui</td>
			</tr>
			<tr class="text-center">
				<td><b>Kepala Kampus</b></td>
			</tr>
			<tr>
				<td><br><br><br><br></td>
			</tr>
			<tr class="text-center">
				<td><b>H. Rudi Kurniawan, S.T., M.M</b></td>
			</tr>
			<tr class="text-center">
				<td>NIP. XXXXXXXX XXXXXX X XXX</td>
			</tr>
		</table>
	</div>
</body>
<?php $this->load->view('includes/script'); ?>

</html>
