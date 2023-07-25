<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
		if ($this->session->userdata('logged')) {
			redirect($this->session->userdata('sebelumnya'));
		}
	}
	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('login');
	}
	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek = $this->m->login($username, $password);
		if (!empty($cek)) {
			foreach ($cek as $user) {
				$session_data = array(
					'username'  => $user->username,
					'foto'      => $user->foto,
					'nama'      => $user->nama,
					'akses'     => $user->akses,
					'logged'    => TRUE
				);
			}
			$this->session->set_userdata($session_data);
			echo json_encode($session_data);
		}
	}
}
