<?php

class data_siswa_model extends CI_Model
{
    public $table = 'tbl_siswa';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('nis' => $id));
    }

    public function delete($id)
    {
        $get_siswa = $this->db->get_where('tbl_siswa', ['nis' => $id])->row();
        if ($get_siswa) {
            if ($get_siswa->foto == NULL) {
                $query = $this->db->delete('tbl_siswa', ['nis' => $id]);
            } else {
                $query = $this->db->delete('tbl_siswa', ['nis' => $id]);
                if ($query) {
                    return unlink("assets/uploads/foto_siswa/" . $get_siswa->foto);
                }
            }
        }
    }

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        return $this->db->get();
    }
    public function tampil_data_satu($email)
    {
        $sql = 'select t.* FROM tbl_siswa t INNER JOIN tbl_user u ON u.nis=t.nis where u.email=?';
        return $this->db->query($sql, array($email));
    }

    public function get_by_id($id)
    {
        $this->db->select('s.nis,s.nama_siswa,s.tempat_lahir,s.tgl_lahir,s.jenis_kelamin,s.alamat,s.jurusan,s.foto');
        $this->db->from('tbl_siswa s');
        $query = $this->db->get_where($this->table, array('s.nis' => $id));
        $data['object'] = $query->row();
        $data['array'] = $query->row_array();
        $data['count'] = $query->num_rows();
        return $data;
    }
}
