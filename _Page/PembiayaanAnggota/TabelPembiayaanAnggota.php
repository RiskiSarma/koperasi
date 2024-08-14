<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                echo '  Berikut ini adalah halaman bagi hasil.';
                echo '  Anda bisa menambahkan sesi bagi hasil baru, mengatur persentase pembagian dan menentukan periode perhitungan.';
                echo '  Anda juga bisa melihat rincian pembagian jasa anggota dengan memilih salah satu sesi bagi hasil.';
                echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="javascript:void(0);" id="ProsesBatas">
                        <div class="row">
                            <div class="col-md-1 mt-3">
                                <select name="batas" id="batas" class="form-control">
                                    <option value="5">5</option>
                                    <option selected value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                </select>
                                <small>Data</small>
                            </div>
                            <div class="col-md-3 mt-3">
                                <input type="text" name="keyword" id="keyword" class="form-control">
                                <small>Pencarian</small>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="submit" class="btn btn-md btn-dark btn-block btn-rounded" title="Mulai Pencarian">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="button" class="btn btn-md btn-info btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalFilterBagiHasil" title="Filter Data Bagi Hasil">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                            </div>
                            <div class="col-md-2 mt-3">
                                <button type="button" class="btn btn-md btn-success btn-block btn-rounded" title="Cek yang Belum Lunas" onclick="window.location.href='?page=pembiayaan_anggota&action=cek_blm_lunas'">
                                    <i class="bi bi-check-circle"></i> Cek yang Belum Lunas
                                </button>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" onclick="window.location.href='?page=PembiayaanAnggota&action=tambah'" title="Tambah Pembiayaan">
                                    <i class="bi bi-plus-lg"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="MenampilkanTabelPembiayaanAnggota">
                                    <table class="table table-bordered table-striped" id="Datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Pembiayaan <br>Id Anggota</th>
                                                <th>Nama</th>
                                                <th width="35%">Jenis Pembiayaan</th>
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
                                                // File koneksi.php atau di bagian atas file list.php
                                                $host = 'localhost'; // Ganti dengan host database Anda
                                                $user = 'root'; // Ganti dengan username database Anda
                                                $password = ''; // Ganti dengan password database Anda
                                                $database = 'kopsyah'; // Ganti dengan nama database Anda

                                                // Membuat koneksi
                                                $con = mysqli_connect($host, $user, $password, $database);

                                                // Mengecek koneksi
                                                if (!$con) {
                                                    die('Koneksi gagal: ' . mysqli_connect_error());
                                                }
                                                $no = 1;                  
                                                $sql_pembiayaan_anggota = mysqli_query($con, "SELECT * FROM pembiayaan_anggota 
                                                                                                INNER JOIN anggota ON pembiayaan_anggota.id_anggota = anggota.id_anggota 
                                                                                                INNER JOIN akun_perkiraan ON pembiayaan_anggota.id_perkiraan = akun_perkiraan.id_perkiraan 
                                                                                                ORDER BY pembiayaan_anggota.id_pembiayaan DESC") 
                                                                                                or die(mysqli_error($con));
                                                while ($data = mysqli_fetch_array($sql_pembiayaan_anggota)) {
                                                    // Menghitung laba
                                                    $laba = 0;
                                                    if ($data['status_pembiayaan'] == "Lunas") {
                                                        $laba = $data['total_bayar'] - $data['jumlah_pembiayaan'];
                                                    }

                                                    // Menghitung rugi
                                                    $rugi = 0;
                                                    $tgl_selesai = strtotime($data['tgl_selesai']);
                                                    $tgl_sekarang = time();
                                                    if ($tgl_selesai < $tgl_sekarang && $data['status_pembiayaan'] != "Lunas") {
                                                        // Menghitung bulan keterlambatan
                                                        $bulan_terlambat = ceil(($tgl_sekarang - $tgl_selesai) / (30 * 24 * 60 * 60));
                                                        // Menghitung rugi berdasarkan bulan keterlambatan
                                                        $rugi = $bulan_terlambat * $data['bayar_perbulan'];
                                                    }
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $data['id_pembiayaan'] ?><br><?php echo $data['id_anggota'] ?></td>
                                                    <td><?php echo $data['nama_lengkap'] ?></td>
                                                    <td><?php echo $data['nama_produk'] ?></td>
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
                                                    <td><?php echo date('d-m-Y', strtotime($data['tgl_pembiayaan'])) ?><br><?php echo date('d-m-Y', strtotime($data['tgl_selesai'])) ?></td>
                                                    <td>
                                                        <a class="btn btn-warning btn-xs" href="?page=pembiayaan_anggota&action=detail&id_pembiayaan=<?php echo $data['id_pembiayaan'];?>" title="Detail">Detail</a>                        
                                                        <?php if ($_SESSION['level_admin'] != "Kepala") { ?> 
                                                            <?php if ($data['status_pembiayaan'] == "Lunas") { ?>
                                                                <button class="btn btn-success btn-xs">Lunas</button>
                                                            <?php } else { ?>
                                                                <a class="btn btn-primary btn-xs" href="?page=pembiayaan_anggota&action=setoran&id_pembiayaan=<?php echo $data['id_pembiayaan'];?>" title="Tambah">Setor</a>
                                                            <?php } }?>
                                                    </td>
                                                </tr>
                                            <?php 
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
