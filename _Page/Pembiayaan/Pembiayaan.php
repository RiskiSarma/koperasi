<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pembiayaan</title>
</head>
<body>
    <h2>Tambah Pembiayaan Anggota</h2>
    <form action="add_loan.php" method="POST">
        <label for="id_anggota">Anggota:</label>
        <select name="id_anggota" required>
            <?php
            include 'db_connection.php';
            $result = $conn->query("SELECT id_anggota, nama FROM anggota");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id_anggota']}'>{$row['nama']}</option>";
            }
            ?>
        </select>
        <br>
        <label for="jumlah_pembiayaan">Jumlah Pembiayaan:</label>
        <input type="number" name="jumlah_pembiayaan" step="0.01" required>
        <br>
        <label for="tingkat_bunga">Tingkat Bunga (%):</label>
        <input type="number" name="tingkat_bunga" step="0.01" required>
        <br>
        <label for="tanggal_pembiayaan">Tanggal Pembiayaan:</label>
        <input type="date" name="tanggal_pembiayaan" required>
        <br>
        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo:</label>
        <input type="date" name="tanggal_jatuh_tempo" required>
        <br>
        <input type="submit" value="Tambah Pembiayaan">
    </form>
</body>
</html>
