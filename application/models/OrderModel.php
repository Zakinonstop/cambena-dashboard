<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderModel extends CI_Model
{
    protected $table = 'pesanan';
    protected $primary_key = 'id';
    // protected $foreign_key = 'id_kategori';

    // protected $table_fk = 'kategori';
    // protected $table_fk_id = 'id_kategori';

    function getOrderById($id_pemesan)
    {
        $this->db->join('pemesan', 'pemesan.id = pesanan.id_pemesan');
        return $this->db->get_where($this->table, ['id_pemesan' => $id_pemesan]);    
    }
    function totalHarga($id_pemesan)
    {
        $query = $this->db->query('SELECT SUM(harga) AS total_harga FROM (SELECT harga FROM `pesanan` WHERE id_pemesan = 1) AS subquery;');
        return $query;    
    }

	public function getOrder()
	{
        $this->db->join('pemesan', 'pemesan.id = pesanan.id_pemesan');
		$this->db->join('model', 'model.id = pesanan.id_model');
		$this->db->join('jenis_pakaian', 'jenis_pakaian.id = pesanan.id_jenis_pakaian');
		$this->db->join('jenis_kain', 'jenis_kain.id = pesanan.id_jenis_kain');
		$this->db->join('mockup', 'mockup.id = pesanan.id_mockup');
		$this->db->join('ukuran', 'ukuran.id = pesanan.id_ukuran');
		$this->db->join('warna', 'warna.id = pesanan.id_warna');
		$this->db->join('keterangan', 'keterangan.id = pesanan.id_keterangan');

        $this->db->select('*, no_nota, pemesan.nama as nama_pemesan, alamat, model.nama as nama_model, jenis_pakaian.nama as nama_jenis_pakaian, 
                            jenis_kain.nama as nama_jenis_kain, ukuran.nama as nama_ukuran, warna.nama as nama_warna, keterangan.nama as nama_keterangan,');
		// $this->db->order_by('nama', 'ASC');
		return $this->db->get($this->table)->result();
	}

	function remove($id)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table);
    }

    function addOrder($data)
    {
        return $this->db->insert($this->table, $data);    
    }

    function create($data)
    {
        return $this->db->insert($this->table, $data);    
    }

    function insertMidtrans($data)
    {
        return $this->db->insert('transaksi_midtrans', $data);    
    }

    // function getOrderById($id)
    // {
    //     $this->db->where($this->primary_key, $id);
    //     return $this->db->get($this->table);
    // }

    function update($id, $data)
    {
        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table, $data);
    }
}
