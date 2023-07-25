<?php
defined('BASEPATH') or exit('No direct script access allowed');
class NotFound extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
    }
    public function index()
    {
        $this->load->view('404');
    }
}
