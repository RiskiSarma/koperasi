<?php
$sql=mysqli_query($con,"select * from konfigurasi_web where id_konfigurasi = 1") or die (mysqli_error($con));
$data=mysqli_fetch_array($sql);
?>
<h3><i class="fa fa-angle-right"></i> Edit Konfigurasi Web</h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Konfigurasi Web</h4>
            <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">
               <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Link FB</label>
                    <div class="col-sm-10">
                        <input type="text" name="link_fb" value="<?php echo $data['link_fb'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Link IG</label>
                    <div class="col-sm-10">
                        <input type="text" name="link_ig" value="<?php echo $data['link_ig'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">No. WA</label>
                    <div class="col-sm-10">
                        <input type="number" name="no_wa" value="<?php echo $data['no_wa'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" class="form-control"><?php echo $data['alamat'] ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Deskripsi Singkat</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi_singkat" class="form-control"><?php echo $data['deskripsi_singkat'] ?></textarea>
                    </div>
                </div> 
                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Update</button>
                   <a href="?page=konfigurasi" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {
  
  $id_konfigurasi=mysqli_real_escape_string($con,@$_GET['id_konfigurasi']);    
  $link_fb=mysqli_real_escape_string($con,@$_POST['link_fb']);
  $link_ig=mysqli_real_escape_string($con,@$_POST['link_ig']);
  $no_wa=mysqli_real_escape_string($con,@$_POST['no_wa']);
  $alamat=mysqli_real_escape_string($con,@$_POST['alamat']);
  $deskripsi_singkat=mysqli_real_escape_string($con,@$_POST['deskripsi_singkat']);

  mysqli_query($con, "UPDATE konfigurasi_web set link_fb='$link_fb', link_ig='$link_ig', no_wa='$no_wa', alamat='$alamat', deskripsi_singkat='$deskripsi_singkat' WHERE id_konfigurasi=1 ") or die (mysqli_error($con));
  echo "<script>window.location.href='?page=konfigurasi';</script>";
    

}
?>