<?php

namespace App\Models;

use CodeIgniter\Model;

class Pokja_model extends Model
{
    
    protected $table                = 'pokja';
    protected $primaryKey           = 'id_pokja';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_pokja','id_kelompok','norut','penjelasan','created_by','created_at','updated_at', 'has_pokja'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


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
    //count kelompok
    public function count_kelompok($id_kelompok){
        $builder = $this->db->table('pokja');
        $builder->where('id_kelompok', $id_kelompok);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    // total
    public function total()
    {
        $builder = $this->db->table('pokja');
        $query   = $builder->get();
        return $query->getNumRows();
    }

}
