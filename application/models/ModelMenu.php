<?php
defined('BASEPATH') or exit('No direct script access allowed');


class ModelMenu extends CI_Model
{
    // Kelola Menu
    public function getAllMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id]);
    }

    public function addMenu()
    {
        //Tambah data dengan fungsi insert
        return $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
    }

    public function updateMenu($where = null)
    {
        $data = [
            'id' => $this->input->post('id'),
            'menu' => $this->input->post('menu')
        ];
        // var_dump($data);
        // die;
        $this->db->update('user_menu', $data, $where);
    }

    public function deleteMenu($where = null)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('user_menu', $where);
    }

    // public function joinMenu()
    // {
    //     $role_id = $this->session->userdata('role_id');
    //     $queryMenu = "SELECT `user_menu`.`id`, `menu`
    //                     FROM `user_menu` JOIN `user_access_menu`
    //                       ON `user_menu`.`id` = `user_access_menu`.`menu_id`
    //                    WHERE `user_access_menu`.`role_id` = $role_id
    //                 ORDER BY `user_access_menu`.`menu_id` ASC
    //                 ";
    //     return $this->db->query($queryMenu)->result_array();
    // }

    // Kelola Submenu
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                      ON `user_sub_menu`.`menu_id` =  `user_menu`.`id` 
                      ";
        return $this->db->query($query)->result_array();
    }

    public function addSubMenu()
    {
        $data = [
            'title' => $this->input->post('title', true),
            'menu_id' => $this->input->post('menu_id', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => $this->input->post('is_active', true)
        ];
        //Tambah data dengan fungsi insert
        return $this->db->insert('user_sub_menu', $data);
    }

    public function updateSubMenu()
    {
        $data = [
            'title' => $this->input->post('title', true),
            'menu_id' => $this->input->post('menu_id', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => $this->input->post('is_active', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    public function deleteSubMenu($where = null)
    {
        //Hapus data dengan fungsi delete
        return $this->db->delete('user_sub_menu', $where);
    }

    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }
}
