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
			<h3 class="text-bold">Laporan Piutang</h3>
			<?= date('d-m-Y', strtotime($dari)); ?> s/d <?= date('d-m-Y', strtotime($sampai)); ?><br>
		</div>
		<div class="m-3">
			<table class="table table-bordered text-sm">
				<thead>
					<tr>
						<th class="text-center">No.</th>
						<th class="text-center">Nama Customer</th>
						<th class="text-center">Piutang</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$total_piutang = 0;
					foreach ($penjualan as $p) {
						$total_piutang += $p->total_omset - $p->total_bayar; ?>
						<tr>
							<td class="text-center"><?= $no++; ?>.</td>
							<td><?= $p->nama_customer ?></td>
							<td>
								Rp
								<span class="float-right">
									<?= number_format($p->total_omset - $p->total_bayar, 0, ".", "."); ?>
								</span>
							</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr class="text-bold">
						<td class="text-center" colspan="2">TOTAL</td>
						<td class="text-right">
							<span class="float-left">Rp</span><?= number_format($total_piutang, 0, '.', '.'); ?>
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
