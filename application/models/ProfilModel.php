<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfilModel extends CI_Model
{
    protected $table = 'profil';
    protected $primary_key = 'id';
    protected $foreign_key = 'id_kategori';

    protected $table_fk = 'kategori';
    protected $table_fk_id = 'id_kategori';

	public function getProfil()
	{
		// $this->db->join('kategori', 'kategori.id_kategori = Profil.id_kategori');
		// $this->db->order_by('nama', 'ASC');
		return $this->db->get($this->table)->result();
	}

	function remove($id)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table);
    }

    function addProfil($data)
    {
        return $this->db->insert($this->table, $data);    
    }

    function create($data)
    {
        return $this->db->insert($this->table, $data);    
    }

    function getProfilById($id)
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
