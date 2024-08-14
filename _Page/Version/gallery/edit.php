<?php
$id_gallery=mysqli_real_escape_string($con,$_GET['id_gallery']);
$sql=mysqli_query($con,"select * from gallery where id_gallery = '$id_gallery'") or die (mysqli_error($con));
$data=mysqli_fetch_array($sql);
?>
<h3><i class="fa fa-angle-right"></i> Edit Galleri</h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Galleri</h4>
            <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">
               <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul_gallery" value="<?php echo $data['judul_gallery'] ?>" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Poto</label>
                    <div class="col-sm-10">
                        <input type="file" name="foto_gallery" class="form-control"><small>Ukuran File : max 5 mb | Ukuran Poto : 400 x 300 | Format file : jpg, png </small><br>
                        <input type="hidden" name="poto_lama" value="<?php echo $data['foto_gallery'];?>">
                        <img src="gallery/poto/<?php echo $data['foto_gallery'];?>" alt="<?php echo $data['judul_gallery'] ?>" width="200">
                        
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caption</label>
                    <div class="col-sm-10">
                        <input type="text" name="caption_gallery" value="<?php echo $data['caption_gallery'] ?>" class="form-control">
                    </div>
                </div>
                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Update</button>
                   <a href="?page=gallery" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {
  
  $id_gallery=mysqli_real_escape_string($con,@$_GET['id_gallery']);    
  $judul_gallery=mysqli_real_escape_string($con,@$_POST['judul_gallery']);
  $caption_gallery=mysqli_real_escape_string($con,@$_POST['caption_gallery']);
  $poto_lama = mysqli_real_escape_string($con,@$_POST['poto_lama']);
  $ekstensi_diperbolehkan = array('png','jpg');
  $poto = $_FILES['foto_gallery']['name'];
  $x = explode('.', $poto);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['foto_gallery']['size'];

  if(empty($poto)){
    mysqli_query($con, "UPDATE gallery set judul_gallery='$judul_gallery', caption_gallery='$caption_gallery' WHERE id_gallery='$id_gallery' ") or die (mysqli_error($con));
  } else {
    
     if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 5044070){             
           $query=mysqli_query($con, "UPDATE gallery set judul_gallery='$judul_gallery', foto_gallery='$poto', caption_gallery='$caption_gallery' WHERE id_gallery='$id_gallery'") or die (mysqli_error($con));
           move_uploaded_file($_FILES['foto_gallery']['tmp_name'], 'gallery/poto/'.$poto);
           if(file_exists('gallery/poto/'.$poto_lama)){
              unlink('gallery/poto/'.$poto_lama);
           }         
          if($query){
              echo "<script>window.location.href='?page=gallery';</script>";
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
  
  echo "<script>window.location.href='?page=gallery';</script>";
    

}
?>