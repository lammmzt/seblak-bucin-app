<?= $this->extend('Template/index') ?>
<?= $this->section('content') ?>
<?php 
    use App\Models\detailPengadaanTopingModel;
    $detailModel = new detailPengadaanTopingModel();
?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h4 class="card-title">Daftar Pengadaan</h4>
            </div>

            <div class="header-title">
                <a href="<?= base_url('Pengadaan/create'); ?>"
                    class="btn btn-primary btn-md align-items-center float-end">
                    Tambah Pengadaan
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
                <table id="pengadaan-user-table" class="table table-striped data_tables py-2" role="grid"
                    data-bs-toggle="data-table">
                    <thead>
                        <tr class="ligth">
                            <th>#</th>
                            <th>Nama Penginput</th>
                            <th>Judul Pengadaan</th>
                            <th>Tanggal</th>
                            <th style="min-width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        ?>
                        <?php foreach($data_pengadaan as $pengadaan): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pengadaan['nama_user']; ?></td>
                            <td><?= $pengadaan['judul_pengadaan_toping']; ?></td>
                            <td><?= date('d F Y', strtotime($pengadaan['created_at'])); ?></td>
                            <td>
                                <div class="flex align-items-center list-pengadaan-action">
                                    <a class="btn btn-sm btn-icon btn-info" data-bs-toggle="modal" href="#"
                                        data-bs-target="#detailPengadaan<?= $pengadaan['id_pengadaan_toping']; ?>">
                                        Detail <i class="bi bi-info-circle"></i>
                                    </a>
                                    <!-- <a class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Delete"
                                        href="<?= base_url('pengadaan/delete/'.$pengadaan['id_pengadaan_toping']); ?>">
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
<!-- modal detail -->
<?php foreach($data_pengadaan as $pengadaan): ?>
<div class="modal fade" id="detailPengadaan<?= $pengadaan['id_pengadaan_toping']; ?>" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailPengadaanLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPengadaanLabel">Detail Pengadaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row py-2">
                    <div class="col-6">
                        <label for="id_pengadaan_toping" class="form-label">Kode Pengadaan</label>
                        <input type="text" class="form-control" id="id_pengadaan_toping"
                            value="<?= $pengadaan['id_pengadaan_toping']; ?>" readonly>
                    </div>
                    <div class="col-6">
                        <label for="nama_user" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama_user" value="<?= $pengadaan['nama_user']; ?>"
                            readonly>
                    </div>
                    <div class="col-6">
                        <label for="tgl_pengadaan" class="form-label">Tanggal Pengadaan</label>
                        <input type="text" class="form-control" id="tgl_pengadaan"
                            value="<?=date('d F Y', strtotime($pengadaan['created_at'])); ?>" readonly>
                    </div>
                    <div class="col-6">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" rows="3"
                            readonly><?= $pengadaan['ket_pengadaan_toping']; ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Toping</th>
                                    <th>Exp Toping</th>
                                    <th>Harga</th>
                                    <th>Harga Jual</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                               
                                $details = $detailModel->getDetailPengadaanByIdPengadaan($pengadaan['id_pengadaan_toping']);
                                $no = 1;
                                foreach($details as $detail): ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $detail['nama_toping']; ?></td>
                                    <td><?= date('d F Y', strtotime($detail['exp_detail_pengadaan_toping'])); ?></td>
                                    <td><?= number_format($detail['harga_modal_detail_pengadaan_toping'], 0, ',', '.'); ?>
                                    </td>
                                    <td><?= number_format($detail['harga_jual_detail_pengadaan_toping'], 0, ',', '.'); ?>
                                    </td>
                                    <td><?= $detail['jumlah_detail_pengadaan_toping']; ?></td>
                                    <td><?= number_format($detail['subtotal_detail_pengadaan_toping'], 0, ',', '.'); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="text-right">Total</th>
                                    <th><?= number_format($pengadaan['total_pengadaan_toping'], 0, ',', '.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection('content'); ?>