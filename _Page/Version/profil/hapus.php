<?php
$id_jenis_produk = @$_GET ['id_jenis_produk'];

mysqli_query($con,"delete from jenis_produk where id_jenis_produk = '$id_jenis_produk'") or die (mysqli_error($con));
?>   

<script type=" text/javascript">
	window.location.href="?page=jenis_produk";
</script>
