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
            ['label' => 'Pengdaaan', 'url' => '/'], // set breadcrumb home
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
            ['label' => 'Daftar Pengdaaan', 'url' => 'Pengadaan'], // set breadcrumb home
            ['label' => '/ Tambah Pengadaan', 'url' => ''], // set breadcrumb parent
        ]; // set breadcrumb
        $data['data_pengadaan'] = $pengadaanTopingModel->getPengadaanToping();
        
        return view('Admin/Pengadaan/create', $data);
    }


}