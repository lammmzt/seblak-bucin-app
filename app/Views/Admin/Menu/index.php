<?= $this->extend('Template/index') ?>
<?= $this->section('content') ?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h4 class="card-title">Daftar Menu</h4>
            </div>

            <div class="header-title">
                <a href="#" class="btn btn-primary btn-md align-items-center float-end" data-bs-toggle="modal"
                    data-bs-target="#addmenus">
                    Tambah Menu
                </a>
            </div>
        </div>
        <div class="card-body px-0">

            <div class="bd-example mx-3">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>

                <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#check-circle-fill" />
                    </svg>
                    <div>
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        <?= session()->getFlashdata('errors'); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="table-responsive">
                <table id="menu-user-table" class="table table-striped data_tables py-2" role="grid"
                    data-bs-toggle="data-table">
                    <thead>
                        <tr class="ligth">
                            <th>#</th>
                            <th>Foto</th>
                            <th>Ketegori</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th style="min-width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        ?>
                        <?php foreach($data_menu as $menu): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl position-relative">
                                        <img src="<?= base_url('Assets/img/foto_menu/'.$menu['foto_menu']); ?>"
                                            alt="Profile Image" class="w-50 border-radius-lg shadow-sm">
                                    </div>
                                </div>
                            </td>
                            <td><?= $menu['kategori_menu']; ?></td>
                            <td><?= $menu['nama_menu']; ?></td>
                            <td>Rp. <?= number_format($menu['harga_menu'], 0, ',', '.'); ?></td>
                            <td><?= $menu['stok_menu']; ?></td>
                            <td>
                                <?php if($menu['status_menu'] == '1'): ?>
                                <span class="badge bg-success p-2">Tersedia</span>
                                <?php else: ?>
                                <span class="badge bg-danger p-2">Tidak Tersedia</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="flex align-items-center list-menu-action">
                                    <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="modal" href="#"
                                        data-bs-target="#editmenus<?= $menu['id_menu']; ?>">
                                        Edit <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete"
                                        href="<?= base_url('Menu/delete/'.$menu['id_menu']); ?>">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path
                                                    d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                    stroke="currentColor" stroke-width="1 5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a> -->
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addmenus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addmenusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addmenusLabel">Tambah menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Menu/save'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="nama_menu" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                            placeholder="Masukan nama menu" required value="<?= old('nama_menu'); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="kategori_menu" class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" name="kategori_menu" required
                            id="kategori_menu">
                            <option selected>Pilih Kategori Menu</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ket_menu" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="ket_menu" name="ket_menu" rows="3" required
                            placeholder="Masukan keterangan menu"><?= old('ket_menu'); ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga_menu" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga_menu" name="harga_menu"
                            placeholder="Masukan harga menu"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            required value="<?= old('harga_menu'); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="stok_menu" class="form-label">Stok</label>
                        <input type="text" class="form-control" id="stok_menu" name="stok_menu"
                            placeholder="Masukan harga menu"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            required value="<?= old('stok_menu'); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status_menu" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status_menu" required
                            id="status_menu">
                            <option selected>Pilih Status Menu</option>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="foto_menu" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="foto_menu" name="foto_menu" required>
                    </div>

                    <div class="text-start mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit -->
<?php foreach($data_menu as $menu): ?>
<div class="modal fade" id="editmenus<?= $menu['id_menu']; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="editmenusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editmenusLabel">Edit menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Menu/update'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_menu" value="<?= $menu['id_menu']; ?>">
                    <div class="form-group mb-3">
                        <label for="nama_menu" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                            placeholder="Masukan nama menu" required value="<?= $menu['nama_menu']; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="kategori_menu" class="form-label">Kategori</label>
                        <select class="form-select" aria-label="Default select example" name="kategori_menu" required
                            id="kategori_menu">
                            <option selected>Pilih Kategori Menu</option>
                            <option value="Makanan" <?= $menu['kategori_menu'] == 'Makanan' ? 'selected' : ''; ?>>
                                Makanan</option>
                            <option value="Minuman" <?= $menu['kategori_menu'] == 'Minuman' ? 'selected' : ''; ?>>
                                Minuman</option>
                            <option value="Snack" <?= $menu['kategori_menu'] == 'Snack' ? 'selected' : ''; ?>>Snack
                            </option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ket_menu" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="ket_menu" name="ket_menu" rows="3" required
                            placeholder="Masukan keterangan menu"><?= $menu['ket_menu']; ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="harga_menu" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga_menu" name="harga_menu"
                            placeholder="Masukan harga menu"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            required value="<?= $menu['harga_menu']; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="stok_menu" class="form-label">Stok</label>
                        <input type="text" class="form-control" id="stok_menu" name="stok_menu"
                            placeholder="Masukan harga menu"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                            required value="<?= $menu['stok_menu']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status_menu" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="status_menu" required
                            id="status_menu">
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="foto_menu" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="foto_menu" name="foto_menu">
                    </div>


                    <div class="text-start mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>


<?= $this->endSection('content'); ?>