<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Models extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function Get_All($table, $select)
	{
		$select;
		$query = $this->db->get($table);
		return $query->result();
	}
	public function Get_Where($where, $table)
	{
		$query = $this->db->get_where($table, $where);
		return $query->result();
	}
	function Save($data, $table)
	{
		$result = $this->db->insert($table, $data);
		return $result;
	}
	function Update($where, $data, $table)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}
	function Update_All($data, $table)
	{
		$this->db->update($table, $data);
		return $this->db->affected_rows();
	}
	function Delete($where, $table)
	{
		$result = $this->db->delete($table, $where);
		return $result;
	}
	function Delete_All($table)
	{
		$result = $this->db->delete($table);
		return $result;
	}
	function register($username, $password, $nama, $akses)
	{
		$data = array(
			'username' => $username,
			'password' => $password,
			'nama' => $nama,
			'akses' => $akses
		);
		$result = $this->db->insert('user', $data);
		return $result;
	}
	function login($username, $password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $username);
		$query = $this->db->get();
		$user = $query->row();
		if (!empty($user)) {
			if (password_verify($password, $user->password)) {
				return $query->result();
			} else {
				$data['logged'] = 'wrong';
				echo json_encode($data);
			}
		} else {
			$hasil = array(
				'logged'  => 'blank',
				'username'    => $username,
			);
			echo json_encode($hasil);
		}
	}
}
