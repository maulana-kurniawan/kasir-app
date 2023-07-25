<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['404_override'] = 'NotFound';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'Login';
$route['login'] = 'Login/login';
$route['logout'] = 'Main/logout';
$route['confirmation'] = 'Lockscreen';
$route['confirm'] = 'Lockscreen/accept';
$route['registration'] = 'Register';
$route['register'] = 'Register/simpan';
$route['dashboard'] = 'Main';
$route['profil'] = 'Main/profil';
$route['profil/ubah/foto'] = 'Main/ubah_foto';
$route['profil/ubah/password'] = 'Main/ubah_password';
$route['master/supplier'] = 'Main/supplier';
$route['master/supplier/tambah'] = 'Main/tambah_supplier';
$route['master/supplier/ubah'] = 'Main/ubah_supplier';
$route['master/supplier/hapus'] = 'Main/hapus_supplier';
$route['master/owner'] = 'Main/owner';
$route['master/owner/tambah'] = 'Main/tambah_owner';
$route['master/owner/ubah'] = 'Main/ubah_owner';
$route['master/owner/hapus'] = 'Main/hapus_owner';
$route['master/kategori'] = 'Main/kategori';
$route['master/kategori/tambah'] = 'Main/tambah_kategori';
$route['master/kategori/ubah'] = 'Main/ubah_kategori';
$route['master/kategori/hapus'] = 'Main/hapus_kategori';
$route['master/produk'] = 'Main/produk';
$route['master/produk/tambah'] = 'Main/tambah_produk';
$route['master/produk/ubah'] = 'Main/ubah_produk';
$route['master/produk/hapus'] = 'Main/hapus_produk';
$route['dapatkan-produk'] = 'Main/get_produk';
$route['master/customer'] = 'Main/customer';
$route['master/customer/tambah'] = 'Main/tambah_customer';
$route['master/customer/ubah'] = 'Main/ubah_customer';
$route['master/customer/hapus'] = 'Main/hapus_customer';
$route['transaksi/penjualan'] = 'Main/penjualan';
$route['transaksi/penjualan/simpan'] = 'Main/simpan_keranjang_penjualan';
$route['transaksi/penjualan/keranjang/tambah'] = 'Main/tambahkan_kuantitas_keranjang_penjualan';
$route['transaksi/penjualan/keranjang/kurang'] = 'Main/kurangi_kuantitas_keranjang_penjualan';
$route['transaksi/penjualan/keranjang/hapus'] = 'Main/hapus_keranjang_penjualan';
$route['transaksi/pembelian/simpan'] = 'Main/simpan_keranjang_pembelian';
$route['transaksi/pembelian/keranjang/tambah'] = 'Main/tambahkan_kuantitas_keranjang_pembelian';
$route['transaksi/pembelian/keranjang/kurang'] = 'Main/kurangi_kuantitas_keranjang_pembelian';
$route['transaksi/pembelian/keranjang/hapus'] = 'Main/hapus_keranjang_pembelian';
$route['transaksi/penjualan/tambah'] = 'Main/simpan_transaksi_penjualan';
$route['transaksi/penjualan/cetak'] = 'Main/cetak_faktur_penjualan';
$route['transaksi/penjualan/hapus'] = 'Main/hapus_penjualan';
$route['transaksi/pembelian'] = 'Main/pembelian';
$route['transaksi/pembelian/tambah'] = 'Main/simpan_transaksi_pembelian';
$route['transaksi/pembelian/cetak'] = 'Main/cetak_faktur_pembelian';
$route['transaksi/pembelian/hapus'] = 'Main/hapus_pembelian';
$route['laporan/re'] = 'Main/laporan_re';
$route['laporan/re/cetak'] = 'Main/cetak_laporan_re';
$route['laporan/owner'] = 'Main/laporan_owner';
$route['laporan/owner/cetak'] = 'Main/cetak_laporan_owner';
$route['laporan/supplier'] = 'Main/laporan_supplier';
$route['laporan/supplier/cetak'] = 'Main/cetak_laporan_supplier';
$route['laporan/seluruh-supplier'] = 'Main/laporan_seluruh_supplier';
$route['laporan/seluruh-supplier/cetak'] = 'Main/cetak_laporan_seluruh_supplier';
$route['laporan/piutang'] = 'Main/laporan_piutang';
$route['laporan/piutang/cetak'] = 'Main/cetak_laporan_piutang';
$route['laporan/saldo-periode'] = 'Main/laporan_saldo_periode';
$route['laporan/saldo-periode/cetak'] = 'Main/cetak_laporan_saldo_periode';
