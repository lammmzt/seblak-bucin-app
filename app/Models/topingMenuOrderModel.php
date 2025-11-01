<?php 
namespace App\Models;

use CodeIgniter\Model;

class topingMenuOrderModel extends Model
{
    protected $table = 'toping_menu_order';
    protected $primaryKey = 'id_toping_menu_order';
    protected $allowedFields = ['id_order', 'id_menu_order', 'id_detail_toping', 'jumlah_toping_menu_order', 'subutotal_toping_menu_order', 'created_at', 'updated_at'];

    public function geTopingMenuOrder($id = false)
    {
        if ($id === false) {
            return $this
            ->select('toping_menu_order.jumlah_toping_menu_order, toping_menu_order.subtotal_toping_menu_order, toping_menu_order.id_toping_menu_order, menu_order.id_menu, menu_order.id_order, menu_order.tipe_menu_order, menu_order.ket_menu_order, menu_order.lv_menu_order, menu_order.sub_total, menu_order.status_menu_order, menu_order.created_at, menu_order.updated_at, menu.nama_menu, menu.foto_menu, menu.harga_menu, menu.kategori_menu, users.nama_user, order.total_bayar, order.status_order, order.metode_pembayaran, order.img_url, order.ket_order,order.nomor_antrean, detail_toping.id_detail_toping, detail_toping.id_toping, detail_toping.jumlah_detail_toping, detail_toping.jumlah_detail_toping, detail_toping.harga_pengadaan_detail_toping, detail_toping.harga_jual_detail_toping, detail_toping.exp_detail_toping, toping.nama_toping, toping.kategori_toping, toping.ket_toping, toping.harga_toping, toping.foto_toping')
            ->join('users', 'users.id_user = order.id_user')
            ->join('toping_menu_order', 'toping_menu_order.id_menu_order = menu_order.id_menu_order')
            ->join('menu', 'menu.id_menu = menu_order.id_menu')
            ->join('detail_toping', 'detail_toping.id_detail_toping = toping_menu_order.id_detail_toping')
            ->join('toping', 'toping.id_toping = detail_toping.id_toping')
            ->orderBy('menu_order.id_menu_order', 'DESC')
            ->findAll();
        } else {
            return $this->getWhere(['id_menu_order' => $id]);
        }
    }

    public function getTopingMeOrderMenuByIdMenuOrder($id_menu_order) {
        return $this
           ->select('toping_menu_order.jumlah_toping_menu_order, toping_menu_order.subtotal_toping_menu_order, toping_menu_order.id_toping_menu_order, menu_order.id_menu, menu_order.id_order, menu_order.tipe_menu_order, menu_order.ket_menu_order, menu_order.lv_menu_order, menu_order.sub_total, menu_order.status_menu_order, menu_order.created_at, menu_order.updated_at, menu.nama_menu, menu.foto_menu, menu.harga_menu, menu.kategori_menu, users.nama_user, order.total_bayar, order.status_order, order.metode_pembayaran, order.img_url, order.ket_order,order.nomor_antrean, detail_toping.id_detail_toping, detail_toping.id_toping, detail_toping.jumlah_detail_toping, detail_toping.jumlah_detail_toping, detail_toping.harga_pengadaan_detail_toping, detail_toping.harga_jual_detail_toping, detail_toping.exp_detail_toping, toping.nama_toping, toping.kategori_toping, toping.ket_toping, toping.harga_toping, toping.foto_toping')
            ->join('users', 'users.id_user = order.id_user')
            ->join('toping_menu_order', 'toping_menu_order.id_menu_order = menu_order.id_menu_order')
            ->join('menu', 'menu.id_menu = menu_order.id_menu')
            ->join('detail_toping', 'detail_toping.id_detail_toping = toping_menu_order.id_detail_toping')
            ->join('toping', 'toping.id_toping = detail_toping.id_toping')
            ->orderBy('menu_order.id_menu_order', 'DESC')
            ->where('menu_order.id_menu_order', $id_menu_order)
            ->findAll();
    }
}

?>