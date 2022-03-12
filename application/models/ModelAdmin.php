<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelAdmin extends CI_Model
{
    public function addrole()
    {
        $data = [
            'role' => $this->input->post('role', true)
        ];

        $this->db->insert('user_role', $data);
    }

    public function deleterole($where = null)
    {
        return $this->db->delete('user_role', $where);
    }

    public function editRole()
    {
        $data = [
            'role' => $this->input->post('role', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
    }

    public function getUserById($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }
}
