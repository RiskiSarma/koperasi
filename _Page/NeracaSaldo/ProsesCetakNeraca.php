<?php
if (empty($_GET['periode1'])) {
    echo "Periode Awal Tidak Boleh Kosong!";
} else {
    if (empty($_GET['periode2'])) {
        echo "Periode Akhir Tidak Boleh Kosong!";
    } else {
        $periode1 = $_GET['periode1'];
        $periode2 = $_GET['periode2'];
        include '../../_Config/Connection.php';
        include '../../vendor/autoload.php';
?>
        <html>
        <head>
            <style type="text/css">
                @page {
                    margin-top: 1cm;
                    margin-bottom: 1cm;
                    margin-left: 1cm;
                    margin-right: 1cm;
                }

                body {
                    background-color: #FFF;
                    font-family: 11 px;
                    margin-top: 30 mm;
                    margin-bottom: 3 mm;
                    margin-left: 30 mm;
                    margin-right: 30 mm;
                }

                table.data tr td {
                    border-collapse: collapse;
                    border: 0.5px solid #666;
                    font-size: 12px;
                    font: arial;
                    color: #333;
                    border-spacing: 0px;
                    padding: 4px;
                }
            </style>
        </head>
        <body>
            <table width="100%">
                <tr>
                    <td align="center">
                        <b>NERACA SALDO</b><br>
                        Periode <?php echo "$periode1 - $periode2"; ?>
                    </td>
                </tr>
            </table>
            <table class="data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Akun Perkiraan</th>
                        <th>SN</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $total_aktiva = 0;
                $total_passiva = 0;

                $query = mysqli_query($Conn, "SELECT * FROM akun_perkiraan ORDER BY kode ASC");
                while ($data = mysqli_fetch_array($query)) {
                    $id_perkiraan = $data['id_perkiraan'];
                    $kode_perkiraan = $data['kode'];
                    $nama_perkiraan = $data['nama'];
                    $level_perkiraan = $data['level'];
                    $saldo_normal = $data['saldo_normal'];

                    $LabelSaldo = ($saldo_normal == 'Kredit') ? "<b class='text-danger'>K</b>" : "<b class='text-info'>D</b>";

                    $ClassTabel = ($level_perkiraan == 1) ? "table-primary" : (($level_perkiraan == 2) ? "table-info" : (($level_perkiraan == 3) ? "table-secondary" : "table-light"));

                    $JumlahDebet = 0;
                    $JumlahKredit = 0;

                    $QryAnak = mysqli_query($Conn, "SELECT * FROM akun_perkiraan WHERE kd$level_perkiraan='$kode_perkiraan'");
                    while ($DataAnak = mysqli_fetch_array($QryAnak)) {
                        $kodePerkiraanAnakAkun = $DataAnak['kode'];
                        $QryDebet = mysqli_query($Conn, "SELECT SUM(nilai) AS nilai FROM jurnal WHERE kode_perkiraan='$kodePerkiraanAnakAkun' AND tanggal>='$periode1' AND tanggal<='$periode2' AND d_k='Debet'");
                        $DataDebet = mysqli_fetch_array($QryDebet);
                        $Debet = empty($DataDebet['nilai']) ? 0 : $DataDebet['nilai'];
                        $JumlahDebet += $Debet;

                        $QryKredit = mysqli_query($Conn, "SELECT SUM(nilai) AS nilai FROM jurnal WHERE kode_perkiraan='$kodePerkiraanAnakAkun' AND tanggal>='$periode1' AND tanggal<='$periode2' AND d_k='Kredit'");
                        $DataKredit = mysqli_fetch_array($QryKredit);
                        $Kredit = empty($DataKredit['nilai']) ? 0 : $DataKredit['nilai'];
                        $JumlahKredit += $Kredit;
                    }

                    $Saldo = ($saldo_normal == 'Debet') ? ($JumlahDebet - $JumlahKredit) : ($JumlahKredit - $JumlahDebet);

                    if ($Saldo != 0) {
                        if ($saldo_normal == 'Debet') {
                            $total_aktiva += $Saldo;
                        } else {
                            $total_passiva += $Saldo;
                        }

                        echo '<tr class="' . $ClassTabel . '">';
                        echo '    <td>' . $no++ . '</td>';
                        echo '    <td>' . $kode_perkiraan . '</td>';
                        echo '    <td>' . $nama_perkiraan . '</td>';
                        echo '    <td>' . $LabelSaldo . '</td>';
                        echo '    <td class="text-right">' . number_format($Saldo, 0, ',', '.') . '</td>';
                        echo '</tr>';
                    }
                }

                $total_aktivaRp = number_format($total_aktiva, 0, ',', '.');
                $total_passivaRp = number_format($total_passiva, 0, ',', '.');

                echo '<tr class="table-success">';
                echo '    <td colspan="4" align="right"><b>Total Aktiva</b></td>';
                echo '    <td class="text-right"><b>' . $total_aktivaRp . '</b></td>';
                echo '</tr>';

                echo '<tr class="table-danger">';
                echo '    <td colspan="4" align="right"><b>Total Passiva</b></td>';
                echo '    <td class="text-right"><b>' . $total_passivaRp . '</b></td>';
                echo '</tr>';
                ?>
                </tbody>
            </table>
        </body>
        </html>
<?php
    }
}
?>
