<?php

namespace App\Models;

use CodeIgniter\Model;

class User_log_model extends Model
{
    
    protected $table                = 'user_logs';
    protected $primaryKey           = 'id_user_log';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [];
    protected $useTimestamps        = false;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;

    // listing
    public function listing()
    {
        $builder = $this->db->table('user_logs');
        $builder->select('user_logs.*, users.nama');
        $builder->join('users', 'users.id_user = user_logs.id_user', 'LEFT');
        $builder->orderBy('user_logs.id_user_log', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }
    // distinct
    public function distinct($variabel)
    {
        $builder = $this->db->table('user_logs');
        $distinct="DISTINCT($variabel)";
        $builder->select($distinct);
        $builder->orderBy($variabel, 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }
    // mylog
    public function mylog($id_user)
    {
        $builder = $this->db->table('user_logs');
        $builder->select('user_logs.*, users.nama');
        $builder->join('users', 'users.id_user = user_logs.id_user', 'LEFT');
        $builder->where('user_logs.id_user', $id_user);
        $builder->orderBy('user_logs.id_user_log', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }
    public function filter_date($tgl_awal, $tgl_ahir)
    {
        $db = db_connect();
        $sql = 'SELECT * FROM some_table WHERE id = :id: AND status = :status: AND author = :name:';
        $builder = $db->query($sql, [
            'id'     => 3,
            'status' => 'live',
            'name'   => 'Rick',
        ]);
        $query = $builder->get();

        return $query->getResultArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('user_logs');
        $builder->insert($data);
    }

}
