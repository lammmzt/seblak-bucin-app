<?= $this->extend('Template/index') ?>
<?= $this->section('content') ?>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="header-title">
                <h4 class="card-title">Tambah Pengadaan</h4>
            </div>

            <div class="header-title">
                <a href="<?= base_url('Pengadaan'); ?>" class="btn btn-primary btn-md align-items-center float-end">
                    Kembali
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

            <form method="POST" enctype="multipart/form-data" class="mx-3">
                <?= csrf_field(); ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="judul_pengadaan_toping" class="form-label">Judul Pengadaan</label>
                            <input type="text" class="form-control" id="judul_pengadaan_toping"
                                name="judul_pengadaan_toping" value="<?= old('judul_pengadaan_toping'); ?>"
                                placeholder="Masukkan Judul Pengadaan" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="ket_pengadaan_toping" class="form-label">Keterangan Pengadaan</label>
                            <textarea class="form-control" id="ket_pengadaan_toping" name="ket_pengadaan_toping"
                                placeholder="Masukkan Keterangan Pengadaan" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="id_toping" class="form-label">Nama Toping</label>
                            <select class="form-select select2" id="id_toping" name="id_toping" required
                                style="width: 100%;">
                                <option selected disabled value="">Pilih Toping</option>
                                <?php foreach ($toping as $t) : ?>
                                <option value="<?= $t['id_toping']; ?>" data-harga="<?= $t['harga_toping']; ?>">
                                    <?= $t['nama_toping']; ?> @
                                    <?= $t['satuan_toping']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="btn btn-primary my-2" id="tambah_toping">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr class="my-2">
                <div class="table-responsive">
                    <table class="table table-striped table-responsive-sm text-black-50">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Toping</th>
                                <th>Exp toping</th>
                                <th>Harga Pengadaan</th>
                                <th>Harga Jual</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabel_pengadaan_toping">

                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary btn-md" id="btn_simpan">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>
<?= $this->section('script') ?>
<script type="text/javascript">
var data_toping = [];
var total = 0;
// tambah toping
function tampiltoping() {
    var html = '';
    var no = 1;
    total = 0; // reset total
    // console.log(data_toping);
    if (data_toping.length > 0) { // jika ada data toping
        data_toping.forEach(function(item) { // tampilkan data toping
            html += '<tr>';
            html += '<td class="text-center">' + no + '</td>';
            html += '<td>' + item.nama_toping + '</td>';
            html += '<td> <input type="date" name="exp_toping[]" class="form-control" value="' + item
                .exp_toping +
                '" min="<?= date('Y-m-d'); ?>"> </td>';
            html += '<td> <input type="number" name="harga[]" class="form-control" min="1" value="' + item
                .harga +
                '" > </td>';
            html +=
                '<td> <input type="number" name="harga_jual[]" class="form-control harga_jual" min="1" value="' +
                item
                .harga_jual +
                '" > </td>';
            html +=
                '<td> <input type="number" name="jumlah[]" class="form-control text-center" min="1" style="max-width: 100px;" value="' +
                item
                .jumlah +
                '" > </td>';
            html += '<td> <input type="text" name="subtotal[]" class="form-control" value="' + formatRupiah(item
                    .subtotal) +
                '" readonly> </td>';
            html += '<td><button type="button" class="btn btn-danger btn-sm" onclick="hapusToping(' + no +
                ')"><i class="bi bi-trash"></i></button></td>';
            no++;
            html += '</tr>';

            total += item.subtotal;
        });

        html += '<tr>';
        html += '<td colspan="7" class="text-right">Total</td>';
        html += '<td><input type="text" name="total_pengadaan_toping" class="form-control" value="' + formatRupiah(
                total) +
            '" readonly></td>';
        html += '<td></td>';
        html += '</tr>';
    } else { // jika tidak ada data toping
        html += '<tr>';
        html += '<td colspan="9" class="text-center">Tidak ada data</td>';
        html += '</tr>';
    }

    $('#tabel_pengadaan_toping').html(html);
}

tampiltoping(); // tampilkan toping

