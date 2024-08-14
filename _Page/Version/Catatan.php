<?php
// Definisikan versi aplikasi dan informasi lainnya
$app_version = "1.0.0"; // Ganti dengan versi aplikasi yang sesuai
$release_date = "2024-07-19"; // Tanggal rilis aplikasi
$developer = "Rizki Saputra Sarma"; // Nama pengembang aplikasi

// Tampilkan informasi versi aplikasi
?>

<div class="version-info">
    <h4>Informasi Versi Aplikasi</h4>
    <ul>
        <li><strong>Versi Aplikasi:</strong> <?php echo $app_version; ?></li>
        <li><strong>Tanggal Rilis:</strong> <?php echo $release_date; ?></li>
        <li><strong>Pengembang:</strong> <?php echo $developer; ?></li>
    </ul>
</div>

<style>
    .version-info {
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .version-info h4 {
        margin-top: 0;
    }
    .version-info ul {
        list-style-type: none;
        padding: 0;
    }
    .version-info li {
        margin-bottom: 10px;
    }
</style>
