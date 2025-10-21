<?php 
namespace App\Models;

use CodeIgniter\Model;

class menuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields = ['id_menu', 'kategori_menu', 'nama_menu', 'ket_menu', 'foto_menu', 'stok_menu', 'status_menu', 'harga_menu','created_at', 'updated_at'];

    public function getMenu($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_menu' => $id]);
        }
    }
}

?>