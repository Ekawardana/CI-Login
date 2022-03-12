<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    // Method Menu
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['menuIndex'] = $this->ModelMenu->getAllMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Nama Menu harus diisi!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelMenu->addMenu();
            $this->session->set_flashdata('message', 'Ditambah');
            redirect('menu');
        }
    }

    public function editMenu($id = null)
    {
        $data['title'] = 'Menu Edit';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['menuId'] = $this->ModelMenu->getMenuById($id)->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Nama Menu harus diisi!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelMenu->updateMenu(['id' => $id]);
            $this->session->set_flashdata('message', 'diubah');
            redirect('menu');
        }
    }

    public function deleteMenu()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelMenu->deleteMenu($where);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('menu');
    }

    // Method Submenu
    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->ModelMenu->getSubMenu();
        $data['menu'] = $this->ModelMenu->getAllMenu();

        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Title harus diisi!!'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'Menu harus diisi!!'
        ]);
        $this->form_validation->set_rules('url', 'Url', 'required', [
            'required' => 'Url harus diisi!!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Icon harus diisi!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelMenu->addSubMenu();
            $this->session->set_flashdata('message', 'Ditambah');
            redirect('menu/submenu');
        }
    }

    public function updateSubMenu($id = null)
    {
        $data['title'] = 'Edit Submenu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['subMenu'] = $this->ModelMenu->getSubMenuById($id);
        $data['menu'] = $this->ModelMenu->getAllMenu();

        $this->form_validation->set_rules('title', 'Title', 'required', [
            'required' => 'Title harus diisi!!'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'Menu harus diisi!!'
        ]);
        $this->form_validation->set_rules('url', 'Url', 'required', [
            'required' => 'Url harus diisi!!'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Icon harus diisi!!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit-submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->ModelMenu->updateSubMenu(['id' => $id]);
            $this->session->set_flashdata('message', 'Diubah');
            redirect('menu/submenu');
        }
    }

    public function deleteSubMenu()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelMenu->deleteSubMenu($where);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('menu/submenu');
    }
}
