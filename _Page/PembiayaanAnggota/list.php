<?php
//koneksi dan session
ini_set("display_errors", "off");
include "../../_Config/Connection.php";
include "../../_Config/Session.php";

//Keyword_by
$keyword_by = !empty($_POST['keyword_by']) ? $_POST['keyword_by'] : "";
$keyword = !empty($_POST['keyword']) ? $_POST['keyword'] : "";
$batas = !empty($_POST['batas']) ? $_POST['batas'] : "10";
$ShortBy = !empty($_POST['ShortBy']) ? $_POST['ShortBy'] : "DESC";
$NextShort = $ShortBy == "ASC" ? "DESC" : "ASC";
$OrderBy = !empty($_POST['OrderBy']) ? $_POST['OrderBy'] : "id_transaksi";
$page = !empty($_POST['Page']) ? $_POST['Page'] : "1";
$posisi = ($page - 1) * $batas;

///Hitung jumlah data
if (empty($keyword_by)) {
    $jml_data_query = empty($keyword) ?
        "SELECT * FROM pembiayaan_anggota" :
        "SELECT * FROM pembiayaan_anggota WHERE tgl_pembiayaan LIKE '%$keyword%' OR kategori LIKE '%$keyword%' OR metode LIKE '%$keyword%' OR status LIKE '%$keyword%'";
} else {
    $jml_data_query = empty($keyword) ?
        "SELECT * FROM pembiayaan_anggota" :
        "SELECT * FROM pembiayaan_anggota WHERE $keyword_by LIKE '%$keyword%'";
}

$jml_data = mysqli_num_rows(mysqli_query($Conn, $jml_data_query));

// Koneksi database
$host = 'localhost'; // Ganti dengan host database Anda
$user = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$database = 'kopsyah'; // Ganti dengan nama database Anda
$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

$sql_pembiayaan_anggota = mysqli_query($con, "SELECT pembiayaan_anggota.*, anggota.nama AS nama_anggota, akun_perkiraan.nama AS nama_akun, akun_perkiraan.jenis_akun
                                              FROM pembiayaan_anggota 
                                              INNER JOIN anggota ON pembiayaan_anggota.id_anggota = anggota.id_anggota 
                                              INNER JOIN akun_perkiraan ON pembiayaan_anggota.id_perkiraan = akun_perkiraan.id_perkiraan 
                                              ORDER BY pembiayaan_anggota.id_pembiayaan DESC") 
                                              or die(mysqli_error($con));
?>

<script>
    //ketika klik next
    $('#NextPage').click(function() {
        var valueNext = $('#NextPage').val();
        var batas = "<?php echo "$batas"; ?>";
        var keyword = "<?php echo "$keyword"; ?>";
        var keyword_by = "<?php echo "$keyword_by"; ?>";
        var OrderBy = "<?php echo "$OrderBy"; ?>";
        var ShortBy = "<?php echo "$ShortBy"; ?>";
        $.ajax({
            url: "_Page/PembiayaanAnggota/list.php",
            method: "POST",
            data: {
                page: valueNext,
                batas: batas,
                keyword: keyword,
                keyword_by: keyword_by,
                OrderBy: OrderBy,
                ShortBy: ShortBy
            },
            success: function(data) {
                $('#Menampilkanlist').html(data);
            }
        })
    });
    //Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var batas = "<?php echo "$batas"; ?>";
        var keyword = "<?php echo "$keyword"; ?>";
        var keyword_by = "<?php echo "$keyword_by"; ?>";
        var OrderBy = "<?php echo "$OrderBy"; ?>";
        var ShortBy = "<?php echo "$ShortBy"; ?>";
        $.ajax({
            url: "_Page/PembiayaanAnggota/list.php",
            method: "POST",
            data: {
                page: ValuePrev,
                batas: batas,
                keyword: keyword,
                keyword_by: keyword_by,
                OrderBy: OrderBy,
                ShortBy: ShortBy
            },
            success: function(data) {
                $('#Menampilkanlist').html(data);
            }
        })
    });

    <?php 
    $JmlHalaman = ceil($jml_data / $batas); 
    for ($i = 1; $i <= $JmlHalaman; $i++) { 
    ?>
        $('#PageNumber<?php echo $i;?>').click(function() {
            var PageNumber = $('#PageNumber<?php echo $i;?>').val();
            var batas = "<?php echo "$batas"; ?>";
            var keyword = "<?php echo "$keyword"; ?>";
            var keyword_by = "<?php echo "$keyword_by"; ?>";
            var OrderBy = "<?php echo "$OrderBy"; ?>";
            var ShortBy = "<?php echo "$ShortBy"; ?>";
            $.ajax({
                url: "_Page/PembiayaanAnggota/list.php",
                method: "POST",
                data: {
                    page: PageNumber,
                    batas: batas,
                    keyword: keyword,
                    keyword_by: keyword_by,
                    OrderBy: OrderBy,
                    ShortBy: ShortBy
                },
                success: function(data) {
                    $('#Menampilkanlist').html(data);
                }
            })
        });
    <?php } ?>
