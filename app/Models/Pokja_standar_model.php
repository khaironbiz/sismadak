<?php

namespace App\Models;

use CodeIgniter\Model;

class Pokja_standar_model extends Model
{
    
    protected $table                = 'pokja_standar';
    protected $primaryKey           = 'id_standar';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['id_pokja','id_kelompok','id_fokus','norut','nama_standar','penjelasan','created_by','created_at','updated_at', 'has_standar'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    //count kelompok

    public function count_kelompok($id_kelompok_standar)
    {
        $builder = $this->db->table('pokja_standar')->where('id_kelompok', $id_kelompok_standar);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    public function max_norut(){
        $builder = $this->db->table('pokja_standar');
        $builder->selectMax('norut');
        $query=$builder->get();
        return $query->getRowArray();
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

    // count
    public function count($id_pokja)
    {
        $builder = $this->db->table('pokja_standar')->where('id_pokja', $id_pokja);
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
