<?php

namespace App\Models;

use CodeIgniter\Model;

class Kelompok_standar_model extends Model
{
    
    protected $table                = 'kelompok_standar';
    protected $primaryKey           = 'id_kelompok_standar';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['kelompok_standar','created_by','created_at','updated_at', 'has_kelompok_standar'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;



    public function total()
    {
        $builder = $this->db->table('kelompok_standar');
        $query   = $builder->get();
        return $query->getNumRows();
    }
}
