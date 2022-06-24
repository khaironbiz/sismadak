<?php

namespace App\Models;

use CodeIgniter\Model;

class Pokja_penilaian_model extends Model
{
    
    protected $table                = 'pokja_penilaian';
    protected $primaryKey           = 'id_penilaian';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['nama_penilaian','created_by','created_at','updated_at', 'has_penilaian'];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;



}
