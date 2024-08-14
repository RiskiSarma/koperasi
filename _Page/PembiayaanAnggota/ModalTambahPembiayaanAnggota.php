<div class="modal fade" id="ModalFilterPembiayaan" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesFilterPembiayaan">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-light"><i class="bi bi-funnel"></i> Filter Data Pembiayaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="FilterBatasPembiayaan">Data</label>
                            <select name="FilterBatasPembiayaan" id="FilterBatasPembiayaan" class="form-control">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="OrderByPembiayaan">Mode Urutan</label>
                            <select name="OrderByPembiayaan" id="OrderByPembiayaan" class="form-control">
                                <option value="">Pilih</option>
                                <option value="tanggal">Tanggal</option>
                                <option value="nama">Anggota</option>
                                <option value="kategori">Kategori</option>
                                <option value="keterangan">Keterangan</option>
                                <option value="jumlah">Jumlah</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="ShortByPembiayaan">Tipe Urutan</label>
                            <select name="ShortByPembiayaan" id="ShortByPembiayaan" class="form-control">
                                <option value="ASC">A To Z</option>
                                <option value="DESC">Z To A</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="KeywordByPembiayaan">Pencarian</label>
                            <select name="KeywordByPembiayaan" id="KeywordByPembiayaan" class="form-control">
                                <option value="">Pilih</option>
                                <option value="tanggal">Tanggal</option>
                                <option value="nama">Anggota</option>
                                <option value="kategori">Kategori</option>
                                <option value="keterangan">Keterangan</option>
                                <option value="jumlah">Jumlah</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3" id="FormKataKunciPembiayaan">
                            <label for="FilterKeywordPembiayaan">Kata Kunci</label>
                            <input type="text" name="FilterKeywordPembiayaan" id="FilterKeywordPembiayaan" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-info">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Filter
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTambahPembiayaan" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light"><i class="bi bi-people"></i> Pilih Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" id="ProsesCariAnggotaPembiayaan">
                    <div class="row">
                        <div class="col-md-10 mb-2">
                            <input type="text" name="KeywordAnggotaPembiayaan" id="KeywordAnggotaPembiayaan" class="form-control" placeholder="Cari Anggota">
                        </div>
                        <div class="col-md-2 mb-2">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div id="DataListAnggotaPembiayaan">
                    
                </div>
            </div>
            <div class="modal-footer bg-primary">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalPilihAnggotaPembiayaan" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="index.php?Page=Pembiayaan&Sub=TambahPembiayaan" method="POST">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light"><i class="bi bi-check"></i> Pilih Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="FormPilihAnggotaPembiayaan">
                    
                </div>
                <div class="modal-footer bg-primary">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-arrow-right"></i> Lanjutkan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahPembiayaan">
                        <i class="bi bi-x-circle"></i> Kembali
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalAutoJurnalPembiayaan" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light"><i class="bi bi-info-circle"></i> Auto Jurnal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2 table-responsive">
                        <table class="table">
                            <?php
                                //Membuka Auto Jurnal Pembiayaan
                                $QryAutoJurnalPembiayaan = mysqli_query($Conn,"SELECT * FROM auto_jurnal WHERE kategori_transaksi='Pembiayaan'")or die(mysqli_error($Conn));
                                $DataAutoJurnalPembiayaan = mysqli_fetch_array($QryAutoJurnalPembiayaan);
                                $DebetNamePembiayaan= $DataAutoJurnalPembiayaan['debet_name'];
                                $KreditNamePembiayaan= $DataAutoJurnalPembiayaan['kredit_name'];
                                //Membuka Auto Jurnal Angsuran
                                $QryAutoJurnalAngsuran = mysqli_query($Conn,"SELECT * FROM auto_jurnal WHERE kategori_transaksi='Angsuran'")or die(mysqli_error($Conn));
                                $DataAutoJurnalAngsuran = mysqli_fetch_array($QryAutoJurnalAngsuran);
                                $DebetNameAngsuran= $DataAutoJurnalAngsuran['debet_name'];
                                $KreditNameAngsuran= $DataAutoJurnalAngsuran['kredit_name'];

                            ?>
                            <tr>
                                <td><b>Kategori</b></td>
                                <td><b>D/K</b></td>
                                <td><b>Akun</b></td>
                            </tr>
                            <tr>
                                <td>Pembiayaan</td>
                                <td>D</td>
                                <td><?php echo "$DebetNamePembiayaan"; ?></td>
                            </tr>
                            <tr>
                                <td>Pembiayaan</td>
                                <td>K</td>
                                <td><?php echo "$KreditNamePembiayaan"; ?></td>
                            </tr>
                            <tr>
                                <td>Angsuran</td>
                                <td>D</td>
                                <td><?php echo "$DebetNameAngsuran"; ?></td>
                            </tr>
                            <tr>
                                <td>Angsuran</td>
                                <td>K</td>
                                <td><?php echo "$KreditNameAngsuran"; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-info">
                <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
