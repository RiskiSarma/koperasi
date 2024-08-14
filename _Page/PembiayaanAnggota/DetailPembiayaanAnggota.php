<?php
// Pastikan koneksi database didefinisikan
$host = "localhost";
$username = "root";
$password = "";
$database = "kopsyah";

// Buat koneksi ke database
$con = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Pastikan $id_pembiayaan didefinisikan dan aman
$id_pembiayaan = mysqli_real_escape_string($con, $_GET['id_pembiayaan']);

// Query SQL untuk mengambil data pembiayaan dan anggota
$sql = mysqli_query($con, "SELECT a.*, b.nama AS nama_anggota, c.nama AS nama_akun
    FROM pembiayaan_anggota a
    INNER JOIN anggota b ON a.id_anggota = b.id_anggota
    INNER JOIN akun_perkiraan c ON a.id_perkiraan = c.id_perkiraan
    WHERE a.id_pembiayaan = '$id_pembiayaan'") or die(mysqli_error($con));

$data = mysqli_fetch_array($sql);

// Query SQL untuk menghitung total bayar yang telah dilakukan
$sql2 = mysqli_query($con, "SELECT SUM(setor_bayar) as total_bayar FROM tr_pembiayaan_anggota WHERE id_pembiayaan = '$id_pembiayaan'") or die(mysqli_error($con));
$data2 = mysqli_fetch_array($sql2);

$setor_bayar = $data2['total_bayar'] ? $data2['total_bayar'] : 0; // Jika total_bayar kosong, set nilai 0
$sisa = $data['total_bayar'] - $setor_bayar;

// Update status jika sudah lunas
if ($sisa <= 0) {
    $update_status = mysqli_query($con, "UPDATE pembiayaan_anggota SET status_pembiayaan = 'Lunas' WHERE id_pembiayaan = '$id_pembiayaan'");
    if (!$update_status) {
        die("Update status failed: " . mysqli_error($con));
    }
}
?>
<h3><i class="fa fa-angle-right"></i> Detail Pembiayaan</h3>
<hr>
<div class="row mt">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id Pembiayaan</th>
                    <th><?php echo $data['id_pembiayaan']; ?></th>
                </tr>
                <tr>
                    <th>Id Anggota <br> Nama Anggota</th>
                    <th><?php echo $data['id_anggota']; ?> <br> <?php echo $data['nama_anggota']; ?></th>
                </tr>
                <tr>
                    <th>Jenis Pembiayaan</th>
                    <th><?php echo $data['nama_akun']; ?></th>
                </tr>
                <tr>
                    <th>Jumlah Pembiayaan</th>
                    <th><?php echo 'Rp. ' . number_format($data['jumlah_pembiayaan'], 3); ?></th>
                </tr>
                <tr>
                    <th>Jangka Waktu</th>
                    <th><?php echo $data['jangka_waktu']; ?> Bulan</th>
                </tr>
                <tr>
                    <th>Biaya Per Bulan</th>
                    <th><?php echo 'Rp. ' . number_format($data['bayar_perbulan'], 2); ?></th>
                </tr>
                <tr>
                    <th>Total Bayar</th>
                    <th><?php echo 'Rp. ' . number_format($data['total_bayar'], 2); ?></th>
                </tr>
                <tr>
                    <th>Sisa</th>
                    <th><?php echo 'Rp. ' . number_format($sisa, 2); ?> <small> <a href="?Page=PembiayaanAnggota&Sub=detail&id_pembiayaan=<?php echo $data['id_pembiayaan']; ?>">Detail Transaksi</a></small></th>
                </tr>
                <tr>
                    <th>Tgl Pembiayaan <br> Tgl Selesai</th>
                    <th><?php echo date('d-m-Y', strtotime($data['tgl_pembiayaan'])); ?><br><?php echo date('d-m-Y', strtotime($data['tgl_selesai'])); ?></th>
                </tr>
                <tr>
                    <th>Status</th>
                    <?php if ($data['status_pembiayaan'] == "Lunas") { ?>
                        <th><span class="label label-success">Lunas</span></th>
                    <?php } else { ?>
                        <th><span class="label label-danger">Belum Lunas</span></th>
                    <?php } ?>
                </tr>
            </thead>
        </table>
    </div><!-- col-lg-12-->
</div><!-- /row -->
<div class="row mt-2 text-right" style="margin-right: 5px;">
    <a href="index.php?Page=PembiayaanAnggota" class="btn btn-warning">Kembali</a>
</div>
