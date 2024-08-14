<?php
$id_gallery = @$_GET ['id_gallery'];

$hapus = mysqli_query($con,"SELECT * FROM gallery WHERE id_gallery = '$id_gallery' ") or die (mysqli_error($con));
$data = $hapus->fetch_assoc();
mysqli_query($con,"delete from gallery where id_gallery = '$id_gallery'") or die (mysqli_error($con));
if(file_exists('gallery/poto/'.$data['poto_gallery'])){
	unlink('gallery/poto/'.$data['poto_gallery']);
}
?>   

<script type=" text/javascript">
	window.location.href="?page=gallery";
</script>
