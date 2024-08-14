<?php 
// Ganti dengan detail koneksi Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kopsyah";

// Membuat koneksi
$con = new mysqli($servername, $username, $password, $dbname);

// Check if $con is successfully created
if ($con->connect_error) {
    die("Database connection failed: " . $con->connect_error);
}

// Check if the 'id' parameter is set
$id = isset($_GET['id']) ? $con->real_escape_string($_GET['id']) : '';
$id_pembiayaan = isset($_GET['id_pembiayaan']) ? $con->real_escape_string($_GET['id_pembiayaan']) : '';
// Misalnya, jika Anda ingin mendapatkan data admin berdasarkan id_akses
$id_akses = $_SESSION['id_akses']; // Atau parameter lain yang Anda gunakan untuk menentukan admin
$QryAksesTransaksi = mysqli_query($con, "SELECT * FROM akses WHERE id_akses='$id_akses'") or die($con->error);
$DataAksesTransaksi = mysqli_fetch_array($QryAksesTransaksi);
$NamaAksesTransaksi = $DataAksesTransaksi['nama_akses'] ?? 'Data admin tidak ditemukan';


// Query untuk mendapatkan data pembiayaan anggota dan anggota terkait
$sql1 = $con->query("
    SELECT b.nama AS nama_anggota, c.nama AS nama_akun_perkiraan, c.jenis_akun, a.total_bayar, a.jumlah_pembiayaan
    FROM pembiayaan_anggota a 
    INNER JOIN anggota b ON a.id_anggota = b.id_anggota 
    INNER JOIN akun_perkiraan c ON a.id_perkiraan = c.id_perkiraan 
    WHERE a.id_pembiayaan = '$id_pembiayaan'
") or die($con->error);
$data1 = $sql1->fetch_assoc();

// Query untuk mendapatkan data transaksi pembiayaan anggota dan data terkait lainnya
$sql = $con->query("
    SELECT a.tgl_bayar, a.setor_bayar
    FROM tr_pembiayaan_anggota a 
    WHERE a.id_pembiayaan = '$id_pembiayaan'
") or die($con->error);
$data = $sql->fetch_assoc();

// Data yang harus ditampilkan
$nama_anggota = $data1['nama_anggota'] ?? "Data tidak tersedia";
$jenis_pembiayaan = $data1['nama_akun_perkiraan'] ?? "Data tidak tersedia";
$total_bayar = $data1['total_bayar'] ?? 0;
$tgl_setor = isset($data['tgl_bayar']) ? date('d-m-Y', strtotime($data['tgl_bayar'])) : "Data tidak tersedia";
$setor_bulan = isset($data['tgl_bayar']) ? date('F Y', strtotime($data['tgl_bayar'])) : "Data tidak tersedia";
$jumlah_pembiayaan = $data1['jumlah_pembiayaan'] ?? 0;

// // Query for admin
// $admin = $con->query("SELECT * FROM akses WHERE nama_akses = '$username'") or die($con->error);
// $dataadmin = $admin->fetch_assoc();

// Query for setor_bayar
$sql2 = $con->query("SELECT SUM(setor_bayar) AS setor_bayar FROM tr_pembiayaan_anggota 
    WHERE id_pembiayaan = '$id_pembiayaan'") or die($con->error);
$data2 = $sql2->fetch_assoc();
$setor_bayar = $data2['setor_bayar'] ?? 0;
$sisa = $jumlah_pembiayaan - $setor_bayar;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kwitansi</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #footer {
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <h4>Kwitansi Bukti Setoran Pembiayaan <br><?php echo htmlspecialchars($data1['nama_akun_perkiraan'] ?? 'Data tidak tersedia', ENT_QUOTES, 'UTF-8') ?></h4>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($nama_anggota, ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Pembiayaan</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($jenis_pembiayaan, ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Bayar</td>
                        <td>:</td>
                        <td><?php echo 'Rp. ' . number_format($total_bayar, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Tgl Setor</td>
                        <td>:</td>
                        <td><?php echo $tgl_setor ?></td>
                    </tr>
                    <tr>
                        <td>Setoran Bulan</td>
                        <td>:</td>
                        <td><?php echo $setor_bulan ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Pembiayaan</td>
                        <td>:</td>
                        <td><?php echo 'Rp. ' . number_format($jumlah_pembiayaan, 2) ?></td>
                    </tr>
                    <tr>
                        <td>Sisa</td>
                        <td>:</td>
                        <td><?php echo 'Rp. ' . number_format($sisa, 2) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        Banda Aceh, <?php echo date('d-m-Y'); ?>
        <?php if (isset($NamaAksesTransaksi)): ?>
        <div class="col-sm-8">
            <div class="invoice-title">
                <h4>Kwitansi Pembiayaan</h4>
            </div>
            <br><br><br><br>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <b><?php echo htmlspecialchars($NamaAksesTransaksi, ENT_QUOTES, 'UTF-8'); ?></b><br>
                    Administrator Koperasi Syariah HW
                </div>            
            </div>
        </div>
        <?php else: ?>
        <p>Data admin tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</div>

    </div>
    <script>
        window.print();
    </script>
</body>
</html>
