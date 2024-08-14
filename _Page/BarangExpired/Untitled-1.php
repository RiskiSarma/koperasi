<?php
    //koneksi dan session
    date_default_timezone_set('Asia/Jakarta');
    include "../../_Config/Connection.php";
    include "../../_Config/Session.php";

    //Periode Waktu
    if (empty($_POST['periode1'])) {
        echo '<div class="card-body">';
        echo '  <div class="row">';
        echo '      <div class="col-md-12 text-center">';
        echo '          <div class="alert alert-danger" role="alert">';
        echo '              Anda Belum Mengisi Periode Awal';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    } else {
        if (empty($_POST['periode2'])) {
            echo '<div class="card-body">';
            echo '  <div class="row">';
            echo '      <div class="col-md-12 text-center">';
            echo '          <div class="alert alert-danger" role="alert">';
            echo '              Anda Belum Mengisi Periode Akhir';
            echo '          </div>';
            echo '      </div>';
            echo '  </div>';
            echo '</div>';
        } else {
            $periode1 = $_POST['periode1'];
            $periode2 = $_POST['periode2'];
            //keyword
            $keyword = !empty($_POST['keyword']) ? $_POST['keyword'] : "";
            //batas
            $batas = !empty($_POST['batas']) ? $_POST['batas'] : "10";
            //ShortBy
            $ShortBy = !empty($_POST['ShortBy']) ? $_POST['ShortBy'] : "ASC";
            $NextShort = ($ShortBy == "ASC") ? "DESC" : "ASC";
            //OrderBy
            $OrderBy = !empty($_POST['OrderBy']) ? $_POST['OrderBy'] : "kode";
            //Atur Page
            $page = !empty($_POST['page']) ? $_POST['page'] : "1";
            $posisi = ($page - 1) * $batas;
            $jml_data = empty($keyword) ? mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM akun_perkiraan")) : mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM akun_perkiraan WHERE nama LIKE '%$keyword%' OR name LIKE '%$keyword%' OR saldo_normal LIKE '%$keyword%'"));

