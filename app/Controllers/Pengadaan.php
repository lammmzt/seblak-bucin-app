<?php 
namespace App\Controllers;

use App\Models\pengadaanTopingModel;
use App\Models\topingModel;
use App\Models\userModel;
use App\Models\detailPengadaanTopingModel;
use Ramsey\Uuid\Uuid;

class Pengadaan extends BaseController
{
    public function index() // menampilkan data Menu
    {
        $pengadaanTopingModel = new pengadaanTopingModel();  // membuat objek model Menu
        $data['title'] = 'Daftar Pengadaan'; // set judul halaman
        $data['active'] = 'Pengadaan'; // set active menu
        $data['validation'] = \Config\Services::validation();
        $data['breadcrumb'] = [
            ['label' => 'Pengadaan', 'url' => '/'], // set breadcrumb home
            ['label' => '/ Data Pengadaan', 'url' => ''], // set breadcrumb parent
        ]; // set breadcrumb
        $data['data_pengadaan'] = $pengadaanTopingModel->getPengadaanToping();
        
        return view('Admin/Pengadaan/index', $data);
    }
    public function create() // menampilkan data Menu
    {
        $pengadaanTopingModel = new pengadaanTopingModel();  // membuat objek model Menu
        $topingModel = new topingModel();
        $data['title'] = 'Tambah Pengadaan'; // set judul halaman
        $data['active'] = 'Pengadaan'; // set active menu
        $data['validation'] = \Config\Services::validation();
        $data['toping'] = $topingModel->getToping();

        $data['breadcrumb'] = [
            ['label' => 'Daftar Pengadaan', 'url' => 'Pengadaan'], // set breadcrumb home
            ['label' => '/ Tambah Pengadaan', 'url' => ''], // set breadcrumb parent
        ]; // set breadcrumb
        $data['data_pengadaan'] = $pengadaanTopingModel->getPengadaanToping();
        
        return view('Admin/Pengadaan/create', $data);
    }

    public function save() // Proses simpan transaksi masuk
    {
        $pengadaanTopingModel = new pengadaanTopingModel();
        $detailPengadaanTopingModel = new detailPengadaanTopingModel();
        $topingModel = new topingModel();
        $id_pengadaan_toping = 'PGT-' . date('Ymdhis') .rand(100,999); // Generate id transaksi
        // dd($this->request->getPost());
        $data = [ // Data yang akan disimpan
            'id_pengadaan_toping' => $id_pengadaan_toping,
            'id_user' => session()->get('id_user'),
            // 'id_user' => 'admin@mail.com',
            'judul_pengadaan_toping' => $this->request->getPost('judul_pengadaan_toping'),
            'ket_pengadaan_toping' => $this->request->getPost('ket_pengadaan_toping'),
            'total_pengadaan_toping' => $this->request->getPost('total_pengadaan_toping'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // dd($data);
        $pengadaanTopingModel->insert($data); // Simpan data transaksi
        $data_toping = $this->request->getPost('data_toping'); // Mengambil data id tipe barang
        $data_toping = json_decode($data_toping, true); // Decode data json

        foreach ($data_toping as $key => $value) { // Looping data barang
            $detailPengadaanToping = [ // Data yang akan disimpan
                'id_toping' => $value['id_toping'],
                'id_pengadaan_toping' => $id_pengadaan_toping,
                'jumlah_detail_pengadaan_toping' => $value['jumlah'],
                'harga_modal_detail_pengadaan_toping' => $value['harga'],
                'harga_jual_detail_pengadaan_toping' => $value['harga_jual'],
                'subtotal_detail_pengadaan_toping' => $value['subtotal'],
                'exp_detail_pengadaan_toping' => $value['exp_toping'] ?? null,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $detailPengadaanTopingModel->save($detailPengadaanToping);
            // update harga tipe barang
            $topingModel->update($value['id_toping'], ['harga_toping' => $value['harga']]);
                
        }
        
        // set response json
        $response = [
            'error' => false,
            'status' => '200',
            'message' => 'Data transaksi masuk berhasil disimpan',
        ];

        return $this->response->setJSON($response); // Load view

    }


}