<?php 
namespace App\Controllers;

use App\Models\topingModel;
use Ramsey\Uuid\Uuid;

class Toping extends BaseController
{
    public function index() // menampilkan data toping
    {
        $topingModel = new topingModel();  // membuat objek model toping
        $data['title'] = 'Daftar Toping'; // set judul halaman
        $data['active'] = 'Toping'; // set active toping
        $data['validation'] = \Config\Services::validation();
        $data['breadcrumb'] = [
            ['label' => 'Toping', 'url' => '/'], // set breadcrumb home
            ['label' => '/ Data Toping', 'url' => ''], // set breadcrumb parent
        ]; // set breadcrumb
        $data['data_toping'] = $topingModel->findAll(); // mengambil data toping
        
        return view('Admin/Toping/index', $data);
    }

    public function save()
    {
        $topingModel = new topingModel(); // membuat objek model toping
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_toping' => [
                'rules' => 'required|is_unique[toping.nama_toping]',
                'errors' => [
                    'required' => 'Nama toping harus diisi',
                    'is_unique' => 'Nama toping sudah ada',
                ],
            ],
            'kategori_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori toping harus diisi',
                ]
            ],
            'harga_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga toping harus diisi',
                ],
            ],
            'satuan_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok toping harus diisi',
                ],
            ],
            'ket_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan toping harus diisi',
                ],
            ],
            'foto_toping' => [
                'rules' => 'uploaded[foto_toping]|is_image[foto_toping]|mime_in[foto_toping,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu',
                    'is_image' => 'Pilih gambar terlebih dahulu',
                    'mime_in' => 'Pilih gambar terlebih dahulu',
                ]
            ]
        ]);

        if (!$validation->run($this->request->getPost())) {
            // dd($validation->getErrors());
            session()->setFlashdata('errors', 'Data toping gagal disimpan.');
            return redirect()->to('/Toping')->withInput();
        }

        $foto_toping = $this->request->getFile('foto_toping'); // mengambil file toping
        if($foto_toping->getError() == 4) { // jika tidak ada file toping yang diupload
            $newName = ''; // set nama file toping
        } else {
            $newName = $foto_toping->getRandomName(); // generate nama file random
            $foto_toping->move('Assets/img/foto_toping', $newName); // pindahkan file toping ke folder lampiran_toping_keluar
        }

        $id_toping = 'TP-' . Uuid::uuid4()->toString();
        $datas=[
            'id_toping' => $id_toping,
            'nama_toping' => $this->request->getPost('nama_toping'),
            'ketegori_toping' => $this->request->getPost('ketegori_toping'),
            'ket_toping' => $this->request->getPost('ket_toping'),
            'harga_toping' => $this->request->getPost('harga_toping'),
            'satuan_toping' => $this->request->getPost('satuan_toping'),
            'status_toping' => $this->request->getPost('status_toping'),
            'foto_toping' => $newName
        ];
        // dd($datas);

        $topingModel->insert($datas);

        session()->setFlashdata('success', 'Data toping berhasil disimpan.');
        return redirect()->to('/Toping');
    }

    public function update(){
        $topingModel = new topingModel(); // membuat objek model toping
        $validation = \Config\Services::validation();
       
        $validation->setRules([
            'nama_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama toping harus diisi',
                ],
            ],
            'kategori_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori toping harus diisi',
                ]
            ],
            'harga_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga toping harus diisi',
                ],
            ],
            'satuan_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok toping harus diisi',
                ],
            ],
            'ket_toping' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan toping harus diisi',
                ],
            ],
        ]);

        if (!$validation->run($this->request->getPost())) {
            session()->setFlashdata('errors', 'Data toping gagal diubah.');
            return redirect()->to('/Toping')->withInput();
        }

        $id_toping = $this->request->getPost('id_toping');
        $data_toping = $topingModel->find($id_toping);
        // check apakah ada upload foto_toping 
        // dd($data_toping);
        $foto_toping = $this->request->getFile('foto_toping'); // mengambil file toping
        
        if($foto_toping->getError() == 4) { // jika tidak ada file toping yang diupload
            $newName = $data_toping['foto_toping']; // set nama file toping
        } else {
            // check apakah ada file gambar lama
            if($data_toping['foto_toping'] != '') {
                // hapus file gambar lama
                unlink('Assets/img/foto_toping/' . $data_toping['foto_toping']);
            }
            $newName = $foto_toping->getRandomName(); // generate nama file random
            $foto_toping->move('Assets/img/foto_toping', $newName); // pindahkan file toping ke folder lampiran_toping_keluar
        }
        
        $datas = [
            'nama_toping' => $this->request->getPost('nama_toping'),
            'ketegori_toping' => $this->request->getPost('ketegori_toping'),
            'ket_toping' => $this->request->getPost('ket_toping'),
            'harga_toping' => $this->request->getPost('harga_toping'),
            'satuan_toping' => $this->request->getPost('satuan_toping'),
            'foto_toping' => $newName,
            'status_toping' => $this->request->getPost('status_menu'),
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