</script>

<div class="card-body">
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Pembiayaan <br>Id Anggota</th>
                            <th>Nama</th>
                            <th width="35%">Nama Akun <br> Jenis Pembiayaan</th>
                            <th class="text-right" width="18%">Jlh Pembiayaan<br>Total Bayar</th>
                            <th>Jangka Waktu</th>
                            <th width="18%" class="text-right">Bayar Per Bulan</th>
                            <th>Laba</th>
                            <th>Rugi</th>
                            <th>Tgl Pembiayaan<br>Tgl Selesai</th>
                            <th width="18%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($jml_data)) {
                            echo '<tr>';
                            echo '  <td colspan="11" class="text-center">Belum Ada Pembiayaan</td>';
                            echo '</tr>';
                        } else {
                            $no = 1 + $posisi;
                            while ($data = mysqli_fetch_array($sql_pembiayaan_anggota)) {
                                // Menghitung laba
                                $laba = $data['status_pembiayaan'] == "Lunas" ? $data['total_bayar'] - $data['jumlah_pembiayaan'] : 0;

                                // Menghitung rugi
                                $rugi = 0;
                                $tgl_selesai = strtotime($data['tgl_selesai']);
                                $tgl_sekarang = time();
                                if ($tgl_selesai < $tgl_sekarang && $data['status_pembiayaan'] != "Lunas") {
                                    $bulan_terlambat = ceil(($tgl_sekarang - $tgl_selesai) / (30 * 24 * 60 * 60));
                                    $rugi = $bulan_terlambat * $data['bayar_perbulan'];
                                }
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['id_pembiayaan'] ?><br><?php echo $data['id_anggota'] ?></td>
                                    <td><?php echo $data['nama_anggota'] ?></td>
                                    <td><?php echo $data['nama_akun'] . ' - ' . $data['jenis_akun'] ?></td>
                                    <td align="right">
                                        <strong>
                                            <?php echo 'Rp. ' . number_format($data['jumlah_pembiayaan'], 3) ?>
                                            <br>
                                            <?php echo 'Rp. ' . number_format($data['total_bayar'], 3) ?>
                                        </strong>
                                    </td>
                                    <td><?php echo $data['jangka_waktu'] ?> Bulan</td>
                                    <td><strong><?php echo 'Rp. ' . number_format($data['bayar_perbulan'], 2) ?></strong></td>
                                    <td><?php echo $data['status_pembiayaan'] == "Lunas" ? 'Rp. ' . number_format($laba, 3) : 'Rp. 0' ?></td>
                                    <td><?php echo $rugi > 0 ? 'Rp. ' . number_format($rugi, 3) : 'Rp. 0' ?></td>
                                    <td><?php echo $data['tgl_pembiayaan'] ?><br><?php echo $data['tgl_selesai'] ?></td>
                                    <td>
    <a class="btn btn-warning btn-xs" href="index.php?Page=PembiayaanAnggota&Sub=DetailPembiayaanAnggota&id_pembiayaan=<?php echo $data['id_pembiayaan']; ?>" title="Detail">Detail</a>
    <?php if ($data['status_pembiayaan'] == "Lunas") { ?>
        <button class="btn btn-success btn-xs" disabled>Lunas</button>
    <?php } else { ?>
        <a class="btn btn-primary btn-xs" href="index.php?Page=PembiayaanAnggota&Sub=setor&id_pembiayaan=<?php echo $data['id_pembiayaan']; ?>" title="Setor">Setor</a>
    <?php } ?>
</td>


                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
