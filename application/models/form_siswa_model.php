<?php

class form_siswa_model extends CI_Model
{
    public $table = 'tbl_siswa';



    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('nis' => $id));
    }


    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        return $this->db->get();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('nis' => $id));
        $data['object'] = $query->row();
        $data['array'] = $query->row_array();
        $data['count'] = $query->num_rows();
        return $data;
    }
}
