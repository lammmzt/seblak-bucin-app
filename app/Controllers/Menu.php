<?php 
namespace App\Controllers;

use App\Models\menuModel;
use Ramsey\Uuid\Uuid;

class Menu extends BaseController
{
    public function index() // menampilkan data Menu
    {
        $menuModel = new menuModel();  // membuat objek model Menu
        $data['title'] = 'Daftar Menu'; // set judul halaman
        $data['active'] = 'Menu'; // set active menu
        $data['validation'] = \Config\Services::validation();
        $data['breadcrumb'] = [
            ['label' => 'Menu', 'url' => '/'], // set breadcrumb home
            ['label' => '/ Data Menu', 'url' => ''], // set breadcrumb parent
        ]; // set breadcrumb
        $data['data_menu'] = $menuModel->findAll(); // mengambil data Menu
        
        return view('Admin/Menu/index', $data);
    }

    public function save()
    {
        $menuModel = new menuModel(); // membuat objek model Menu
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_menu' => [
                'rules' => 'required|is_unique[menu.nama_menu]',
                'errors' => [
                    'required' => 'Nama Menu harus diisi',
                    'is_unique' => 'Nama Menu sudah ada',
                ],
            ],
            'ketegori_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Menu harus diisi',
                ]
            ],
            'harga_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga Menu harus diisi',
                ],
            ],
            'stok_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok Menu harus diisi',
                ],
            ],
            'ket_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Menu harus diisi',
                ],
            ],
            'foto_menu' => [
                'rules' => 'uploaded[foto_menu]|is_image[foto_menu]|mime_in[foto_menu,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'is_image' => 'Pilih gambar terlebih dahulu',
                    'mime_in' => 'Pilih gambar terlebih dahulu',
                ]
            ]
        ]);

        if (!$validation->run($this->request->getPost())) {
            session()->setFlashdata('errors', 'Data Menu gagal disimpan.');
            return redirect()->to('/Menu')->withInput();
        }

        $foto_menu = $this->request->getFile('foto_menu'); // mengambil file menu
        if($foto_menu->getError() == 4) { // jika tidak ada file menu yang diupload
            $newName = ''; // set nama file menu
        } else {
            $newName = $foto_menu->getRandomName(); // generate nama file random
            $foto_menu->move('Assets/img/foto_menu', $newName); // pindahkan file menu ke folder lampiran_menu_keluar
        }

        $id_menu = 'MN-' . Uuid::uuid4()->toString();
        $datas=[
            'id_menu' => $id_menu,
            'nama_menu' => $this->request->getPost('nama_menu'),
            'ketegori_menu' => $this->request->getPost('ketegori_menu'),
            'ket_menu' => $this->request->getPost('ket_menu'),
            'harga_menu' => $this->request->getPost('harga_menu'),
            'stok_menu' => $this->request->getPost('stok_menu'),
            'status_menu' => $this->request->getPost('status_menu'),
            'foto_menu' => $newName
        ];
        // dd($datas);

        $menuModel->insert($datas);

        session()->setFlashdata('success', 'Data Menu berhasil disimpan.');
        return redirect()->to('/Menu');
    }

    public function update(){
        $menuModel = new menuModel(); // membuat objek model Menu
        $validation = \Config\Services::validation();
        
        $id_menu = $this->request->getPost('id_menu');

        $validation->setRules([
            'nama_menu' => [
                'rules' => 'required|is_unique[toping.nama_toping,id_toping,'.$id_toping.']',
                'errors' => [
                    'required' => 'Nama Menu harus diisi',
                ],
            ],
            'kategori_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Menu harus diisi',
                ]
            ],
            'harga_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga Menu harus diisi',
                ],
            ],
            'stok_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok Menu harus diisi',
                ],
            ],
            'ket_menu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Menu harus diisi',
                ],
            ],
        ]);

        if (!$validation->run($this->request->getPost())) {
            session()->setFlashdata('errors', 'Data Menu gagal diubah.');
            return redirect()->to('/Menu')->withInput();
        }

        $data_menu = $menuModel->find($id_menu);
        // check apakah ada upload foto_menu 
        // dd($data_menu);
        $foto_menu = $this->request->getFile('foto_menu'); // mengambil file menu
        
        if($foto_menu->getError() == 4) { // jika tidak ada file menu yang diupload
            $newName = $data_menu['foto_menu']; // set nama file menu
        } else {
            // check apakah ada file gambar lama
            if($data_menu['foto_menu'] != '') {
                // hapus file gambar lama
                unlink('Assets/img/foto_menu/' . $data_menu['foto_menu']);
            }
            $newName = $foto_menu->getRandomName(); // generate nama file random
            $foto_menu->move('Assets/img/foto_menu', $newName); // pindahkan file menu ke folder lampiran_menu_keluar
        }
        
        $datas = [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'ketegori_menu' => $this->request->getPost('ketegori_menu'),
            'ket_menu' => $this->request->getPost('ket_menu'),
            'harga_menu' => $this->request->getPost('harga_menu'),
            'stok_menu' => $this->request->getPost('stok_menu'),
            'foto_menu' => $newName,
            'status_menu' => $this->request->getPost('status_menu'),
        ];
        
        $menuModel->update($id_menu, $datas);
        session()->setFlashdata('success', 'Data Menu berhasil diubah.');
        return redirect()->to('/Menu');
    }

    public function delete($id_menu)
    {
        $menuModel = new menuModel(); // membuat objek model Menu
        $menuModel->where('id_menu', $id_menu)->delete();
        session()->setFlashdata('success', 'Data Menu berhasil dihapus.');
        return redirect()->to('/Menu');
    }

}