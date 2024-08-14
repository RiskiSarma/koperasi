<?php
// Pastikan koneksi database didefinisikan
$host = "localhost"; // Ganti dengan host database Anda
$username = "root";  // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$database = "kopsyah"; // Ganti dengan nama database Anda

// Buat koneksi ke database
$con = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Pastikan $id_pembiayaan didefinisikan dan aman
$id_pembiayaan = mysqli_real_escape_string($con, $_GET['id_pembiayaan']); // Asumsi $id_pembiayaan datang dari parameter GET
$sql = mysqli_query($con, "SELECT * FROM tr_pembiayaan_anggota a INNER JOIN pembiayaan_anggota b ON a.id_pembiayaan = b.id_pembiayaan INNER JOIN anggota c ON b.id_anggota = c.id_anggota WHERE a.id_pembiayaan = '$id_pembiayaan'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>
<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="path/to/your/custom/styles.css">
</head>

<h3><i class="fa fa-angle-right"></i> Detail Transaksi Setor Angsuran Pembiayaan</h3>
<table class="table">
    <tr>
        <td>Nama </td>
        <td>:</td>
        <td><?php echo isset($data['nama']) ? $data['nama'] : 'Data tidak ditemukan'; ?></td>
    </tr>
    <tr>
        <td>Id. Pembiayaan</td>
        <td>:</td>
        <td><?php echo isset($data['id_pembiayaan']) ? $data['id_pembiayaan'] : 'Data tidak ditemukan'; ?></td>
    </tr>
</table>
<!-- BASIC FORM ELEMENTS -->
<hr>
<div class="row mt">
    <div class="col-lg-12">
        <table class="table table-striped" id="Datatables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th class="text-right">Jumlah Setor</th>
                    <th>Tgl Transaksi</th>
                    <th>Cetak Kwitansi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($con, "SELECT * FROM tr_pembiayaan_anggota a INNER JOIN pembiayaan_anggota b ON a.id_pembiayaan = b.id_pembiayaan WHERE a.id_pembiayaan = '$id_pembiayaan' ORDER BY tgl_bayar DESC") or die(mysqli_error($con));
                while ($data = mysqli_fetch_array($sql)) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo isset($data['keterangan_setor']) ? $data['keterangan_setor'] : 'Data tidak ditemukan'; ?></td>
                        <td class="text-right"><?php echo isset($data['setor_bayar']) ? 'Rp.' . number_format($data['setor_bayar'], 0) : 'Data tidak ditemukan'; ?></td>
                        <td><?php echo isset($data['tgl_bayar']) ? date('d-m-Y', strtotime($data['tgl_bayar'])) : 'Data tidak ditemukan'; ?></td>
                        <td><a href="?Page=PembiayaanAnggota&Sub=cetak&id_pembiayaan=<?php echo $data['id_pembiayaan']; ?>" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><!-- col-lg-12-->
</div><!-- /row -->
<div class="row mt-2 text-right" style="margin-right: 5px;">
    <a href="?Page=PembiayaanAnggota&Sub=DetailPembiayaanAnggota&id_pembiayaan=<?php echo $id_pembiayaan; ?>" class="btn btn-warning">Kembali</a>
</div>