<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Lockscreen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Models', 'm');
		if ($this->session->userdata('logged')) {
			redirect($this->session->userdata('sebelumnya'));
		} elseif ($this->session->userdata('confirmed')) {
			redirect('registration');
		} elseif (!$this->session->userdata('needsuper')) {
			redirect('home');
		}
	}
	public function index()
	{
		$this->load->view('lockscreen');
	}
	public function accept()
	{
		$password = $this->input->post('password');
		if ($password == 'Aku Sayang Kamu') {
			$data = array(
				'confirmed' => TRUE,
				'nama' => 'Super Admin',
			);
			$this->session->set_userdata($data);
			echo json_encode($data);
		} else {
			$data['confirmed'] = 'denied';
			echo json_encode($data);
		}
	}
}
