<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index() //untuk loginnya
    {
        $data['title'] = 'Login';
        if ($this->session->userdata('email')) {
            redirect('user');
        }


        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else { // jika berhasil
            $this->_login(); //_ function private

        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //query select * from table user where emailnya = email
        $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

        if ($user) {
            //usernya ada
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
                    Wrong password!
                </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
               This email has not been activated!
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
            Email is not registered.
            </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $data['title'] = 'Registration';
        if ($this->session->userdata('email')) {
            redirect('user');
        }


        $this->form_validation->set_rules('name', 'Name', 'required|trim'); //trim untuk spasi tidak masuk database
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]', [
            'is_unique' => 'This Email has already Registered!'
        ]); //is_unique untuk email unik kurang siku untuk nama tabel(user) dan field(email) db
        $this->form_validation->set_rules('nis', 'Nis', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match! ',
            'min_length' => 'Password too short!'
        ]); // min_leght batas nulis pass, matches agar sama dengan pass 2
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name'  => htmlspecialchars($this->input->post('name', true)), // true untuk menghindari ss crose scripting
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), //enkripsi punyanya php password_hash, PASSWORD_DEFAULT agar dipilihkan yang baik oleh phpnya
                'nis' => htmlspecialchars($this->input->post('nis', true)),
                'role_id' => 2, //member
                'is_active' => 1, // otomatis aktif kalo 1//agar gk aktif dan gk login sebelum aktivasi
                'date_created' => time()
            ];

            $this->db->insert('tbl_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            Congratulation!. Your Account has been created. Please Login
            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            You have been logged out!
            </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
