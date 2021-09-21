<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in(); // ngecek udah login apa belum, trs rolenya apa, taruh di user, menu, admin,
    // }

    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }

    public function index() //menampilkan profile dari user
    {

        // $email = $this->session->userdata('email');
        // $this->db->select('b.nama_siswa,b.foto');
        // $this->db->from('tbl_user u');
        // $this->db->join('tbl_siswa s', 's.nis=u.nis', 'left');
        // $this->db->where('u.email', $email);
        // $user = $this->db->get();
        // $data['biodata'] = $user;
        $data['user'] = $this->db->get_where('tbl_user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $data['role_check'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}
