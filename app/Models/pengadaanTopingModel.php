<?php 
namespace App\Models;

use CodeIgniter\Model;

class pengadaanTopingModel extends Model
{
    protected $table = 'pengadaan_toping';
    protected $primaryKey = 'id_pengadaan_toping';
    protected $allowedFields = ['id_pengadaan_toping', 'id_user', 'total_pengadaan_toping', 'total_pengadaan_toping', 'ket_pengadan_toping','created_at', 'updated_at'];

    public function getPengadaanToping($id = false)
    {
        if ($id === false) {
            return $this
            ->select('pengadaan_toping.id_pengadaan_toping, pengadaan_toping.id_user, pengadaan_toping.total_pengadaan_toping, pengadaan_toping.total_pengadaan_toping, pengadaan_toping.created_at, pengadaan_toping.updated_at, users.nama_user')
            ->join('users', 'users.id_user = pengadaan_toping.id_user')
            ->orderBy('pengadaan_toping.created_at', 'DESC')
            ->findAll();
        } else {
            return $this->getWhere(['id_menu_order' => $id]);
        }
    }

    
}

?>