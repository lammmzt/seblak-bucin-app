<?php 
namespace App\Models;

use CodeIgniter\Model;

class menuOrderModel extends Model
{
    protected $table = 'menu_order';
    protected $primaryKey = 'id_menu_order';
    protected $allowedFields = ['id_menu', 'id_order', 'id_menu', 'tipe_menu_order', 'ket_menu_order', 'lv_menu_order', 'sub_total', 'status_menu_order','created_at', 'updated_at'];

    public function getMenuOrder($id = false)
    {
        if ($id === false) {
            return $this
            ->select('menu_order.id_menu, menu_order.id_order, menu_order.tipe_menu_order, menu_order.ket_menu_order, menu_order.lv_menu_order, menu_order.sub_total, menu_order.status_menu_order, menu_order.created_at, menu_order.updated_at, menu.nama_menu, menu.foto_menu, menu.harga_menu, menu.kategori_menu, users.nama_user, order.total_bayar, order.status_order, order.metode_pembayaran, order.img_url, order.ket_order,order.nomor_antrean')
            ->join('menu', 'menu.id_menu = menu_order.id_menu')
            ->join('order', 'order.id_order = menu_order.id_order')
            ->join('users', 'users.id_user = order.id_user')
            ->orderBy('menu_order.id_menu_order', 'DESC')
            ->findAll();
        } else {
            return $this->getWhere(['id_menu_order' => $id]);
        }
    }

    public function getOrderMenuByOrder($id_order) {
        return $this
            ->select('menu_order.id_menu, menu_order.id_order, menu_order.tipe_menu_order, menu_order.ket_menu_order, menu_order.lv_menu_order, menu_order.sub_total, menu_order.status_menu_order, menu_order.created_at, menu_order.updated_at, menu.nama_menu, menu.foto_menu, menu.harga_menu, menu.kategori_menu, users.nama_user, order.total_bayar, order.status_order, order.metode_pembayaran, order.img_url, order.ket_order,order.nomor_antrean')
            ->join('menu', 'menu.id_menu = menu_order.id_menu')
            ->join('order', 'order.id_order = menu_order.id_order')
            ->join('users', 'users.id_user = order.id_user')
            ->where('menu_order.id_order', $id_order)
            ->orderBy('menu_order.created_at', 'DESC')
            ->findAll();
    }
}

?>