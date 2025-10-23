<?php 
namespace App\Models;

use CodeIgniter\Model;

class topingModel extends Model
{
    protected $table = 'toping';
    protected $primaryKey = 'id_toping';
    protected $allowedFields = ['id_toping', 'kategori_toping', 'nama_toping', 'ket_toping', 'foto_toping', 'satuan_toping', 'status_toping', 'harga_toping','stok_toping','created_at', 'updated_at'];

    public function getToping($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_toping' => $id]);
        }
    }
}

?>