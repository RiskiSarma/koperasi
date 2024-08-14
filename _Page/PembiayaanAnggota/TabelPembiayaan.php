<?php
    // Koneksi dan session
    ini_set("display_errors", "off");
    date_default_timezone_set("Asia/Jakarta");
    include "../../_Config/Connection.php";

    // Keyword_by
    $keyword_by = !empty($_POST['keyword_by']) ? $_POST['keyword_by'] : "";

    // Keyword
    $keyword = !empty($_POST['keyword']) ? $_POST['keyword'] : "";

    // Batas
    $batas = !empty($_POST['batas']) ? $_POST['batas'] : "10";

    // ShortBy
    $ShortBy = !empty($_POST['ShortBy']) ? $_POST['ShortBy'] : "DESC";
    $NextShort = ($ShortBy == "ASC") ? "DESC" : "ASC";

    // OrderBy
    $OrderBy = !empty($_POST['OrderBy']) ? $_POST['OrderBy'] : "id_pembiayaan";

    // Atur Page
    $page = !empty($_POST['page']) ? $_POST['page'] : "1";
    $posisi = ($page - 1) * $batas;

    // Hitung jumlah data
    $jml_data = empty($keyword_by) ?
        (empty($keyword) ? mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM pembiayaan")) :
            mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM pembiayaan WHERE nama LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' OR kategori LIKE '%$keyword%' OR keterangan LIKE '%$keyword%' OR jumlah LIKE '%$keyword%'"))) :
        (empty($keyword) ? mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM pembiayaan")) :
            mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM pembiayaan WHERE $keyword_by LIKE '%$keyword%'")));

    // Jumlah Pembiayaan
    $SumPembiayaan = mysqli_fetch_array(mysqli_query($Conn, "SELECT SUM(jumlah) AS jumlah FROM pembiayaan WHERE kategori != 'Pengembalian'"));
    $JumlahPembiayaan1 = $SumPembiayaan['jumlah'];
    $JumlahPembiayaan = number_format($JumlahPembiayaan1, 0, ',', '.');

    // Jumlah Pengembalian
    $SumPengembalian = mysqli_fetch_array(mysqli_query($Conn, "SELECT SUM(jumlah) AS jumlah FROM pembiayaan WHERE kategori = 'Pengembalian'"));
    $JumlahPengembalian1 = $SumPengembalian['jumlah'];
    $JumlahPengembalian = number_format($JumlahPengembalian1, 0, ',', '.');

    // Pembiayaan Netto
    $PembiayaanNetto1 = $JumlahPembiayaan1 - $JumlahPengembalian1;
    $PembiayaanNetto = number_format($PembiayaanNetto1, 0, ',', '.');
?>

<script>
    // Ketika klik next
    $('#NextPage').click(function() {
        var valueNext = $('#NextPage').val();
        var batas = "<?php echo $batas; ?>";
        var keyword = "<?php echo $keyword; ?>";
        var keyword_by = "<?php echo $keyword_by; ?>";
        var OrderBy = "<?php echo $OrderBy; ?>";
        var ShortBy = "<?php echo $ShortBy; ?>";
        $('#MenampilkanTabelPembiayaan').html("Loading...");
        $.ajax({
            url: "_Page/Pembiayaan/TabelPembiayaanAnggota.php",
            method: "POST",
            data: { page: valueNext, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function(data) {
                $('#MenampilkanTabelPembiayaan').html(data);
            }
        })
    });

    // Ketika klik Previous
    $('#PrevPage').click(function() {
        var ValuePrev = $('#PrevPage').val();
        var batas = "<?php echo $batas; ?>";
        var keyword = "<?php echo $keyword; ?>";
        var keyword_by = "<?php echo $keyword_by; ?>";
        var OrderBy = "<?php echo $OrderBy; ?>";
        var ShortBy = "<?php echo $ShortBy; ?>";
        $('#MenampilkanTabelPembiayaanAnggota').html("Loading...");
        $.ajax({
            url: "_Page/Pembiayaan/TabelPembiayaanAnggota.php",
            method: "POST",
            data: { page: ValuePrev, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
            success: function(data) {
                $('#MenampilkanTabelPembiayaan').html(data);
            }
        })
    });

    <?php 
        $JmlHalaman = ceil($jml_data / $batas); 
        for ($i = 1; $i <= $JmlHalaman; $i++) {
    ?>
        // Ketika klik page number
        $('#PageNumber<?php echo $i; ?>').click(function() {
            var PageNumber = $('#PageNumber<?php echo $i; ?>').val();
            var batas = "<?php echo $batas; ?>";
            var keyword = "<?php echo $keyword; ?>";
            var keyword_by = "<?php echo $keyword_by; ?>";
            var OrderBy = "<?php echo $OrderBy; ?>";
            var ShortBy = "<?php echo $ShortBy; ?>";
            $('#MenampilkanTabelPembiayaanAnggota').html("Loading...");
            $.ajax({
                url: "_Page/Pembiayaan/TabelPembiayaanAnggota.php",
                method: "POST",
                data: { page: PageNumber, batas: batas, keyword: keyword, keyword_by: keyword_by, OrderBy: OrderBy, ShortBy: ShortBy },
                success: function(data) {
                    $('#MenampilkanTabelPembiayaan').html(data);
                }
            })
        });
    <?php } ?>
</script>

<div class="card-body">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-items-center mb-0">
                    <thead class="">
                        <tr>
                            <th class="text-center">
                                <b>No</b>
                            </th>
                            <th class="text-center">
                                <b>ID Pembiayaan</b>
                            </th>
                            <th class="text-center">
                                <b>Anggota</b>
                            </th>
                            <th class="text-center">
                                <b>Keterangan</b>
                            </th>
                            <th class="text-center">
                                <b>Jurnal</b>
                            </th>
                            <th class="text-center">
                                <b>Jumlah</b>
                            </th>
                            <th class="text-center">
                                <b>Opsi</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (empty($jml_data)) {
                                echo '<tr>';
                                echo '  <td colspan="7">';
                                echo '      <span class="text-danger">Belum Ada Data Pembiayaan</span>';
                                echo '  </td>';
                                echo '</tr>';
                            } else {
                                $no = 1 + $posisi;
                                $query = empty($keyword_by) ?
                                    (empty($keyword) ? mysqli_query($Conn, "SELECT * FROM pembiayaan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas") :
                                        mysqli_query($Conn, "SELECT * FROM pembiayaan WHERE nama LIKE '%$keyword%' OR kategori LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' OR keterangan LIKE '%$keyword%' OR jumlah LIKE '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas")) :
                                    (empty($keyword) ? mysqli_query($Conn, "SELECT * FROM pembiayaan ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas") :
                                        mysqli_query($Conn, "SELECT * FROM pembiayaan WHERE $keyword_by LIKE '%$keyword%' ORDER BY $OrderBy $ShortBy LIMIT $posisi, $batas"));

                                while ($data = mysqli_fetch_array($query)) {
                                    $id_pembiayaan = $data['id_pembiayaan'];
                                    $id_anggota = $data['id_anggota'];
                                    $kategori = $data['kategori'];
                                    $keterangan = $data['keterangan'];
                                    $nama = $data['nama'];
                                    $jumlah = number_format($data['jumlah'], 0, ',', '.');
                                    $tanggal = date('d/m/Y', strtotime($data['tanggal']));
                                    $IdPembiayaan = sprintf("%07d", $id_pembiayaan);
                                    $CekJurnal = mysqli_num_rows(mysqli_query($Conn, "SELECT * FROM jurnal WHERE id_pembiayaan='$id_pembiayaan'"));
                                    $LabelJurnal = $CekJurnal == 0 ? '<span class="badge badge-dark" title="Belum Ada Pada Jurnal"><i class="bi bi-x"></i> Journal</span>' : '<span class="badge badge-success" title="Jurnal Tersedia '.$CekJurnal.' record"><i class="bi bi-check-circle"></i> Journal</span>';
                        ?>
                            <tr>
                                <td class="text-center text-xs"><?php echo $no; ?></td>
                                <td class="text-left">
                                    <small>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalDetailPembiayaan" data-id="<?php echo $id_pembiayaan; ?>" title="Lihat Detail Pembiayaan">
                                            <b><i class="bi bi-qr-code"></i> <?php echo $IdPembiayaan; ?></b>
                                        </a>
                                        <br>
                                        <small><i class="bi bi-calendar-check"></i> <?php echo $tanggal; ?></small>
                                    </small>
                                </td>
                                <td class="text-left">
                                    <small><i class="bi bi-person-circle"></i> <?php echo $nama; ?></small>
                                </td>
                                <td class="text-left">
                                    <small>
                                        <b><i class="bi bi-tag"></i> <?php echo $kategori; ?></b><br>
                                        <i class="bi bi-info-circle"></i> <?php echo $keterangan; ?>
                                    </small>
                                </td>
                                <td class="text-center"><?php echo $LabelJurnal; ?></td>
                                <td class="text-right"><small><?php echo $jumlah; ?></small></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEditPembiayaan" data-id="<?php echo "$id_pembiayaan,$keyword,$batas,$ShortBy,$OrderBy,$page,$keyword_by"; ?>" title="Edit Data Pembiayaan">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDeletePembiayaan" data-id="<?php echo "$id_pembiayaan,$keyword,$batas,$ShortBy,$OrderBy,$page,$keyword_by"; ?>" title="Hapus Data Pembiayaan">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php
                                    $no++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination Controls -->
            <div class="mt-3">
                <button id="PrevPage" class="btn btn-primary btn-sm" value="<?php echo $page - 1; ?>">Prev</button>
                <?php for ($i = 1; $i <= $JmlHalaman; $i++) { ?>
                    <button id="PageNumber<?php echo $i; ?>" class="btn btn-secondary btn-sm" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                <?php } ?>
                <button id="NextPage" class="btn btn-primary btn-sm" value="<?php echo $page + 1; ?>">Next</button>
            </div>
        </div>
    </div>
</div>
