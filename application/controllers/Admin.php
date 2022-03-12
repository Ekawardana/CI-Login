<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Role';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelAdmin->addrole();
            $this->session->set_flashdata('message', 'Ditambah');
            redirect('admin/role');
        }
    }

    // Memberi Access User
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menuAccess'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    // Method Khusus Ajax di footer
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', 'Diubah');
    }

    public function editRole($id)
    {
        $data['title'] = 'Edit Role';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['user_role'] = $this->ModelAdmin->getUserById($id);

        $this->form_validation->set_rules('role', 'Role', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelAdmin->editRole();
            $this->session->set_flashdata('message', 'Diubah');
            redirect('admin/role');
        }
    }

    public function deleterole()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelAdmin->deleterole($where);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('admin/role');
    }
}
