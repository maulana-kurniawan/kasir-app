<nav class="main-header navbar navbar-expand-md navbar-dark navbar-green border-bottom-0">
	<div class="container">
		<span class="navbar-brand">
			<img src="<?= base_url('assets/img/icon.png'); ?>" alt="Logo Politeknik LP3I" class="brand-image img-circle elevation-3">
			<span class="brand-text font-weight-light">Kasir App</span>
		</span>
		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="<?= base_url('dashboard'); ?>" class="nav-link">Dashboard</a>
				</li>
				<?php if ($this->session->userdata('akses') == 'superadmin' || $this->session->userdata('akses') == 'admin') { ?>
					<li class="nav-item dropdown">
						<a id="Master" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master</a>
						<ul aria-labelledby="Master" class="dropdown-menu dropdown-menu-right border-0 shadow">
							<a href="<?= base_url('master/supplier'); ?>" class="dropdown-item">Supplier</a>
							<a href="<?= base_url('master/owner'); ?>" class="dropdown-item">Owner</a>
							<a href="<?= base_url('master/kategori'); ?>" class="dropdown-item">Kategori</a>
							<a href="<?= base_url('master/produk'); ?>" class="dropdown-item">Produk</a>
							<a href="<?= base_url('master/customer'); ?>" class="dropdown-item">Customer</a>
						</ul>
					</li>
				<?php } ?>
				<li class="nav-item dropdown">
					<a id="Transaksi" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Transaksi</a>
					<ul aria-labelledby="Transaksi" class="dropdown-menu dropdown-menu-right border-0 shadow">
						<a href="<?= base_url('transaksi/penjualan'); ?>" class="dropdown-item">Penjualan</a>
						<a href="<?= base_url('transaksi/pembelian'); ?>" class="dropdown-item">Pembelian</a>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a id="Laporan" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laporan</a>
					<ul aria-labelledby="Laporan" class="dropdown-menu dropdown-menu-right border-0 shadow">
						<a href="<?= base_url('laporan/re'); ?>" class="dropdown-item">RE</a>
						<a href="<?= base_url('laporan/owner'); ?>" class="dropdown-item">Owner</a>
						<a href="<?= base_url('laporan/supplier'); ?>" class="dropdown-item">Supplier</a>
						<a href="<?= base_url('laporan/seluruh-supplier'); ?>" class="dropdown-item">Seluruh Supplier</a>
						<a href="<?= base_url('laporan/piutang'); ?>" class="dropdown-item">Piutang</a>
						<a href="<?= base_url('laporan/saldo-periode'); ?>" class="dropdown-item">Saldo Per Periode</a>
					</ul>
				</li>
			</ul>
		</div>
		<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
			<li class="nav-item dropdown user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<img src="<?= base_url('assets/img/' . $this->session->userdata('foto')); ?>" class="user-image img-circle elevation-3" alt="<?= $this->session->userdata('nama'); ?>">
					<span class="d-none d-md-inline"><?= $this->session->userdata('nama'); ?></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
					<li class="user-header bg-green">
						<img src="<?= base_url('assets/img/' . $this->session->userdata('foto')); ?>" class="img-circle elevation-3" alt="<?= $this->session->userdata('nama'); ?>">
						<p>
							<?= $this->session->userdata('nama'); ?>
							<small>@<?= $this->session->userdata('username'); ?></small>
						</p>
					</li>
					<li class="user-footer">
						<a href="<?= base_url('profil'); ?>" class="btn btn-block bg-green">Profil</a>
						<button id="logout" type="button" class="btn btn-block bg-red">Keluar</button>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>