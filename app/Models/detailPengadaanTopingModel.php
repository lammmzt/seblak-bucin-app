<?php 
namespace App\Models;

use CodeIgniter\Model;

class detailPengadaanTopingModel extends Model
{
    protected $table = 'detail_pengadaan_toping';
    protected $primaryKey = 'id_detail_pengadaan_toping';
    protected $allowedFields = ['id_detail_pengadaan_toping', 'id_pengadaan_toping','id_toping', 'jumlah_detail_pengadaan_toping', 'harga_modal_detail_pengadaan_toping', 'harga_jual_detail_pengadaan_toping','subtotal_detail_pengadaan_toping','exp_detail_pengadaan_toping', 'updated_at'];

    public function getdetailToping($id = false)
    {
        if ($id === false) {
            return $this
            ->select('detail_pengadaan_toping.id_detail_pengadaan_toping, detail_pengadaan_toping.id_toping, detail_pengadaan_toping.jumlah_detail_pengadaan_toping, detail_pengadaan_toping.jumlah_detail_pengadaan_toping, detail_pengadaan_toping.harga_modal_detail_pengadaan_toping, detail_pengadaan_toping.harga_jual_detail_pengadaan_toping, detail_pengadaan_toping.subtotal_detail_pengadaan_toping, detail_pengadaan_toping.exp_detail_pengadaan_toping, toping.nama_toping, toping.kategori_toping, toping.ket_toping, toping.harga_toping, toping.foto_toping, pengadaan_toping.id_pengadaan_toping, pengadaan_toping.created_at, pengadaan_toping.judul_pengadaan_toping')
            ->join('toping', 'toping.id_toping = detail_pengadaan_toping.id_toping')
            ->join('pengadaan_toping', 'pengadaan_toping.id_pengadaan_toping = detail_pengadaan_toping.id_pengadaan_toping')
            ->findAll();
        } else {
            return $this->getWhere(['id_detail_pengadaan_toping' => $id]);
        }
    }

    public function getDetailPengadaanByIdPengadaan($id){
        return $this->select('detail_pengadaan_toping.id_detail_pengadaan_toping, detail_pengadaan_toping.id_toping, detail_pengadaan_toping.jumlah_detail_pengadaan_toping, detail_pengadaan_toping.jumlah_detail_pengadaan_toping, detail_pengadaan_toping.harga_modal_detail_pengadaan_toping, detail_pengadaan_toping.harga_jual_detail_pengadaan_toping, detail_pengadaan_toping.subtotal_detail_pengadaan_toping, detail_pengadaan_toping.exp_detail_pengadaan_toping, toping.nama_toping, toping.kategori_toping, toping.ket_toping, toping.harga_toping, toping.foto_toping, pengadaan_toping.id_pengadaan_toping, pengadaan_toping.created_at, pengadaan_toping.judul_pengadaan_toping')
            ->join('toping', 'toping.id_toping = detail_pengadaan_toping.id_toping')
            ->join('pengadaan_toping', 'pengadaan_toping.id_pengadaan_toping = detail_pengadaan_toping.id_pengadaan_toping')
            ->where('pengadaan_toping.id_pengadaan_toping', $id)
            ->orderBy('detail_pengadaan_toping.id_detail_pengadaan_toping', 'ASC')
            ->findAll();
    }
}

?>