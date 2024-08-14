<?php
// Koneksi ke database
include 'koneksi.php';

// Ambil data dari form
$anggota_id = $_POST['anggota'];
$kategori_id = $_POST['kategori'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];

// Validasi data (misalnya, memastikan jumlah tidak negatif)
if ($jumlah <= 0) {
    die("Jumlah harus lebih besar dari 0.");
}

// Query untuk menyimpan data ke tabel pembiayaan_anggota
$query = "INSERT INTO pembiayaan_anggota (id_anggota, id_kategori, tanggal, jumlah, keterangan) 
          VALUES ('$anggota_id', '$kategori_id', '$tanggal', '$jumlah', '$keterangan')";

// Eksekusi query
if (mysqli_query($Conn, $query)) {
    // Jika berhasil, arahkan ke halaman daftar pembiayaan
    header("Location: index.php?Page=Pembiayaan&status=sukses");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($Conn);
}

// Tutup koneksi
mysqli_close($Conn);
?>
