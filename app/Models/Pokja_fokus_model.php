<?php

namespace App\Models;

use CodeIgniter\Model;

class Pokja_fokus_model extends Model
{
    
    protected $table                = 'pokja_fokus';
    protected $primaryKey           = 'id_fokus';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_fokus','id_kelompok','id_pokja','norut','created_by','created_at','updated_at', 'has_fokus'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    // total
    public function count_id_pokja_norut($id_pokja, $norut)
    {
        $builder = $this->db->table('pokja_fokus');
        $builder->where([
            'id_pokja'  => $id_pokja,
            'norut'     => $norut
        ]);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    public function count_id_kelompok($id_kelompok){
        $builder = $this->db->table('pokja_fokus');
        $builder->where('id_kelompok', $id_kelompok);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    public function count_id_pokja($id_pokja)
    {
        $builder = $this->db->table('pokja_fokus');
        $builder->where('id_pokja', $id_pokja);
        $query   = $builder->get();
        return $query->getNumRows();
    }
    public function max_norut($id_pokja){
        $builder = $this->db->table('pokja_fokus')->where('id_pokja', $id_pokja);
        $builder->selectMax('norut');
        $query=$builder->get();
        return $query->getRowArray();
    }
    public function total()
    {
        $builder = $this->db->table('url');
        $query   = $builder->get();
        return $query->getNumRows();
    }

}
