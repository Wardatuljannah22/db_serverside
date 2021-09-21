<?php

class FormSiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('data_siswa_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');

        // Your own constructor code
    }
    public function index()
    {

        $email =  $this->session->userdata('email');
        $this->db->select('s.nama_siswa,s.foto');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_siswa s', 's.nis=u.nis', 'left');
        $this->db->where('u.email', $email);
        $user = $this->db->get();
        $data['biodata'] = $user;
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')]);
        // $this->load->view('template_admin/header');
        // $this->load->view('template_admin/sidebar');
        // $this->load->view('admin/biodata_santri/view', $data);
        // $this->load->view('template_admin/footer');
        // $this->load->view('admin/biodata_santri/script.php');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/form_siswa/view.php', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/form_siswa/script.php', $data);
    }
    public function get_all()
    {
        $email =  $this->session->userdata('email');
        //Bagian if else digunakan untuk logika filter.$_GET digunakan mendapatkan value dari ajax yang terdapat di data{}
        $siswa = $this->data_siswa_model->tampil_data_satu($email);
        $data['data_siswa'] = $siswa;
        $this->load->view('admin/form_siswa/biodata_siswa', $data);
    }
    public function crud($mode)
    {
        if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nis' => $this->input->post('nis'),
                    'nama_siswa' => $this->input->post('nama_siswa'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'jenis_kelamin' => set_value('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),
                    'jurusan' => $this->input->post('jurusan'),
                );
                $result = $this->data_siswa_model->update($data, $id);
                echo json_decode($result);
            }
        }
    }
    public function get_by_id()
    {
        $id = $this->input->get('id');
        $data = $this->data_siswa_model->get_by_id($id);
        echo json_encode($data);
    }
}
