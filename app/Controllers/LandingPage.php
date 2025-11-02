<?php 
namespace App\Controllers;

use App\Models\topingModel;
use Ramsey\Uuid\Uuid;

class LandingPage extends BaseController
{
    public function index() // menampilkan data toping
    {
        $topingModel = new topingModel();  // membuat objek model toping
        $data['title'] = 'Daftar Toping'; // set judul halaman
        $data['active'] = 'Toping'; // set active toping
        $data['validation'] = \Config\Services::validation();
        $data['breadcrumb'] = [
            ['label' => 'Home', 'url' => '/'], // set breadcrumb home
            ['label' => '', 'url' => ''], // set breadcrumb parent
        ]; // set breadcrumb
        $data['data_toping'] = $topingModel->findAll(); // mengambil data toping
        
        return view('LandingPage/index', $data);
    }

}