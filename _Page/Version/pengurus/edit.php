<?php
$id_pengurus=mysqli_real_escape_string($con,$_GET['id_pengurus']);
$sql=mysqli_query($con,"select * from pengurus where id_pengurus = '$id_pengurus'") or die (mysqli_error($con));
$data=mysqli_fetch_array($sql);
?>
<h3><i class="fa fa-angle-right"></i> Tambah Pengurus</h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Pengurus</h4>
            <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">
               <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_pengurus" value="<?php echo $data['nama_pengurus'] ?>" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Poto</label>
                    <div class="col-sm-10">
                        <input type="file" name="poto" class="form-control"><small>Ukuran File : max 5 mb | Ukuran Poto : 272 x 303 | Format file : jpg, png </small><br>
                        <input type="hidden" name="poto_lama" value="<?php echo $data['poto_pengurus'];?>">
                        <img src="pengurus/poto/<?php echo $data['poto_pengurus'];?>" alt="<?php echo $data['nama_pengurus'] ?>" width="200">
                        
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jabatan_pengurus" value="<?php echo $data['jabatan_pengurus'] ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Update</button>
                   <a href="?page=pengurus" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {
  
  $id_pengurus=mysqli_real_escape_string($con,@$_GET['id_pengurus']);    
  $nama_pengurus=mysqli_real_escape_string($con,@$_POST['nama_pengurus']);
  $jabatan_pengurus=mysqli_real_escape_string($con,@$_POST['jabatan_pengurus']);
  $poto_lama = mysqli_real_escape_string($con,@$_POST['poto_lama']);
  $ekstensi_diperbolehkan = array('png','jpg');
  $poto = $_FILES['poto']['name'];
  $x = explode('.', $poto);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['poto']['size'];

  if(empty($poto)){
    mysqli_query($con, "UPDATE pengurus set nama_pengurus='$nama_pengurus', jabatan_pengurus='$jabatan_pengurus' WHERE id_pengurus='$id_pengurus' ") or die (mysqli_error($con));
  } else {
    
     if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 5044070){             
           $query=mysqli_query($con, "UPDATE pengurus set nama_pengurus='$nama_pengurus', poto_pengurus='$poto', jabatan_pengurus='$jabatan_pengurus' WHERE id_pengurus='$id_pengurus'") or die (mysqli_error($con));
           move_uploaded_file($_FILES['poto']['tmp_name'], 'pengurus/poto/'.$poto);
           if(file_exists('pengurus/poto/'.$poto_lama)){
              unlink('pengurus/poto/'.$poto_lama);
           }          
          if($query){
              echo "<script>window.location.href='?page=pengurus';</script>";
          }else{
            echo '<strong class="text-danger">GAGAL MENGUPLOAD GAMBAR</strong>';
          }
        }else{
          echo '<strong class="text-danger">UKURAN FILE TERLALU BESAR</strong>';
        }
      }else{
        echo '<strong class="text-danger">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</strong>';
      }
  }
  
  echo "<script>window.location.href='?page=pengurus';</script>";
    

}
?>