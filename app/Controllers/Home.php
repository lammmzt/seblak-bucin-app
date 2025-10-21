<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Dashboard'; // set judul halaman
        $data['active'] = 'Dashboard'; // set active menu
        $data['breadcrumb'] = [
            ['label' => 'Dashboard', 'url' => ''], // set breadcrumb parent
        ]; // set breadcrumb
        return view('Admin/Dashboard/index', $data); // tampilkan view dashboard
    }
    
}