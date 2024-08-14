<?php
$id_pengurus = @$_GET ['id_pengurus'];

$hapus = mysqli_query($con,"SELECT * FROM pengurus WHERE id_pengurus = '$id_pengurus' ") or die (mysqli_error($con));
$data = $hapus->fetch_assoc();
mysqli_query($con,"delete from pengurus where id_pengurus = '$id_pengurus'") or die (mysqli_error($con));
if(file_exists('pengurus/poto/'.$data['poto_pengurus'])){
	unlink('pengurus/poto/'.$data['poto_pengurus']);
}
?>   

<script type=" text/javascript">
	window.location.href="?page=pengurus";
</script>
