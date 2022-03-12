<?php
defined('BASEPATH') or exit('No direct script access allowed');


class ModelUser extends CI_Model
{
    public function simpanData($data = null)
    {
        $this->db->insert('user', $data);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUser()
    {
        return $this->db->get('user');
    }

    public function editUser()
    {
        // Siapkan data yang akan diupdate
        $name = $this->input->post('name');
        $email = $this->input->post('email');

        //Data yang diubah
        $this->db->set('name', $name);
        //Data yang diupdate diambil berdasarkan username
        $this->db->where('email', $email);
        //Panggil fungsi update data
        $this->db->update('user');
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    // Fungsi Ubah Password
    public function changePassword()
    {
        // Variabel password lama untuk ambil data password lama dari form
        $password_lama = $this->input->post('password_lama');

        // Variabel password lama untuk ambil data password lama dari form
        $password_baru = $this->input->post('password_baru1');

        //Ambil data user dari session
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        // Cek jika password lama tidak sama 
        if (!password_verify($password_lama, $data['user']['password'])) {
            // Tampil Pesan Eror
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Salah!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/ubahPassword');
        } else {
            // Cek jika password lama sama dengan password yang baru
            if ($password_lama == $password_baru) {
                // Tampil Pesan Eror
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password Baru Tidak Boleh Sama Dengan Password Lama!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/ubahPassword');
            } else {
                // Jika Passwordnya Sudah Ok
                $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                $this->db->set('password', $password_hash);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('user');

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Password Telah Diubah!! <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                redirect('user/changepassword');
            }
        }
    }
}
    /* End of file User_model.php */