// tambah toping
$('#tambah_toping').on('click', function() {
    // alert('tambah toping');
    var id_toping = $('#id_toping').val();
    var nama_toping = $('#id_toping option:selected').text();
    var harga = $('#id_toping option:selected').data('harga');
    var harga_jual = harga;
    var jumlah = 1;
    var subtotal = harga * jumlah;

    if (id_toping == '') { // jika toping belum dipilih
        alert('Pilih toping');
        return false;
    }

    // jika toping sudah ada
    var index = data_toping.findIndex(x => x.id_toping == id_toping);

    if (index == -1) { // jika toping belum ada
        data_toping.push({
            id_toping: id_toping,
            nama_toping: nama_toping,
            exp_toping: '',
            harga: harga,
            harga_jual: harga_jual,
            jumlah: jumlah,
            subtotal: subtotal
        });
    } else { // jika toping sudah ada
        data_toping[index].jumlah += 1;
        data_toping[index].subtotal = data_toping[index].jumlah * data_toping[index].harga;
    }

    tampiltoping(); // tampilkan toping
});

// ubah jumlah toping
$('#tabel_pengadaan_toping').on('change', 'input[name="jumlah[]"]', function() {
    // alert('ubah jumlah toping');
    var index = $(this).closest('tr').index(); // index baris
    var jumlah = $(this).val(); // jumlah toping
    var harga = data_toping[index].harga; // harga toping
    var subtotal = jumlah * harga; // subtotal

    data_toping[index].jumlah = jumlah; // ubah jumlah toping
    data_toping[index].subtotal = subtotal; // ubah subtotal toping

    total = 0; // reset total
    tampiltoping(); // tampilkan toping
});

// ubah harga toping
$('#tabel_pengadaan_toping').on('change', 'input[name="harga[]"]', function() {
    // alert('ubah harga toping');
    var index = $(this).closest('tr').index(); // index baris
    var harga = $(this).val(); // harga toping
    var jumlah = data_toping[index].jumlah; // jumlah toping
    var subtotal = jumlah * harga; // subtotal

    data_toping[index].harga = harga; // ubah harga toping
    data_toping[index].subtotal = subtotal; // ubah subtotal toping

    tampiltoping(); // tampilkan toping
});

// ubah tanggal exp toping
$('#tabel_pengadaan_toping').on('change', 'input[name="exp_toping[]"]', function() {
    // alert('ubah exp toping');
    var index = $(this).closest('tr').index(); // index baris
    var exp_toping = $(this).val(); // tanggal exp toping

    data_toping[index].exp_toping = exp_toping; // ubah tanggal exp toping
    console.log(data_toping);
    tampiltoping(); // tampilkan toping
});


// change persen jual
$('#tabel_pengadaan_toping').on('change', 'input[name="harga_jual[]"]', function() {
    // alert('ubah persen jual');
    var index = $(this).closest('tr').index(); // index baris
    var harga_jual = $(this).val(); // persen jual
    data_toping[index].harga_jual = harga_jual; // ubah persen jual
    tampiltoping(); // tampilkan toping
})
// hapus toping
function hapusToping(index) {
    // alert('hapus toping ' + index);
    data_toping.splice(index - 1, 1);
    total = 0; // reset total
    tampiltoping(); // tampilkan toping
}


// simpan data
$('form').submit(function() {
    // alert('submit');
    if (data_toping.length == 0) { // jika tidak ada data toping
        alert('Pilih toping');
        return false;
    }

    var exp_toping = data_toping.filter(x => x.exp_toping == '');
    if (exp_toping.length > 0) {
        alert('Isi tanggal kadaluarsa toping yang belum diisi');
        return false;
    }

    // ubah btn simpan to loading
    $('#btn_simpan').html('<i class="bi bi-hourglass-split"></i> Loading...');
    $('#btn_simpan').attr('disabled', true);

    var form_data = $(this).serializeArray(); // ambil semua data form
    form_data.push({ // tambahkan total transaksi
        name: 'total_pengadaan_toping',
        value: total
    });

    form_data.push({ // tambahkan data toping
        name: 'data_toping',
        value: JSON.stringify(data_toping)
    });
    console.log(form_data);
    $.ajax({
        url: '<?= base_url('Pengadaan/save'); ?>',
        type: 'post',
        data: form_data,
        dataType: 'json',
        success: function(hasil) {
            if (hasil.status == 200) {
                location.href = '<?= base_url('Pengadaan'); ?>';
                // console.log(hasil.data);
            } else {
                alert(hasil.pesan);
                $('#btn_simpan').html('Simpan');
                $('#btn_simpan').attr('disabled', false);
            }
        }
    });

    return false;
});
</script>
<?= $this->endSection('script'); ?>