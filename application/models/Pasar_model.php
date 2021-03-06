<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pasar_model extends CI_Model
{

    public $table = 'pasar';
    public $id = 'pasar_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }


    // get all order by ASC
    function get_all_asc($id=null)
    {
        if ($id != null) {
            $this->db->where('kecamatan_id', $id);
        }
        $this->db->order_by($this->id, 'ASC');
        return $this->db->get($this->table);
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('pasar_id', $q);
        $this->db->or_like('pasar_nama', $q);
        $this->db->or_like('kecamatan_id', $q);
        $this->db->or_like('pasar_lokasi', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('pasar_id', $q);
        $this->db->or_like('pasar_nama', $q);
        $this->db->or_like('pasar_lokasi', $q);
        $this->db->limit($limit, $start);
        $this->db->select('t1.pasar_id as pasar_id, t1.pasar_nama as pasar_nama, t1.pasar_lokasi as pasar_lokasi, t2.kecamatan_nama as kecamatan_nama');
        //$this->db->select('*');
        $this->db->from('pasar AS t1');
        $this->db->join('kecamatan AS t2', 't1.kecamatan_id = t2.kecamatan_id');
        return $this->db->get()->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/* End of file Pasar_model.php */
/* Location: ./application/models/Pasar_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-06 07:33:56 */
/* http://harviacode.com */