?>
    <script>
        //ketika klik next
        $('#NextPage').click(function() {
            var valueNext = $('#NextPage').val();
            var batas = $('#batas').val();
            var periode1 = $('#periode1').val();
            var periode2 = $('#periode2').val();
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                url: "_Page/NeracaSaldo/TabelNeracaSaldo.php",
                method: "POST",
                data: { page: valueNext, batas: batas, periode1: periode1, periode2: periode2, id_mitra: id_mitra },
                success: function(data) {
                    $('#MenampilkanTabelNeracaSaldo').html(data);
                }
            })
        });

        //Ketika klik Previous
        $('#PrevPage').click(function() {
            var ValuePrev = $('#PrevPage').val();
            var batas = $('#batas').val();
            var periode1 = $('#periode1').val();
            var periode2 = $('#periode2').val();
            var id_mitra = $('#id_mitra').val();
            $.ajax({
                url: "_Page/NeracaSaldo/TabelNeracaSaldo.php",
                method: "POST",
                data: { page: ValuePrev, batas: batas, periode1: periode1, periode2: periode2, id_mitra: id_mitra },
                success: function(data) {
                    $('#MenampilkanTabelNeracaSaldo').html(data);
                }
            })
        });

        <?php 
            $JmlHalaman = ceil($jml_data / $batas);
            for ($i = 1; $i <= $JmlHalaman; $i++) {
        ?>
            //ketika klik page number
            $('#PageNumber<?php echo $i; ?>').click(function() {
                var PageNumber = $('#PageNumber<?php echo $i; ?>').val();
                var batas = $('#batas').val();
                var periode1 = $('#periode1').val();
                var periode2 = $('#periode2').val();
                var id_mitra = $('#id_mitra').val();
                $.ajax({
                    url: "_Page/NeracaSaldo/TabelNeracaSaldo.php",
                    method: "POST",
                    data: { page: PageNumber, batas: batas, periode1: periode1, periode2: periode2, id_mitra: id_mitra },
                    success: function(data) {
                        $('#MenampilkanTabelNeracaSaldo').html(data);
                    }
                })
            });
        <?php } ?>
    </script>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th><b class="sub-title">No</b></th>
                        <th><b class="sub-title">Kode</b></th>
                        <th><b class="sub-title">Akun Perkiraan</b></th>
                        <th><b class="sub-title">SN</b></th>
                        <th><b class="sub-title">Debet</b></th>
                        <th><b class="sub-title">Kredit</b></th>
                        <th><b class="sub-title">Saldo</b></th>
                        <th><b class="sub-title">Aktiva/Passiva</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1 + $posisi;
                        $query = empty($keyword) ? mysqli_query($Conn, "SELECT * FROM akun_perkiraan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas") : mysqli_query($Conn, "SELECT * FROM akun_perkiraan WHERE nama LIKE '%$keyword%' OR name LIKE '%$keyword%' OR saldo_normal LIKE '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas");
                        while ($data = mysqli_fetch_array($query)) {
                            $id_perkiraan = $data['id_perkiraan'];
                            $kode_perkiraan = $data['kode'];
                            $nama_perkiraan = $data['nama'];
                            $level_perkiraan = $data['level'];
                            $saldo_normal = $data['saldo_normal'];
                            $status = $data['status'];
                            $LabelSaldo = ($saldo_normal == 'Kredit') ? "<b class='text-danger'>K</b>" : "<b class='text-info'>D</b>";
                            $jml_anak_akun = ($level_perkiraan == '1') ? "2" : mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM akun_perkiraan WHERE kd$level_perkiraan='$kode_perkiraan' AND level>'$level_perkiraan'"));
                            $ClassTabel = ($level_perkiraan == "1") ? "table-primary" : (($level_perkiraan == "2") ? "table-info" : (($level_perkiraan == "3") ? "table-secondary" : "table-light"));

                            $JumlahDebet = 0;
                            $QryAnak = mysqli_query($Conn, "SELECT * FROM akun_perkiraan WHERE kd$level_perkiraan='$kode_perkiraan'");
                            while ($DataAnak = mysqli_fetch_array($QryAnak)) {
                                $kodePerkiraanAnakAkun = $DataAnak['kode'];
                                $QryDebet = mysqli_query($Conn, "SELECT SUM(nilai) AS nilai FROM jurnal WHERE kode_perkiraan='$kodePerkiraanAnakAkun' AND tanggal>='$periode1' AND tanggal<='$periode2' AND d_k='Debet'") or die(mysqli_error($Conn));
                                $DataDebet = mysqli_fetch_array($QryDebet);
                                $Debet = empty($DataDebet['nilai']) ? "0" : $DataDebet['nilai'];
                                $JumlahDebet += $Debet;
                            }
                            $JumlahDebetRp = number_format($JumlahDebet, 0, ',', '.');

                            $JumlahKredit = 0;
                            $QryAnak = mysqli_query($Conn, "SELECT * FROM akun_perkiraan WHERE kd$level_perkiraan='$kode_perkiraan'");
                            while ($DataAnak = mysqli_fetch_array($QryAnak)) {
                                $kodePerkiraanAnakAkun = $DataAnak['kode'];
                                $QryKredit = mysqli_query($Conn, "SELECT SUM(nilai) AS nilai FROM jurnal WHERE kode_perkiraan='$kodePerkiraanAnakAkun' AND tanggal>='$periode1' AND tanggal<='$periode2' AND d_k='Kredit'") or die(mysqli_error($Conn));
                                $DataKredit = mysqli_fetch_array($QryKredit);
                                $Kredit = empty($DataKredit['nilai']) ? "0" : $DataKredit['nilai'];
                                $JumlahKredit += $Kredit;
                            }
                            $JumlahKreditRp = number_format($JumlahKredit, 0, ',', '.');

                            $Saldo = ($saldo_normal == 'Debet') ? ($JumlahDebet - $JumlahKredit) : ($JumlahKredit - $JumlahDebet);
                            $SaldoRp = number_format($Saldo, 0, ',', '.');

                            $aktiva_passiva = ($Saldo > 0) ? "Aktiva" : (($Saldo < 0) ? "Passiva" : "N/A");

                            echo '<tr class="' . $ClassTabel . '">';
                            echo '    <td><b>' . $no++ . '</b></td>';
                            echo '    <td><b>' . $kode_perkiraan . '</b></td>';
                            echo '    <td><b>' . $nama_perkiraan . '</b></td>';
                            echo '    <td><b>' . $LabelSaldo . '</b></td>';
                            echo '    <td><b>' . $JumlahDebetRp . '</b></td>';
                            echo '    <td><b>' . $JumlahKreditRp . '</b></td>';
                            echo '    <td><b>' . $SaldoRp . '</b></td>';
                            echo '    <td><b>' . $aktiva_passiva . '</b></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 text-left">
                <h4><small>Menampilkan</small> <?php echo $jml_data; ?> <small>Dari</small> <?php echo $jml_data; ?> <small>Data</small></h4>
            </div>
            <div class="col-md-6 text-right">
                <button id="PrevPage" value="<?php echo max($page - 1, 1); ?>" class="btn btn-info">Previous</button>
                <button id="NextPage" value="<?php echo min($page + 1, $JmlHalaman); ?>" class="btn btn-info">Next</button>
                <?php for ($i = 1; $i <= $JmlHalaman; $i++) { ?>
                    <button id="PageNumber<?php echo $i; ?>" value="<?php echo $i; ?>" class="btn btn-info"><?php echo $i; ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
        }
    }
?>
