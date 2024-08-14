<h3><i class="fa fa-angle-right"></i> Tambah Data Pembiayaan Anggota</h3>
<!-- BASIC FORM ELEMENTS -->
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Pembiayaan Anggota</h4>
            <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Kode Pembiayaan</label>
                    <div class="col-sm-10">
                        <?php
                        // Menghubungkan ke database
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

                        // Melakukan query
                        $query = "SELECT max(id_pembiayaan) as maxKode FROM pembiayaan_anggota";
                        $hasil = mysqli_query($con, $query);

                        if (!$hasil) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        $data = mysqli_fetch_array($hasil);
                        if ($data['maxKode'] != null) {
                            $no_urut = (int) substr($data['maxKode'], 5, 3);
                            $no_urut++;
                        } else {
                            $no_urut = 1;
                        }
                        $char = "Pemb-";
                        $kode = $char . sprintf("%03s", $no_urut);

                        // Memastikan kode pembiayaan yang dihasilkan benar-benar unik
                        $kode_unik = false;
                        while (!$kode_unik) {
                            $check_query = "SELECT id_pembiayaan FROM pembiayaan_anggota WHERE id_pembiayaan = '$kode'";
                            $check_result = mysqli_query($con, $check_query);

                            if (mysqli_num_rows($check_result) > 0) {
                                // Jika kode sudah ada, tambahkan nomor urut dan coba lagi
                                $no_urut++;
                                $kode = $char . sprintf("%03s", $no_urut);
                            } else {
                                // Jika kode belum ada, keluar dari loop
                                $kode_unik = true;
                            }
                        }
                        ?>
                        <input type="text" name="id_pembiayaan" class="form-control" value="<?php echo $kode ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Anggota</label>
                    <div class="col-sm-10">
                        <select class="form-control js-example-basic-single" name="id_anggota" required>
                            <option value="">--Pilih--</option>
                            <?php
                            $anggota = mysqli_query($con, "SELECT * FROM anggota");
                            if (!$anggota) {
                                echo "Error: " . mysqli_error($con);
                            } else {
                                while ($danggota = mysqli_fetch_array($anggota)) {
                                    echo "<option value='" . $danggota['id_anggota'] . "'>" . $danggota['id_anggota'] . " - " . $danggota['nama'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                <div class="form-group">
    <label class="col-sm-2 col-sm-2 control-label">Jenis Pembiayaan</label>
    <div class="col-sm-10">
        <select class="form-control js-example-basic-single" name="id_perkiraan" required>
            <option value="">--Pilih Jenis Pembiayaan--</option>
            <?php
            // Query untuk mengambil semua data dari tabel akun_perkiraan
            $query = "SELECT * FROM akun_perkiraan WHERE jenis_akun = 'Pembiayaan'";
            $akun_perkiraan = mysqli_query($con, $query);
            
            // Periksa jika query berhasil
            if (!$akun_perkiraan) {
                echo "Error: " . mysqli_error($con);
            } else {
                // Cek apakah ada data yang ditemukan
                if (mysqli_num_rows($akun_perkiraan) > 0) {
                    // Loop untuk menampilkan data
                    while ($data = mysqli_fetch_array($akun_perkiraan)) {
                        // Menampilkan nama akun sebagai pilihan dalam dropdown
                        echo "<option value='" . $data['id_perkiraan'] . "'>" . htmlspecialchars($data['nama']) . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada akun ditemukan</option>";
                }
            }
            ?>
        </select>
    </div>
</div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jumlah Pembiayaan</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah_pembiayaan" min="50000" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jangka Waktu <small class="text-info">*Bulan</small></label>
                    <div class="col-sm-10">
                        <input type="number" name="jangka_waktu" min="1" class="form-control">
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
</div>

<?php
if (isset($_POST['simpan'])) {
    $id_anggota = mysqli_real_escape_string($con, $_POST['id_anggota']);
    $id_pembiayaan = mysqli_real_escape_string($con, $_POST['id_pembiayaan']);
    $id_perkiraan = $_POST['id_perkiraan'];

    // Mengambil data akun perkiraan
    $sql_perkiraan = mysqli_query($con, "SELECT * FROM akun_perkiraan WHERE id_perkiraan = '$id_perkiraan'");
    $data_perkiraan = mysqli_fetch_array($sql_perkiraan);
    $nama_perkiraan = $data_perkiraan['nama'];

    $sql_anggota = mysqli_query($con, "SELECT * FROM anggota WHERE id_anggota = '$id_anggota'");
    $data_anggota = mysqli_fetch_array($sql_anggota);
    $nama_anggota = $data_anggota['nama'] ?? 0;

    $jumlah_pembiayaan = mysqli_real_escape_string($con, $_POST['jumlah_pembiayaan']);
    $jangka_waktu = mysqli_real_escape_string($con, $_POST['jangka_waktu']);
    $tgl_pembiayaan = date('Y-m-d');
    $tgl_selesai = date('Y-m-d', strtotime('+' . $jangka_waktu . ' month', strtotime($tgl_pembiayaan)));

    $total_bayar = $jumlah_pembiayaan + ($jumlah_pembiayaan * 0.025);
    $totalBayar = round($total_bayar, 3);
    $bayar_perbulan = $totalBayar / $jangka_waktu;
    $bayarperbulan = round($bayar_perbulan, 3);

    // Menyimpan data pembiayaan anggota
    $query = "INSERT INTO pembiayaan_anggota (id_pembiayaan, id_anggota, id_perkiraan, jumlah_pembiayaan, jangka_waktu, tgl_pembiayaan, tgl_selesai, total_bayar, bayar_perbulan) VALUES ('$id_pembiayaan', '$id_anggota', '$id_perkiraan', '$jumlah_pembiayaan', '$jangka_waktu', '$tgl_pembiayaan', '$tgl_selesai', '$totalBayar', '$bayarperbulan')";
    $sql = mysqli_query($con, $query);

    if (!$sql) {
        die('Error: ' . mysqli_error($con));
    } else {
        echo "<script>alert('Data berhasil disimpan');window.location.href='?Page=PembiayaanAnggota';</script>";
    }
}
?>
