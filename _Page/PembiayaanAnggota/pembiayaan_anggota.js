$('#MenampilkanTabelPembiayaan').html("Loading...");
$('#MenampilkanTabelPembiayaan').load("_Page/Pembiayaan/TabelPembiayaan.php");
$('#batasPembiayaan').change(function(){
    var ProsesBatasPembiayaan = $('#ProsesBatasPembiayaan').serialize();
    $('#MenampilkanTabelPembiayaan').html('Loading...');
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/TabelPembiayaan.php',
        data       :  ProsesBatasPembiayaan,
        success    : function(data){
            $('#MenampilkanTabelPembiayaan').html(data);
        }
    });
});
$('#ProsesBatasPembiayaan').submit(function(){
    var ProsesBatasPembiayaan = $('#ProsesBatasPembiayaan').serialize();
    $('#MenampilkanTabelPembiayaan').html('Loading...');
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/TabelPembiayaan.php',
        data       :  ProsesBatasPembiayaan,
        success    : function(data){
            $('#MenampilkanTabelPembiayaan').html(data);
        }
    });
});
$('#ProsesFilterPembiayaan').submit(function(){
    var batas = $('#FilterBatasPembiayaan').val();
    var OrderBy = $('#OrderByPembiayaan').val();
    var ShortBy = $('#ShortByPembiayaan').val();
    var KeywordBy = $('#KeywordByPembiayaan').val();
    var FilterKeyword = $('#FilterKeywordPembiayaan').val();
    $('#MenampilkanTabelPembiayaan').html('Loading...');
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/TabelPembiayaan.php',
        data       :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success    : function(data){
            $('#MenampilkanTabelPembiayaan').html(data);
            $('#ModalFilterPembiayaan').modal('hide');
        }
    });
});
//Tambah Pembiayaan
$('#ModalTambahPembiayaan').on('show.bs.modal', function (e) {
    $('#DataListAnggotaPembiayaan').html("Loading...");
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/FormTambahPembiayaan.php',
        success    : function(data){
            $('#DataListAnggotaPembiayaan').html(data);
        }
    });
});
$('#ProsesCariAnggotaPembiayaan').submit(function(){
    var ProsesCariAnggotaPembiayaan = $('#ProsesCariAnggotaPembiayaan').serialize();
    $('#DataListAnggotaPembiayaan').html('Loading...');
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/FormTambahPembiayaan.php',
        data       :  ProsesCariAnggotaPembiayaan,
        success    : function(data){
            $('#DataListAnggotaPembiayaan').html(data);
        }
    });
});
var GetIdAnggotaPembiayaan = $('#id_anggota_pembiayaan').val();
$('#MenampilkanTabelPembiayaanAnggota').html('Loading...');
$.ajax({
    type       : 'POST',
    url        : '_Page/Pembiayaan/TabelPembiayaanAnggota.php',
    data       :  {id_anggota: GetIdAnggotaPembiayaan},
    success    : function(data){
        $('#MenampilkanTabelPembiayaanAnggota').html(data);
    }
});
//Modal Pilih Anggota
$('#ModalPilihAnggotaPembiayaan').on('show.bs.modal', function (e) {
    var id_anggota = $(e.relatedTarget).data('id');
    $('#FormPilihAnggotaPembiayaan').html("Loading...");
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/FormPilihAnggota.php',
        data       : {id_anggota: id_anggota},
        success    : function(data){
            $('#FormPilihAnggotaPembiayaan').html(data);
        }
    });
});
//Proses Tambah Pembiayaan
$('#ProsesTambahPembiayaan').submit(function(){
    $('#NotifikasiTambahPembiayaan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahPembiayaan')[0];
    var data = new FormData(form);
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/ProsesTambahPembiayaan.php',
        data       :  data,
        cache      : false,
        processData: false,
        contentType: false,
        enctype    : 'multipart/form-data',
        success    : function(data){
            $('#NotifikasiTambahPembiayaan').html(data);
            var NotifikasiTambahPembiayaanBerhasil = $('#NotifikasiTambahPembiayaanBerhasil').html();
            if(NotifikasiTambahPembiayaanBerhasil == "Success"){
                $('#MenampilkanTabelPembiayaanAnggota').html('Loading...');
                $.ajax({
                    type       : 'POST',
                    url        : '_Page/Pembiayaan/TabelPembiayaanAnggota.php',
                    data       :  {id_anggota: GetIdAnggotaPembiayaan},
                    success    : function(data){
                        $('#MenampilkanTabelPembiayaanAnggota').html(data);
                        $('#ProsesTambahPembiayaan').trigger("reset");
                        swal("Good Job!", "Tambah Pembiayaan Anggota Berhasil!", "success");
                    }
                });
            }
        }
    });
});
//Edit Pembiayaan
$('#ModalEditPembiayaan').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_pembiayaan = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditPembiayaan').html("Loading...");
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/FormEditPembiayaan.php',
        data       : {id_pembiayaan: id_pembiayaan},
        success    : function(data){
            $('#FormEditPembiayaan').html(data);
            //Proses Edit Pembiayaan
            $('#ProsesEditPembiayaan').submit(function(){
                $('#NotifikasiEditPembiayaan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditPembiayaan')[0];
                var data = new FormData(form);
                $.ajax({
                    type       : 'POST',
                    url        : '_Page/Pembiayaan/ProsesEditPembiayaan.php',
                    data       :  data,
                    cache      : false,
                    processData: false,
                    contentType: false,
                    enctype    : 'multipart/form-data',
                    success    : function(data){
                        $('#NotifikasiEditPembiayaan').html(data);
                        var NotifikasiEditPembiayaanBerhasil = $('#NotifikasiEditPembiayaanBerhasil').html();
                        if(NotifikasiEditPembiayaanBerhasil == "Success"){
                            $('#MenampilkanTabelPembiayaan').html("Loading...");
                            $.ajax({
                                type       : 'POST',
                                url        : '_Page/Pembiayaan/TabelPembiayaan.php',
                                data       :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success    : function(data){
                                    $('#MenampilkanTabelPembiayaan').html(data);
                                    $('#ModalEditPembiayaan').modal('hide');
                                    swal("Good Job!", "Edit Pembiayaan Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Hapus Pembiayaan
$('#ModalDeletePembiayaan').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_pembiayaan = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeletePembiayaan').html("Loading...");
    $.ajax({
        type       : 'POST',
        url        : '_Page/Pembiayaan/FormDeletePembiayaan.php',
        data       : {id_pembiayaan: id_pembiayaan},
        success    : function(data){
            $('#FormDeletePembiayaan').html(data);
            //Konfirmasi Hapus Pembiayaan
            $('#KonfirmasiHapusPembiayaan').click(function(){
                $('#NotifikasiHapusPembiayaan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type       : 'POST',
                    url        : '_Page/Pembiayaan/ProsesDeletePembiayaan.php',
                    data       : {id_pembiayaan: id_pembiayaan},
                    success    : function(data){
                        $('#NotifikasiHapusPembiayaan').html(data);
                        var NotifikasiDeletePembiayaanBerhasil = $('#NotifikasiDeletePembiayaanBerhasil').html();
                        if(NotifikasiDeletePembiayaanBerhasil == "Success"){
                            $('#MenampilkanTabelPembiayaan').html("Loading...");
                            $.ajax({
                                type       : 'POST',
                                url        : '_Page/Pembiayaan/TabelPembiayaan.php',
                                data       :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success    : function(data){
                                    $('#MenampilkanTabelPembiayaan').html(data);
                                    $('#ModalDeletePembiayaan').modal('hide');
                                    swal("Good Job!", "Hapus Pembiayaan Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
