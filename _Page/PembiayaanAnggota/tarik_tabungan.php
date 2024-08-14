<?php
$rek_tabungan=mysqli_real_escape_string($con,$_GET['rek_tabungan']);
$sql=mysqli_query($con,"select * from tabungan_anggota a inner join anggota b on a.id_anggota = b.id_anggota inner join produk_bmt c on a.id_produk = c.id_produk where a.rek_tabungan = '$rek_tabungan'") or die (mysqli_error($con));
$data=mysqli_fetch_array($sql);

$sql2=mysqli_query($con,"select * from simpanan_anggota WHERE rek_tabungan = '$rek_tabungan'") or die (mysqli_error($con));
$data2=mysqli_fetch_array($sql2);
$total_simpanan = $data2['total_simpanan'];
?>
<h3><i class="fa fa-angle-right"></i> Setor Tabungan <?php echo $data['nama_produk'] ?></h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Admin/User</h4>
            <form class="form-horizontal style-form" method="post">
              <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">No. Rek</label>
                    <div class="col-sm-10">
                        <input type="text" name="rek_tabungan" value="<?php echo $data['rek_tabungan'] ?>" class="form-control" readonly>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                       <input type="text" value="<?php echo $data['nama_lengkap'] ?>" class="form-control" readonly>
                        <input type="hidden" name="id_anggota" value="<?php echo $data['id_anggota'] ?>" class="form-control">
                    </div>
                </div>  
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Produk Tabungan</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $data['nama_produk'] ?>" class="form-control" readonly>
                        <input type="hidden" name="id_produk" value="<?php echo $data['id_produk'] ?>" class="form-control">
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nominal</label>
                    <div class="col-sm-10">
                        <input type="number" name="nominal" max="<?php echo $total_simpanan ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                   <a href="?page=tabungan_anggota" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {
  
$id_anggota=mysqli_real_escape_string($con,@$_POST['id_anggota']);
$rek_tabungan=mysqli_real_escape_string($con,@$_POST['rek_tabungan']);
$id_produk=mysqli_real_escape_string($con,@$_POST['id_produk']);
$nominal=mysqli_real_escape_string($con,@$_POST['nominal']);
$tgl = date('Y:m:d H:i:s');

mysqli_query($con, "INSERT INTO tabungan_anggota (id_tabungan, rek_tabungan, id_anggota, id_produk, nominal, status, tgl_setor) values (null,'$rek_tabungan','$id_anggota','$id_produk','$nominal','Tarik','$tgl')") or die (mysqli_error($con));

 mysqli_query($con, "UPDATE simpanan_anggota set total_simpanan = total_simpanan - '$nominal' WHERE rek_tabungan='$rek_tabungan' ") or die (mysqli_error($con));
echo "<script>window.location.href='?page=tabungan_anggota';</script>";
    
}
?>