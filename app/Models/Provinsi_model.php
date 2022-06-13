<?php

namespace App\Models;

use CodeIgniter\Model;

class Provinsi_model extends Model
{
    
    protected $table                = 'prov';
    protected $primaryKey           = 'id_provinsi';
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = [
                                        'id_prov',
                                        'nama_prov',
                                    ];
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;


    // Listing
    public function listing()
    {
        $builder = $this->db->table('prov');
        $builder->orderBy('prov.nama_prov', 'ASC');
        $query = $builder->get();

        return $query->getResultArray();
    }
    public function detail($token)
    {
        $builder = $this->db->table('token');
        $builder->select('token.*, users.nama');
        $builder->where('token', $token);
        $builder->join('users', 'users.id_user = token.created_by', 'LEFT');
        $builder->orderBy('token.id_token', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
    // read
    public function reset($token)
    {
        $builder = $this->db->table('token');
        $builder->select('token.*, users.nama');
        $builder->join('users', 'users.id_user = token.created_by', 'LEFT');
        $builder->where('token.token', $token);
        $builder->orderBy('token.id_token', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // count token
    public function count_token($token)
    {
        $builder = $this->db->table('token');
        $builder->select('COUNT(*) AS count');
        $builder->where([
            'token'    => $token,
            'read_at'  => '0', ]);
        $builder->orderBy('token.id_token', 'DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
    // count
    public function count($id_user)
    {
        $builder = $this->db->table('token');
        $builder->where([
            'created_by'    => $id_user,
            'read_at'       => '0', ]);
        $builder->select('COUNT(*) AS total');
        $query   = $builder->get();
        return $query->getNumRows();
    }
    


}
