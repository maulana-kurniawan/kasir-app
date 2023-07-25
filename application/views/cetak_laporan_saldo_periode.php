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
			<h3 class="text-bold">Laporan Saldo Per Periode</h3>
			<?= date('d-m-Y', strtotime($dari)); ?> s/d <?= date('d-m-Y', strtotime($sampai)); ?><br>
		</div>
		<div class="m-3">
			<table class="table table-bordered text-sm">
				<thead>
					<tr>
						<th class="text-center">No.</th>
						<th class="text-center">Nama Barang</th>
						<th class="text-center">Saldo Awal</th>
						<th class="text-center">Saldo Akhir</th>
						<th class="text-center">Golongan</th>
						<th class="text-center">Kategori</th>
						<th class="text-center">Harga Beli</th>
						<th class="text-center">Harga Jual</th>
						<th class="text-center">Total Nominal Persediaan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$total_piutang = 0;
					$total_nominal_persediaan = 0;
					$total_saldo_awal = 0;
					$total_saldo_akhir = 0;
					$total_harga_beli = 0;
					$total_harga_jual = 0;
					$total_akhir_nominal_persediaan = 0;
					foreach ($penjualan as $d) {
						$kuantitas_penjualan = $d->kuantitas;
						$kuantitas_pembelian = $d->kuantitas;
						$stok_produk = $d->kuantitas;
						$nama_kategori = $d->nama_kategori;
						$saldo_awal = $stok_produk + $kuantitas_penjualan - $kuantitas_pembelian;
						$saldo_akhir = $stok_produk;
						$total_nominal_persediaan = $d->harga_beli * $stok_produk;
						$total_saldo_awal += $d->kuantitas;
						$total_saldo_akhir += $saldo_akhir;
						$total_harga_beli += $d->harga_beli;
						$total_harga_jual += $d->harga_jual;
						$total_akhir_nominal_persediaan += $total_nominal_persediaan;
					?>
						<tr>
							<td class="text-center"><?= $no++; ?>.</td>
							<td><?= $d->nama_produk ?></td>
							<td class="text-center"><?= $saldo_awal ?></td>
							<td class="text-center"><?= $saldo_akhir ?></td>
							<td class="text-center"><?php if ($d->id_owner == 1) {
														echo 'BD';
													} else {
														echo 'Konsinyasi';
													} ?></td>
							<td class="text-center"><?= $nama_kategori ?></td>
							<td>
								Rp
								<span class="float-right">
									<?= number_format($d->harga_beli, 0, ".", "."); ?>
								</span>
							</td>
							<td>
								Rp
								<span class="float-right">
									<?= number_format($d->harga_jual, 0, ".", "."); ?>
								</span>
							</td>
							<td>
								Rp
								<span class="float-right">
									<?= number_format($total_nominal_persediaan, 0, ".", "."); ?>
								</span>
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr class="text-bold">
						<td class="text-center" colspan="2">TOTAL</td>
						<td class="text-center"><?= $total_saldo_awal ?></td>
						<td class="text-center"><?= $total_saldo_akhir ?></td>
						<td colspan="2" class="text-right"></td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($total_harga_beli, 0, ".", "."); ?>
						</td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($total_harga_jual, 0, ".", "."); ?>
						</td>
						<td class="text-right">
							<span class="float-left">Rp</span>
							<?= number_format($total_akhir_nominal_persediaan, 0, ".", "."); ?>
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
