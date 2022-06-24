<?php

namespace App\Models;

use CodeIgniter\Model;

class Pokja_ep_model extends Model
{
    
    protected $table                = 'pokja_ep';
    protected $primaryKey           = 'id_ep';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['id_pokja','id_kelompok','id_standar','norut','nama_ep','created_by','created_at','updated_at', 'has_ep'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing($id_user)
    {
        $builder = $this->db->table('url');
        $builder->select('url.*, users.nama');
        $builder->where('created_by', $id_user);
        $builder->join('users', 'users.id_user = url.created_by', 'LEFT');
        $builder->orderBy('url.id_url', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }
    // read
    public function detail($has_pokja)
    {
        $builder = $this->db->table('pokja');
        $builder->select('pokja.*');
        $builder->where('has_pokja', $has_pokja);
        $builder->orderBy('id_pokja', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    //detail
    public function has_url($has_url)
    {
        $builder = $this->db->table('url');
        $builder->select('*');
        $builder->where('has_url', $has_url);
        $query = $builder->get();
        return $query->getRowArray();
    }
    // count
    public function count($id_pokja)
    {
        $builder = $this->db->table('pokja_standar')->where('id_pokja', $id_pokja);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // count
    public function count_kelompok($id_kelompok)
    {
        $builder = $this->db->table('pokja_ep')->where('id_kelompok', $id_kelompok);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // total
    public function total()
    {
        $builder = $this->db->table('url');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('url');
        $builder->insert($data);
    }

}
