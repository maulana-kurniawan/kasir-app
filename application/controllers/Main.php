<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
		if (!$this->session->userdata('logged')) {
			redirect('home');
		} elseif ($this->session->userdata('confirmed')) {
			redirect('registration');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
	public function index()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*');
		$data['supplier'] = $this->m->Get_All('supplier', $select);
		$data['owner'] = $this->m->Get_All('owner', $select);
		$data['kategori'] = $this->m->Get_All('kategori', $select);
		$data['produk'] = $this->m->Get_All('produk', $select);
		$data['customer'] = $this->m->Get_All('customer', $select);
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['pembelian'] = $this->m->Get_All('ht_pembelian', $select);
		$thj = $this->db->select('harga_jual, sum(harga_jual) as thj');
		$data['thj'] = $this->m->Get_All('dt_penjualan', $thj);
		$thb = $this->db->select('harga_beli, sum(harga_beli) as thb');
		$data['thb'] = $this->m->Get_All('dt_pembelian', $thb);
		$data['total_harga_jual'] = 0;
		$data['total_harga_beli'] = 0;
		foreach ($data['thj'] as $thj) {
			foreach ($data['thb'] as $thb) {
				$data['total_harga_jual'] += $thj->thj;
				$data['total_harga_beli'] += $thb->thb;
			}
		}
		$this->load->view('index', $data);
	}
	public function supplier()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('supplier', $select);
		$this->load->view('supplier', $data);
	}
	public function tambah_supplier()
	{
		$data = array(
			'nama_supplier' => $this->input->post('nama_supplier'),
			'no_hp' => trim(str_replace(['-', ' ', '_'], "", $this->input->post('no_hp'))),
			'alamat' => $this->input->post('alamat')
		);
		$this->m->Save($data, 'supplier');
		redirect('master/supplier');
	}
	public function ubah_supplier()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama_supplier' => $this->input->post('nama_supplier'),
			'no_hp' => trim(str_replace(['-', ' ', '_'], "", $this->input->post('no_hp'))),
			'alamat' => $this->input->post('alamat')
		);
		$this->m->Update($where, $data, 'supplier');
		redirect('master/supplier');
	}
	public function hapus_supplier()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'supplier');
		redirect('master/supplier');
	}
	public function owner()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('owner', $select);
		$this->load->view('owner', $data);
	}
	public function tambah_owner()
	{
		$data = array(
			'nama_owner' => $this->input->post('nama_owner'),
			'no_hp' => trim(str_replace(['-', ' ', '_'], "", $this->input->post('no_hp'))),
			'alamat' => $this->input->post('alamat')
		);
		$this->m->Save($data, 'owner');
		redirect('master/owner');
	}
	public function ubah_owner()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama_owner' => $this->input->post('nama_owner'),
			'no_hp' => trim(str_replace(['-', ' ', '_'], "", $this->input->post('no_hp'))),
			'alamat' => $this->input->post('alamat')
		);
		$this->m->Update($where, $data, 'owner');
		redirect('master/owner');
	}
	public function hapus_owner()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'owner');
		redirect('master/owner');
	}
	public function kategori()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('kategori', $select);
		$this->load->view('kategori', $data);
	}
	public function tambah_kategori()
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori')
		);
		$this->m->Save($data, 'kategori');
		redirect('master/kategori');
	}
	public function ubah_kategori()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori')
		);
		$this->m->Update($where, $data, 'kategori');
		redirect('master/kategori');
	}
	public function hapus_kategori()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'kategori');
		redirect('master/kategori');
	}
	public function produk()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*, produk.id as id');
		$select = $this->db->join('owner', 'owner.id = produk.id_owner');
		$data['read'] = $this->m->Get_All('produk', $select);
		$selects = $this->db->select('*');
		$data['kategori'] = $this->m->Get_All('kategori', $selects);
		$data['owner'] = $this->m->Get_All('owner', $selects);
		$this->load->view('produk', $data);
	}
	public function tambah_produk()
	{
		$data = array(
			'id_kategori' => $this->input->post('id_kategori'),
			'id_owner' => $this->input->post('id_owner'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kuantitas' => $this->input->post('kuantitas'),
			'harga_beli' => trim(str_replace(".", "", $this->input->post('harga_beli'))),
			'harga_jual' => trim(str_replace(".", "", $this->input->post('harga_jual')))
		);
		$this->m->Save($data, 'produk');
		redirect('master/produk');
	}
	public function ubah_produk()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'id_kategori' => $this->input->post('id_kategori'),
			'id_owner' => $this->input->post('id_owner'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kuantitas' => $this->input->post('kuantitas'),
			'harga_beli' => trim(str_replace(".", "", $this->input->post('harga_beli'))),
			'harga_jual' => trim(str_replace(".", "", $this->input->post('harga_jual'))),
			'update_date'  => date('Y-m-d H:i:s')
		);
		$this->m->Update($where, $data, 'produk');
		redirect('master/produk');
	}
	public function hapus_produk()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'produk');
		redirect('master/produk');
	}
	public function customer()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('customer', $select);
		$this->load->view('customer', $data);
	}
	public function tambah_customer()
	{
		$data = array(
			'nama_customer' => $this->input->post('nama_customer'),
			'status' => $this->input->post('status')
		);
		$this->m->Save($data, 'customer');
		redirect('master/customer');
	}
	public function ubah_customer()
	{
		$where = array(
			'id' => $this->input->post('id'),
		);
		$data = array(
			'nama_customer' => $this->input->post('nama_customer'),
			'status' => $this->input->post('status')
		);
		$this->m->Update($where, $data, 'customer');
		redirect('master/customer');
	}
	public function hapus_customer()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$this->m->Delete($where, 'customer');
		redirect('master/customer');
	}
	public function get_produk()
	{
		$id = $this->input->get('id');
		$select = $this->db->select('*');
		$select = $this->db->where('id', $id);
		$data = $this->m->Get_All('produk', $select);
		echo json_encode($data);
	}
	function lihat_keranjang_penjualan()
	{
		$output = '';
		if (empty($this->cart->contents())) {
			$output = '
			<tr>
				<td class="text-center" colspan="5">Keranjang masih kosong!</td>
			</tr>
			';
			echo $output;
		} else {
			foreach ($this->cart->contents() as $items) {
				$output .= '
					<tr>
						<td>' . $items['name'] . '</td>
						<td class="text-center">' . $items['qty'] . '</td>
						<td>Rp<span class="float-right">' . number_format($items['price'], 0, ".", ".") . '</span></td>
						<td>Rp<span class="float-right">' . number_format(($items['qty'] * $items['price']), 0, ".", ".") . '</span></td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-sm bg-success" onclick="return tambahin(`' . $items['rowid'] . '`, `' . $items['qty'] . '`)">
									<i class="fas fa-plus-circle fa-fw"></i>
								</button>
								<button type="button" class="btn btn-sm bg-success" onclick="return kurangin(`' . $items['rowid'] . '`, `' . $items['qty'] . '`)">
									<i class="fas fa-minus-circle fa-fw"></i>
								</button>
								<button type="button" class="btn btn-sm bg-red" onclick="return batalin(`' . $items['rowid'] . '`)">
									<i class="fas fa-trash fa-fw"></i>
								</button>
							</div>
						</td>
					</tr>
					';
			}
			$output .= '
				<tr>
					<td colspan="4" class="text-center text-bold">TOTAL</td>
					<td class="text-bold">Rp<span class="float-right">' . number_format($this->cart->total(), 0, ".", ".") . '</span></td>
				</tr>
		';
			echo $output;
		}
	}
	function simpan_keranjang_penjualan()
	{
		$id = $this->input->get('id');
		$qty = $this->input->get('qty');
		$where = array(
			'id' => $id
		);
		$get_produk = $this->m->Get_Where($where, 'produk');
		foreach ($get_produk as $d) {
			$data = array(
				'id' => $d->id,
				'name' => $d->nama_produk,
				'qty' => $qty,
				'price' => trim(str_replace(".", "", $d->harga_jual)),
				'harga_beli' => trim(str_replace(".", "", $d->harga_beli))
			);
			$this->cart->insert($data);
		}
		$this->lihat_keranjang_penjualan();
	}
	function tambahkan_kuantitas_keranjang_penjualan()
	{
		$row_id = $this->input->get('rowid');
		$qty = $this->input->get('qty');
		$data = array(
			'rowid' => $row_id,
			'qty' => $qty + 1,
		);
		$this->cart->update($data);
		$this->lihat_keranjang_penjualan();
	}
	function kurangi_kuantitas_keranjang_penjualan()
	{
		$row_id = $this->input->get('rowid');
		$qty = $this->input->get('qty');
		$data = array(
			'rowid' => $row_id,
			'qty' => $qty - 1,
		);
		$this->cart->update($data);
		$this->lihat_keranjang_penjualan();
	}
	function hapus_keranjang_penjualan()
	{
		$row_id = $this->input->get('rowid');
		$data = array(
			'rowid' => $row_id,
			'qty' => 0,
		);
		$this->cart->update($data);
		$this->lihat_keranjang_penjualan();
	}
	function lihat_keranjang_pembelian()
	{
		$output = '';
		if (empty($this->cart->contents())) {
			$output = '
			<tr>
				<td class="text-center" colspan="5">Keranjang masih kosong!</td>
			</tr>
			';
			echo $output;
		} else {
			foreach ($this->cart->contents() as $items) {
				$output .= '
					<tr>
						<td>' . $items['name'] . '</td>
						<td class="text-center">' . $items['qty'] . '</td>
						<td>Rp<span class="float-right">' . number_format($items['price'], 0, ".", ".") . '</span></td>
						<td>Rp<span class="float-right">' . number_format(($items['qty'] * $items['price']), 0, ".", ".") . '</span></td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-sm bg-success" onclick="return tambahin(`' . $items['rowid'] . '`, `' . $items['qty'] . '`)">
									<i class="fas fa-plus-circle fa-fw"></i>
								</button>
								<button type="button" class="btn btn-sm bg-success" onclick="return kurangin(`' . $items['rowid'] . '`, `' . $items['qty'] . '`)">
									<i class="fas fa-minus-circle fa-fw"></i>
								</button>
								<button type="button" class="btn btn-sm bg-red" onclick="return batalin(`' . $items['rowid'] . '`)">
									<i class="fas fa-trash fa-fw"></i>
								</button>
							</div>
						</td>
					</tr>
					';
			}
			$output .= '
				<tr>
					<td colspan="4" class="text-center text-bold">TOTAL</td>
					<td class="text-bold">Rp<span class="float-right">' . number_format($this->cart->total(), 0, ".", ".") . '</span></td>
				</tr>
		';
			echo $output;
		}
	}
	function simpan_keranjang_pembelian()
	{
		$id = $this->input->get('id');
		$qty = $this->input->get('qty');
		$where = array(
			'id' => $id
		);
		$get_produk = $this->m->Get_Where($where, 'produk');
		foreach ($get_produk as $d) {
			$data = array(
				'id' => $d->id,
				'name' => $d->nama_produk,
				'qty' => $qty,
				'price' => trim(str_replace(".", "", $d->harga_beli)),
				'harga_jual' => trim(str_replace(".", "", $d->harga_jual))
			);
			$this->cart->insert($data);
		}
		$this->lihat_keranjang_pembelian();
	}
	function tambahkan_kuantitas_keranjang_pembelian()
	{
		$row_id = $this->input->get('rowid');
		$qty = $this->input->get('qty');
		$data = array(
			'rowid' => $row_id,
			'qty' => $qty + 1,
		);
		$this->cart->update($data);
		$this->lihat_keranjang_penjualan();
	}
	function kurangi_kuantitas_keranjang_pembelian()
	{
		$row_id = $this->input->get('rowid');
		$qty = $this->input->get('qty');
		$data = array(
			'rowid' => $row_id,
			'qty' => $qty - 1,
		);
		$this->cart->update($data);
		$this->lihat_keranjang_penjualan();
	}
	function hapus_keranjang_pembelian()
	{
		$row_id = $this->input->get('rowid');
		$data = array(
			'rowid' => $row_id,
			'qty' => 0,
		);
		$this->cart->update($data);
		$this->lihat_keranjang_pembelian();
	}
	public function penjualan()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d');
		$select = $this->db->select('*, sum(harga_jual*kuantitas) as total_omset');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		if (isset($_POST['cari'])) {
			$data['dari'] = $_POST['dari'];
			$data['sampai'] = $_POST['sampai'];
			$date = date('Y-m-d', strtotime($data['sampai'] . "+1 days"));
			$select = $this->db->where('waktu >= "' . $data['dari'] . '"');
			$select = $this->db->where('waktu <= "' . $date . '"');
		} else {
			$select = $this->db->where('waktu LIKE "' . date('Y-m-d') . '%"');
		}
		$select = $this->db->group_by('ht_penjualan.id');
		$select = $this->db->order_by('waktu', 'DESC');
		$data['read'] = $this->m->Get_All('ht_penjualan', $select);
		$select = $this->db->select('*');
		$data['produk'] = $this->m->Get_All('produk', $select);
		$data['total_bayar'] = 0;
		$data['total_omset'] = 0;
		foreach ($data['read'] as $r) {
			$data['total_bayar'] += $r->total_bayar;
			$data['total_omset'] += $r->total_omset;
		}
		$data['total_piutang'] = $data['total_omset'] - $data['total_bayar'];
		$data['customer'] = $this->m->Get_All('customer', $select);
		$this->load->view('penjualan', $data);
	}
	public function simpan_transaksi_penjualan()
	{
		if (count($this->cart->contents()) < 1) {
			$this->session->set_flashdata('emptycart', true);
			redirect('transaksi/penjualan');
		} else {
			$id = date('YmdHis');
			$id_customer = $this->input->post('id_customer');
			$where = array(
				'id' => preg_replace("/[^0-9]+/", "", $id_customer),
			);
			$dapat_customer = $this->m->Get_Where($where, 'customer');
			if (preg_replace("/\d/", "", $id_customer) != 'Karyawan') {
				$total_bayar = $this->cart->total();
			} else {
				$total_bayar = trim(str_replace(".", "", $this->input->post('total_bayar')));
			}
			foreach ($dapat_customer as $dc) {
				$data = array(
					'id' => $id,
					'id_customer' => $id_customer,
					'nama_customer' => $dc->nama_customer,
					'waktu' => date('Y-m-d H:i:s'),
					'total_bayar' => $total_bayar,
					'status' => $dc->status,
					'kasir' => $this->session->userdata('nama'),
				);
				$this->m->Save($data, 'ht_penjualan');
			}
			foreach ($this->cart->contents() as $items) {
				$data = array(
					'id' => $id,
					'id_produk' => $items['id'],
					'nama_produk' => $items['name'],
					'harga_beli' => $items['harga_beli'],
					'harga_jual' => $items['price'],
					'kuantitas' => $items['qty'],
				);
				$select = $this->db->select('*');
				$select = $this->db->join('owner', 'produk.id_owner = owner.id');
				$select = $this->db->where('produk.id', $items['id']);
				$get_produk = $this->m->Get_All('produk', $select);
				foreach ($get_produk as $p) {
					$data['id_owner'] = $p->id_owner;
					$data['nama_owner'] = $p->nama_owner;
					$this->m->Save($data, 'dt_penjualan');
					$where = array(
						'id' => $items['id']
					);
					$data = array(
						'kuantitas' => $p->kuantitas - $items['qty']
					);
					$this->m->Update($where, $data, 'produk');
				}
			}
			$this->cart->destroy();
			redirect('transaksi/penjualan');
		}
	}
	public function cetak_faktur_penjualan()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$id = $this->input->get('id');
		$select = $this->db->select('*, sum(harga_jual*kuantitas) as total_omset');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('ht_penjualan.id', $id);
		$data['ht_penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$where['id'] = $id;
		$data['dt_penjualan'] = $this->m->Get_Where($where, 'dt_penjualan');
		$data['total_omset'] = 0;
		$data['total_bayar'] = 0;
		$data['total_piutang'] = 0;
		foreach ($data['ht_penjualan'] as $h) {
			$data['total_omset'] += $h->total_omset;
			$data['total_bayar'] += $h->total_bayar;
		}
		$data['total_piutang'] = $data['total_omset'] - $data['total_bayar'];
		$this->load->view('cetak_faktur_penjualan', $data);
	}
	public function hapus_penjualan()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$dt_penjualan = $this->m->Get_Where($where, 'dt_penjualan');
		foreach ($dt_penjualan as $dp) {
			$wheres = array(
				'id' => $dp->id_produk
			);
			$get_produk = $this->m->Get_Where($wheres, 'produk');
			foreach ($get_produk as $p) {
				$data = array(
					'kuantitas' => $p->kuantitas + $dp->kuantitas
				);
				$this->m->Update($wheres, $data, 'produk');
			}
		}
		$this->m->Delete($where, 'ht_penjualan');
		$this->m->Delete($where, 'dt_penjualan');
		redirect('transaksi/penjualan');
	}
	public function pembelian()
	{
		$this->cart->destroy();
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d');
		$select = $this->db->select('*, sum(harga_beli*kuantitas) as totals');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		if (isset($_POST['cari'])) {
			$data['dari'] = $_POST['dari'];
			$data['sampai'] = $_POST['sampai'];
			$date = date('Y-m-d', strtotime($data['sampai'] . "+1 days"));
			$select = $this->db->where('waktu >= "' . $data['dari'] . '"');
			$select = $this->db->where('waktu <= "' . $date . '"');
		} else {
			$select = $this->db->where('waktu LIKE "' . date('Y-m-d') . '%"');
		}
		$select = $this->db->group_by('ht_pembelian.id');
		$select = $this->db->order_by('waktu', 'DESC');
		$data['read'] = $this->m->Get_All('ht_pembelian', $select);
		$select = $this->db->select('*');
		$data['produk'] = $this->m->Get_All('produk', $select);
		$data['totals'] = 0;
		foreach ($data['read'] as $r) {
			$data['totals'] += $r->totals;
		}
		$data['supplier'] = $this->m->Get_All('supplier', $select);
		$this->load->view('pembelian', $data);
	}
	public function simpan_transaksi_pembelian()
	{
		if (count($this->cart->contents()) < 1) {
			$this->session->set_flashdata('emptycart', true);
			redirect('transaksi/pembelian');
		} else {
			$id = date('YmdHis');
			$id_supplier = $this->input->post('id_supplier');
			$where = array(
				'id' => $id_supplier,
			);
			$dapat_supplier = $this->m->Get_Where($where, 'supplier');
			foreach ($dapat_supplier as $ds) {
				$data = array(
					'id' => $id,
					'id_supplier' => $id_supplier,
					'nama_supplier' => $ds->nama_supplier,
					'waktu' => date('Y-m-d H:i:s'),
					'total_bayar' => $this->cart->total(),
					'kasir' => $this->session->userdata('nama'),
				);
				$this->m->Save($data, 'ht_pembelian');
			}
			foreach ($this->cart->contents() as $items) {
				$data = array(
					'id' => $id,
					'id_produk' => $items['id'],
					'nama_produk' => $items['name'],
					'harga_beli' => $items['price'],
					'harga_jual' => $items['harga_jual'],
					'kuantitas' => $items['qty'],
				);
				$select = $this->db->select('*');
				$select = $this->db->join('owner', 'produk.id_owner = owner.id');
				$select = $this->db->where('produk.id', $items['id']);
				$get_produk = $this->m->Get_All('produk', $select);
				foreach ($get_produk as $p) {
					$data['id_owner'] = $p->id_owner;
					$data['nama_owner'] = $p->nama_owner;
					$this->m->Save($data, 'dt_pembelian');
					$where = array(
						'id' => $items['id']
					);
					$data = array(
						'kuantitas' => $p->kuantitas + $items['qty']
					);
					$this->m->Update($where, $data, 'produk');
				}
			}
			$this->cart->destroy();
			redirect('transaksi/pembelian');
		}
	}
	public function cetak_faktur_pembelian()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$id = $this->input->get('id');
		$select = $this->db->select('*, sum(harga_beli*kuantitas) as totals');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('ht_pembelian.id', $id);
		$data['ht_pembelian'] = $this->m->Get_All('ht_pembelian', $select);
		$where['id'] = $id;
		$data['dt_pembelian'] = $this->m->Get_Where($where, 'dt_pembelian');
		$data['totals'] = 0;
		foreach ($data['ht_pembelian'] as $h) {
			$data['totals'] += $h->totals;
		}
		$this->load->view('cetak_faktur_pembelian', $data);
	}
	public function hapus_pembelian()
	{
		$where = array(
			'id' => $this->input->post('id')
		);
		$dt_pembelian = $this->m->Get_Where($where, 'dt_pembelian');
		foreach ($dt_pembelian as $dp) {
			$wheres = array(
				'id' => $dp->id_produk
			);
			$get_produk = $this->m->Get_Where($wheres, 'produk');
			foreach ($get_produk as $p) {
				$data = array(
					'kuantitas' => $p->kuantitas - $dp->kuantitas
				);
				$this->m->Update($wheres, $data, 'produk');
			}
		}
		$this->m->Delete($where, 'ht_pembelian');
		$this->m->Delete($where, 'dt_pembelian');
		redirect('transaksi/pembelian');
	}
	public function laporan_re()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . '+ 1 months'));
		$this->load->view('laporan_re', $data);
	}
	public function cetak_laporan_re()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$sampai = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('waktu >= "' . $this->input->get('dari') . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$select = $this->db->where('id_owner', '1');
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['dari'] = $this->input->get('dari');
		$data['sampai'] = $this->input->get('sampai');
		$this->load->view('cetak_laporan_re', $data);
	}
	public function laporan_owner()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*');
		$select = $this->db->where('id >' . '1');
		$data['owner'] = $this->m->Get_All('owner', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . '+ 1 months'));
		$this->load->view('laporan_owner', $data);
	}
	public function cetak_laporan_owner()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$sampai = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('waktu >= "' . $this->input->get('dari') . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$select = $this->db->where('id_owner', $this->input->get('id_owner'));
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['nama_owner'] = "";
		foreach ($data['penjualan'] as $d) {
			$data['nama_owner'] = $d->nama_owner;
		}
		$data['dari'] = $this->input->get('dari');
		$data['sampai'] = $this->input->get('sampai');
		$this->load->view('cetak_laporan_owner', $data);
	}
	public function laporan_supplier()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*, ht_pembelian.id as id');
		$select = $this->db->join('supplier', 'supplier.id = ht_pembelian.id_supplier');
		$data['read'] = $this->m->Get_All('ht_pembelian', $select);
		$select = $this->db->select('*');
		$data['supplier'] = $this->m->Get_All('supplier', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('laporan_supplier', $data);
	}
	public function cetak_laporan_supplier()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$sampai = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('waktu >= "' . $this->input->get('dari') . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$select = $this->db->where('id_supplier', $this->input->get('id_supplier'));
		$data['pembelian'] = $this->m->Get_All('ht_pembelian', $select);
		$data['nama_supplier'] = "";
		foreach ($data['pembelian'] as $d) {
			$data['nama_supplier'] = $d->nama_supplier;
		}
		$data['dari'] = $this->input->get('dari');
		$data['sampai'] = $this->input->get('sampai');
		$this->load->view('cetak_laporan_supplier', $data);
	}
	public function laporan_seluruh_supplier()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*, ht_pembelian.id as id');
		$select = $this->db->join('supplier', 'supplier.id = ht_pembelian.id_supplier');
		$data['read'] = $this->m->Get_All('ht_pembelian', $select);
		$select = $this->db->select('*');
		$data['supplier'] = $this->m->Get_All('supplier', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('laporan_seluruh_supplier', $data);
	}
	public function cetak_laporan_seluruh_supplier()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$sampai = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('waktu >= "' . $this->input->get('dari') . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$data['pembelian'] = $this->m->Get_All('ht_pembelian', $select);
		$data['dari'] = $this->input->get('dari');
		$data['sampai'] = $this->input->get('sampai');
		$this->load->view('cetak_laporan_seluruh_supplier', $data);
	}
	public function laporan_piutang()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$select = $this->db->select('*, ht_pembelian.id as id');
		$select = $this->db->join('supplier', 'supplier.id = ht_pembelian.id_supplier');
		$data['read'] = $this->m->Get_All('ht_pembelian', $select);
		$select = $this->db->select('*');
		$data['supplier'] = $this->m->Get_All('supplier', $select);
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . ' + 1 months'));
		$this->load->view('laporan_piutang', $data);
	}
	public function cetak_laporan_piutang()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$sampai = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));
		$select = $this->db->select('*, sum(distinct ht_penjualan.total_bayar) as total_bayar, sum(dt_penjualan.harga_jual * dt_penjualan.kuantitas) as total_omset');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('ht_penjualan.status = ', 'Karyawan');
		$select = $this->db->where('ht_penjualan.waktu >= "' . $this->input->get('dari') . '"');
		$select = $this->db->where('ht_penjualan.waktu <= "' . $sampai . '"');
		$select = $this->db->group_by('ht_penjualan.id_customer');
		$select = $this->db->order_by('ht_penjualan.id');
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['dari'] = $this->input->get('dari');
		$data['sampai'] = $this->input->get('sampai');
		$this->load->view('cetak_laporan_piutang', $data);
	}
	public function laporan_saldo_periode()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari'] . '+ 1 months'));
		$this->load->view('laporan_saldo_periode', $data);
	}
	public function cetak_laporan_saldo_periode()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$sampai = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));
		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->join('produk', 'dt_penjualan.id_produk=produk.id');
		$select = $this->db->join('kategori', 'produk.id_kategori=kategori.id');
		$select = $this->db->where('waktu >= "' . $this->input->get('dari') . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['pembelian'] = $this->m->Get_All('dt_pembelian', $select);
		$data['dari'] = $this->input->get('dari');
		$data['sampai'] = $this->input->get('sampai');
		$this->load->view('cetak_laporan_saldo_periode', $data);
	}
	public function profil()
	{
		$this->session->unset_userdata('sebelumnya');
		$this->session->set_userdata('sebelumnya', current_url());
		$where = array(
			'username' => $this->session->userdata('username'),
		);
		$data['read'] = $this->m->Get_Where($where, 'user');
		$this->load->view('profil', $data);
	}
	public function ubah_foto()
	{
		$result = $this->input->post('image');
		list($type, $data) = explode(';', $result);
		list(, $data)      = explode(',', $data);
		$hasil = base64_decode($data);
		$nama_foto = time() . '.png';
		$foto = $this->session->userdata('foto');
		$lokasi = 'assets/img/';
		file_put_contents($lokasi . $nama_foto, $hasil);
		if ($foto != 'default.png') {
			unlink($lokasi . $foto);
		}
		$where = array(
			'username' => $this->session->userdata('username')
		);
		$apa = array(
			'foto' => $nama_foto
		);
		$this->m->Update($where, $apa, 'user');
		$this->session->unset_userdata('foto');
		$this->session->set_userdata($apa);
	}
	public function ubah_password()
	{
		$where = array(
			'username' => $this->session->userdata('username')
		);
		$data = array(
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
		);
		$this->m->Update($where, $data, 'user');
		echo 'done';
	}
}
