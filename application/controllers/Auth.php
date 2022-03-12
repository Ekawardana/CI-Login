<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Email tidak valid!'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //Jika Validasinya Sukses 
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->ModelUser->cekData(['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // Jika usernya aktif
            if ($user['is_active']) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    // Siapkan data untuk di session
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    // buat session
                    $this->session->set_userdata($data);
                    //cek id_levelnya jika admin maka akan masuk sebagai admin
                    if ($user['role_id'] == 1) {
                        //Pesan jika login berhasil
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Anda Berhasil Login!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                        redirect('admin');
                        // echo 'Login Berhasil';
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            $this->session->set_flashdata('message', '<div class="alert alert-info alert-message" role="alert"> Silahkan Ubah Profile Anda untuk Ubah Photo Profil</div>');
                        }
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-message" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email Has Not Been Activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email Is Not Registered!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            // akan dikembalikan kehalaman login
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama harus diisi!'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Email tidak valid!',
            'is_unique' => 'Email sudah terdaftar!'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password harus diisi!',
            'min_length' => 'Password terlalu pendek!',
            'matches' => 'Password tidak sama!'
        ]);

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password harus diisi!',
            'matches' => 'Password tidak sama!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->ModelUser->simpanData($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Your Account Has Been Created!!, Please Login <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('auth');
        }
    }

    // Fungsi Logout
    public function logout()
    {
        //Unset data user yang diambil berdasarkan username dan id_level
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        //Pesan logout berhasil dan akan dikembalikan kehalaman auth/login
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">You Have Been Logged out!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
         </button></div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
