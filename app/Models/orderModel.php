<?php 
namespace App\Models;

use CodeIgniter\Model;

class orderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $allowedFields = ['id_order', 'id_user', 'total_bayar', 'metode_pembayaran', 'img_url', 'ket_order', 'status_order','created_at', 'updated_at'];

    public function getorder($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_order' => $id]);
        }
    }
}

?>