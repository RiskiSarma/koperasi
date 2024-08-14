<?php
// Ganti dengan detail koneksi Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kopsyah";

// Membuat koneksi
$con = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi    
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Menggunakan mysqli_real_escape_string setelah memastikan koneksi
$id_pembiayaan = mysqli_real_escape_string($con, $_GET['id_pembiayaan']);

// Mengambil data dari database
$sql = mysqli_query($con, "SELECT a.id_pembiayaan, b.nama AS nama_anggota, c.nama AS nama_perkiraan, a.total_bayar, a.bayar_perbulan 
                           FROM pembiayaan_anggota a
                           INNER JOIN anggota b ON a.id_anggota = b.id_anggota
                           INNER JOIN akun_perkiraan c ON a.id_perkiraan = c.id_perkiraan
                           WHERE a.id_pembiayaan = '$id_pembiayaan'")
    or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);

if (!$data) {
    die("Data tidak ditemukan.");
}

$sql3 = mysqli_query($con, "SELECT SUM(setor_bayar) AS setor_bayar 
                            FROM tr_pembiayaan_anggota 
                            WHERE id_pembiayaan = '$id_pembiayaan'")
    or die(mysqli_error($con));
$data3 = mysqli_fetch_array($sql3);
$setor_bayar = $data3['setor_bayar'] ?? 0; // Gunakan 0 jika hasilnya NULL
$sisa = $data['total_bayar'] - $setor_bayar;

$perbulan = $data['bayar_perbulan'];
?>
<h3><i class="fa fa-angle-right"></i> Setor Angsuran Pembiayaan</h3>
<!-- BASIC FORM ELEMENTS -->
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Setor Angsuran</h4>
            <form class="form-horizontal style-form" method="post" name="fform">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">No. Rek</label>
                    <div class="col-sm-10">
                        <input type="text" name="id_pembiayaan" value="<?php echo $data['id_pembiayaan'] ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $data['nama_anggota'] ?>" class="form-control" readonly>
                        <input type="hidden" name="id_anggota" value="<?php echo $data['nama_anggota'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jenis Pembiayaan</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id_perkiraan" class="form-control" value="<?php echo $data['nama_perkiraan'] ?>" readonly>
                        <input type="text" class="form-control" value="<?php echo $data['nama_perkiraan'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Sisa</label>
                    <div class="col-sm-10">
                        <input type="text" name="sisa1" id="sisa1" value="<?php echo number_format($sisa, 2) ?>" readonly class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jumlah Setor</label>
                    <div class="col-sm-10">
                        <input type="text" id="setor_bayar" name="setor_bayar" min="0" class="form-control" onkeyup="parsing()" required>
                        <small class="text-info">*Jumlah setoran Rp. <?php echo number_format($perbulan, 3) ?></small>
                    </div>
                </div>
                <input type="hidden" id="sisa2" name="sisa2" value="<?php echo $sisa ?>" class="form-control" readonly>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Keterangan Setor</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="keterangan_setor" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tgl Setor</label>
                    <div class="col-sm-10">
                        <input type="date" name="tgl_bayar" class="form-control" required>
                    </div>
                </div>
                <div class="form-group" style="margin-left: 5px">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <a href="?Page=PembiayaanAnggota" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
    </div><!-- col-lg-12-->
</div><!-- /row -->

<script>
    function parsing() {
        var bil1 = parseFloat(document.fform.sisa1.value);
        if (isNaN(bil1))
            bil1 = 0.0;
        var bil2 = parseFloat(document.fform.setor_bayar.value);
        if (isNaN(bil2))
            bil2 = 0.0;
        var hasil = bil1 - bil2;
        document.getElementById('sisa2').value = hasil.toFixed(2);
    }
</script>

<?php
if (isset($_POST['simpan'])) {
    $id_pembiayaan = mysqli_real_escape_string($con, $_POST['id_pembiayaan']);
    $id_anggota = mysqli_real_escape_string($con, $_POST['id_anggota']);
    $setor_bayar = mysqli_real_escape_string($con, $_POST['setor_bayar']);
    $keterangan_setor = mysqli_real_escape_string($con, $_POST['keterangan_setor']);
    $id_perkiraan = mysqli_real_escape_string($con, $_POST['id_perkiraan']);
    $tgl_bayar = mysqli_real_escape_string($con, $_POST['tgl_bayar']);
    $sisa2 = mysqli_real_escape_string($con, $_POST['sisa2']);

    $sql_anggota = mysqli_query($con, "SELECT nama FROM anggota WHERE id_anggota = '$id_anggota'");
    $data_anggota = mysqli_fetch_array($sql_anggota);
    $nama_anggota = $data_anggota['nama'] ?? 0;

    $sql_pembiayaan = mysqli_query($con, "SELECT bayar_perbulan FROM pembiayaan_anggota WHERE id_pembiayaan = '$id_pembiayaan'");
    $data_pembiayaan = mysqli_fetch_array($sql_pembiayaan);
    $perbulan = $data_pembiayaan['bayar_perbulan'];

    // Validasi nilai setor_bayar agar tidak melebihi batas maksimum
    if ($setor_bayar > $perbulan) {
        echo "
            <script language='javascript'>
                window.alert('Setoran tidak boleh melebihi $perbulan');
                window.history.go(-1);
            </script>
        ";
        exit(); // stop execution
    }

    mysqli_query($con, "INSERT INTO tr_pembiayaan_anggota (id_tr_pembiayaan, id_pembiayaan, id_anggota, setor_bayar, keterangan_setor, tgl_bayar) 
                        VALUES (null, '$id_pembiayaan', '$id_anggota', '$setor_bayar', '$keterangan_setor', '$tgl_bayar')")
        or die(mysqli_error($con));
    echo "<script>alert('Setor Angsuran Berhasil.');
        window.location.href='?Page=PembiayaanAnggota';
        </script>";
}
?>
