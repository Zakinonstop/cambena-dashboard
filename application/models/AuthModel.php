<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    protected $table = 'pemesan';
    protected $primary_key = 'id';
    // protected $foreign_key = 'id_kategori';

    // protected $table_fk = 'kategori';
    // protected $table_fk_id = 'id_kategori';

    function postLogin($email, $password)
    {
        return $this->db->get_where($this->table, ['email' => $email, 'password' => $password]);
    }
	public function getAuth()
	{
        $this->db->join('pemesan', 'pemesan.id = pemesan.id_pemesan');
		$this->db->join('model', 'model.id = pemesan.id_model');
		$this->db->join('jenis_pakaian', 'jenis_pakaian.id = pemesan.id_jenis_pakaian');
		$this->db->join('jenis_kain', 'jenis_kain.id = pemesan.id_jenis_kain');
		$this->db->join('mockup', 'mockup.id = pemesan.id_mockup');
		$this->db->join('ukuran', 'ukuran.id = pemesan.id_ukuran');
		$this->db->join('warna', 'warna.id = pemesan.id_warna');
		$this->db->join('keterangan', 'keterangan.id = pemesan.id_keterangan');

        $this->db->select('*, no_nota, pemesan.nama as nama_pemesan, alamat, model.nama as nama_model, jenis_pakaian.nama as nama_jenis_pakaian, 
                            jenis_kain.nama as nama_jenis_kain, ukuran.nama as nama_ukuran, warna.nama as nama_warna, keterangan.nama as nama_keterangan,');
		// $this->db->Auth_by('nama', 'ASC');
		return $this->db->get($this->table)->result();
	}

	function remove($id)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table);
    }

    function addAuth($data)
    {
        return $this->db->insert($this->table, $data);    
    }

    function create($data)
    {
        return $this->db->insert($this->table, $data);    
    }

    function getAuthById($id)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->get($this->table);
    }

    function update($id, $data)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table, $data);
    }
}
