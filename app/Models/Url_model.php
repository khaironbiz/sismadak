<?php

namespace App\Models;

use CodeIgniter\Model;

class Url_model extends Model
{
    
    protected $table                = 'url';
    protected $primaryKey           = 'id_url';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['url_asli','short','created_by','created_at','updated_at', 'has_url'];
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
    public function ly($short)
    {
        $builder = $this->db->table('url');
        $builder->select('url.*');
        $builder->where('short', $short);
        $builder->orderBy('id_url', 'DESC');
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
    public function count($short)
    {
        $builder = $this->db->table('url')->where('short', $short);
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
