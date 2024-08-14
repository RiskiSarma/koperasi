<?php
$sql=mysqli_query($con,"select * from profil where id_profil = 1") or die (mysqli_error($con));
$data=mysqli_fetch_array($sql);
?>
<h3><i class="fa fa-angle-right"></i> Update Profil</h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Profil BMT</h4>
            <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Sejarah</label>
                    <div class="col-sm-10">
                        <textarea name="sejarah" class="form-control" rows="8"><?php echo $data['sejarah'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Visi & Misi</label>
                    <div class="col-sm-10">
                        <textarea name="visi_misi" class="form-control" rows="8"><?php echo $data['visi_misi'] ?></textarea>
                    </div>
                </div>
                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Update Profil</button>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {   
  $sejarah=mysqli_real_escape_string($con,@$_POST['sejarah']);
  $visi_misi=mysqli_real_escape_string($con,@$_POST['visi_misi']);

  mysqli_query($con, "UPDATE profil set sejarah='$sejarah', visi_misi='$visi_misi' WHERE id_profil=1 ") or die (mysqli_error($con));
  echo "<script>window.location.href='?page=profil';</script>";
    

}
?>