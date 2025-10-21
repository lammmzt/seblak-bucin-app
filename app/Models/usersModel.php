<?php 
namespace App\Models;

use CodeIgniter\Model;

class usersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'password', 'nama_user', 'no_hp_user', 'status_user', 'alamat_user','role', 'created_at', 'updated_at'];

    public function getUsers($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_user' => $id]);
        }
    }
}

?>