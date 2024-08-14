<?php
// Koneksi database
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
?>

<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h1 class="text-center">Anggota yang belum Lunas Pembiayaan</h1>
            <table class="table table-bordered table-striped" id="Datatables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Anggota</th>
                        <th>Nama</th>
                        <th>Jenis Pembiayaan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                // Query untuk mengambil data anggota yang belum lunas
                $sql_simpanan = mysqli_query($con, 
                    "SELECT pembiayaan_anggota.id_pembiayaan, pembiayaan_anggota.id_anggota, anggota.nama AS nama_anggota, akun_perkiraan.nama AS nama_akun 
                     FROM pembiayaan_anggota
                     INNER JOIN anggota ON pembiayaan_anggota.id_anggota = anggota.id_anggota 
                     INNER JOIN akun_perkiraan ON pembiayaan_anggota.id_perkiraan = akun_perkiraan.id_perkiraan 
                     WHERE pembiayaan_anggota.status_pembiayaan = 'Belum Lunas'") 
                or die(mysqli_error($con));

                // Periksa apakah ada data yang ditemukan
                if (mysqli_num_rows($sql_simpanan) > 0) {
                    while($data = mysqli_fetch_array($sql_simpanan)){
                ?>
                   <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['id_anggota']; ?></td>
                        <td><?php echo $data['nama_anggota']; ?></td>
                        <td><?php echo $data['nama_akun']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-xs" href="?Page=PembiayaanAnggota&Sub=DetailPembiayaanAnggota&id_pembiayaan=<?php echo $data['id_pembiayaan'];?>" title="Detail">Detail</a> 
                        </td>
                    </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data pembiayaan yang belum lunas.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
