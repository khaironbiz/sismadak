<?php

namespace App\Models;

use CodeIgniter\Model;

class Pokja_fokus_model extends Model
{
    
    protected $table                = 'pokja_fokus';
    protected $primaryKey           = 'id_fokus';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_fokus','created_by','created_at','updated_at', 'has_fokus'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    // total
    public function total()
    {
        $builder = $this->db->table('url');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    
}
