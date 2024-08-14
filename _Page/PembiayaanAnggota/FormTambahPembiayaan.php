<?php
// Koneksi ke database
include '_Config/Connection.php';

// Ambil data anggota untuk dropdown
$anggotaQuery = mysqli_query($Conn, "SELECT id_anggota, nama FROM anggota") or die(mysqli_error($Conn));
$anggotaOptions = "";
while ($row = mysqli_fetch_assoc($anggotaQuery)) {
    $anggotaOptions .= "<option value='{$row['id_anggota']}'>{$row['nama']}</option>";
}

// Ambil data kategori pembiayaan untuk dropdown
$kategoriQuery = mysqli_query($Conn, "SELECT id_kategori, nama_kategori FROM kategori_pembiayaan") or die(mysqli_error($Conn));
$kategoriOptions = "";
while ($row = mysqli_fetch_assoc($kategoriQuery)) {
    $kategoriOptions .= "<option value='{$row['id_kategori']}'>{$row['nama_kategori']}</option>";
}
?>

<div class="container mt-4">
    <h2>Tambah Pembiayaan</h2>
    <form action="ProsesTambahPembiayaan.php" method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Anggota">Anggota</label>
                <select name="anggota" id="Anggota" class="form-control" required>
                    <option value="">Pilih Anggota</option>
                    <?php echo $anggotaOptions; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Kategori">Kategori</label>
                <select name="kategori" id="Kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php echo $kategoriOptions; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="Tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="Tanggal" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="Jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="Jumlah" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="Keterangan">Keterangan</label>
                <textarea name="keterangan" id="Keterangan" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="index.php?Page=PembiayaanHome" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>
