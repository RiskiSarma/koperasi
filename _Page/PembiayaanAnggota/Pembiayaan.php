<?php
if (empty($_GET['Sub'])) {
    include "_Page/PembiayaanAnggota/PembiayaanHome.php";
} else {
    $Sub = $_GET['Sub'];
    switch ($Sub) {
        case "DetailPembiayaanAnggota":
            include "_Page/PembiayaanAnggota/DetailPembiayaanAnggota.php";
            break;
        case "cek":
            include "_Page/PembiayaanAnggota/cek_blm_lunas.php";
            break;
        case "tambah":
            include "_Page/PembiayaanAnggota/tambah.php";
            break;
        case "setor":
            include "_Page/PembiayaanAnggota/SetorPembiayaan.php";
            break;
        case "detail":
            include "_Page/PembiayaanAnggota/detail_transaksi.php";
            break;
        case "cetak":
                include "_Page/PembiayaanAnggota/kwitansi.php";
                break;
        case "tarik":
            include "_Page/PembiayaanAnggota/tarik_tabungan.php";
            break;
        default:
            include "_Page/PembiayaanAnggota/PembiayaanHome.php";
    }
}
?>
