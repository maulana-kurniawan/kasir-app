<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
		if ($this->session->userdata('confirmed') == FALSE) {
			$this->session->set_userdata('needsuper', TRUE);
			redirect('confirmation');
		}
	}
	public function index()
	{
		$this->load->view('register');
	}
	public function simpan()
	{
		$username = $this->input->post('username');
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $username);
		$query = $this->db->get();
		$user = $query->num_rows();
		if ($user > 0) {
			$hasil = array(
				'username'  => $username,
				'hasil'    => 'duplicate',
			);
			echo json_encode($hasil);
		} else {
			$username               = $username;
			$password               = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$nama                   = $this->input->post('nama');
			$akses                  = $this->input->post('akses');
			$cek = $this->m->register($username, $password, $nama, $akses);
			if (!empty($cek)) {
				$hasil = array(
					'nama'  => $nama,
					'hasil'    => 'success',
				);
				echo json_encode($hasil);
			}
		}
	}
}
