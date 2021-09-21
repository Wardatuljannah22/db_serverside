<?php

class data_siswa extends CI_Controller
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

        // $email =  $this->session->userdata('email');
        // $this->db->select('b.nama_siswa,b.foto');
        // $this->db->from('user u');
        // $this->db->join('biodata_santri b', 'b.nis=u.nis', 'left');
        // $this->db->where('u.email', $email);
        // $user = $this->db->get();
        // $data['biodata'] = $user;
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role_check'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')]);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/data_siswa/view.php', $data);
        $this->load->view('templates/footer');
        $this->load->view('admin/data_siswa/script.php', $data);
    }
    public function get_all()
    {
        $siswa = $this->data_siswa_model->get_all();
        $data['data_siswa'] = $siswa;
        $this->load->view('admin/data_siswa/biodata_siswa', $data);
    }

    public function _rules()
    {
    }



    public function crud($mode)
    {
        if ($mode == 'insert') {
            $config['upload_path']          = './assets/uploads/foto_siswa/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['width']                = 300;
            $config['height']               = 400;
            $filename = $this->input->post('nis');
            $config['file_name'] = $filename;
            $this->upload->initialize($config);
            if ($this->upload->do_upload("foto")) {
                $gbr = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/foto_siswa/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '100%';
                $config['width'] = 400;
                $config['height'] = 600;
                $config['new_image'] = './assets/uploads/foto_siswa/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data = array(
                    'nis' => $this->input->post('nis'),
                    'nama_siswa' => $this->input->post('nama_siswa'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'jenis_kelamin' => set_value('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),
                    'jurusan' => $this->input->post('jurusan'),
                    'foto' => $gbr['file_name'],
                );
                $result = $this->db->insert('tbl_siswa', $data);
                echo json_decode($result);
            }
        } else if ($mode == 'update') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $data = array(
                    'nama_siswa' => $this->input->post('nama_siswa'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'jenis_kelamin' => set_value('jenis_kelamin'),
                    'alamat' => $this->input->post('alamat'),
                    'jurusan' => $this->input->post('jurusan'),
                );
                if (empty($_FILES['foto']['name'])) {
                    // $data['foto']=harus null biar bisa diinsert
                } else {
                    $patch = $this->db->get_where('tbl_siswa', ['nis' => $id])->row();
                    if ($patch) {
                        if (file_exists("assets/uploads/foto_siswa/" . $patch->foto)) {
                            unlink("assets/uploads/foto_siswa/" . $patch->foto);
                        } else {
                        }
                    }
                    $config['upload_path']          = './assets/uploads/foto_siswa/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 1024;
                    $config['width']                = 300;
                    $config['height']               = 400;
                    $filename = $this->input->post('nis');
                    $config['file_name'] = $filename;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("foto")) {
                        $gbr = $this->upload->data();
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = './assets/uploads/foto_siswa/' . $gbr['file_name'];
                        $config['create_thumb'] = FALSE;
                        $config['maintain_ratio'] = FALSE;
                        $config['quality'] = '100%';
                        $config['width'] = 400;
                        $config['height'] = 600;
                        $config['new_image'] = './assets/uploads/foto_siswa/' . $gbr['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $data['foto'] = $gbr['file_name'];
                    }
                }
                $result = $this->data_siswa_model->update($data, $id);
                echo json_decode($result);
            }
        } else if ($mode == 'delete') {
            if ($this->input->is_ajax_request()) {
                $id = $this->input->post('id');
                $result = $this->data_siswa_model->delete($id);
                echo json_encode($result);
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
