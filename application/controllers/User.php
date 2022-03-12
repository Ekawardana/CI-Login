<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit-profile', $data);
            $this->load->view('templates/footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            //Cek requirement gambarnya
            if ($upload_image) {
                //Tipe gambar harus gif, jpg, png
                $config['allowed_types'] = 'gif|jpg|png';
                //Tize file gambar yang diupload
                $config['max_size']     = '2048';
                //Tempat menyimpan file gambar yang telah diupload
                $config['upload_path'] = './assets/img/profile';
                //Panggil library upload filenya
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // Cari gambar lama yang akan dihapus setelah gambar diupdate
                    $old_image = $data['user']['image'];
                    //Cek jika gambar lama bukan default.jpg, hapus gambarnya setelah ada gambar baru
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    // Tampung data file upload beserta semua informasinya di variabel $gambar_baru
                    $new_image = $this->upload->data('file_name');
                    //Panggil fungsi set untuk menyimpan gambar baru ke tabel user
                    $this->db->set('image', $new_image);
                } else {
                    // Jika Gagal
                    echo $this->upload->dispay_errors();
                }
            }
            //Jika berhasil, Panggil fungsi ubah user dari ModelUser
            $this->ModelUser->editUser();
            //Tampilkan Pesan
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">Your Profile Edited!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('user');
        }
    }

    // Fungsi Ubah Password
    public function changepassword()
    {
        $data['title'] = 'Change Password';
        //Ambil data user dari session
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim|min_length[3]', [
            'required' => 'Password Lama harus diisi',
            'min_length' => 'Password Terlalu Pendek!'
        ]);

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('password_baru1', 'Password Baru1', 'required|trim|min_length[3]|matches[password_baru2]', [
            'required' => 'Password Baru harus diisi',
            'min_length' => 'Password Terlalu Pendek!',
            'matches' => 'Password Harus Sama'
        ]);

        //Rules validasinya jika input tidak sesuai
        $this->form_validation->set_rules('password_baru2', 'Password Baru2', 'required|trim|min_length[3]|matches[password_baru1]', [
            'required' => 'Confirm Password harus diisi',
            'min_length' => 'Password Terlalu Pendek!',
            'matches' => 'Password Harus Sama'
        ]);

        // Cek Jika Rules Tidak Sesuai
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/change-password', $data);
            $this->load->view('templates/footer');
        } else {
            // Fungsi Ubah Password
            $this->ModelUser->changePassword();
        }
    }
}
