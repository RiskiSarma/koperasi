<?php
include 'Connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $jumlah_pembiayaan = $_POST['jumlah_pembiayaan'];
    $tingkat_bunga = $_POST['tingkat_bunga'];
    $tanggal_pembiayaan = $_POST['tanggal_pembiayaan'];
    $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];

    $sql = "INSERT INTO loans (id_anggota, jumlah_pembiayaan, tingkat_bunga, tanggal_pembiayaan, tanggal_jatuh_tempo) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iddss", $id_anggota, $jumlah_pembiayaan, $tingkat_bunga, $tanggal_pembiayaan, $tanggal_jatuh_tempo);

    if ($stmt->execute()) {
        echo "Pembiayaan berhasil ditambahkan!";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
