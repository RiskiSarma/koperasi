<h3><i class="fa fa-angle-right"></i> Tambah Data Galleri</h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Data Galleri</h4>
            <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul_gallery" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Poto</label>
                    <div class="col-sm-10">
                        <input type="file" name="foto_gallery" class="form-control">
                        <small>Ukuran File : max 5 mb | Ukuran Poto : 400 x 300 | Format file : jpg, png </small>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caption</label>
                    <div class="col-sm-10">
                        <input type="text" name="caption_gallery" class="form-control">
                    </div>
                </div>                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                   <a href="?page=gallery" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {
      
  $judul_gallery=mysqli_real_escape_string($con,@$_POST['judul_gallery']);
  $caption_gallery=mysqli_real_escape_string($con,@$_POST['caption_gallery']);

  $ekstensi_diperbolehkan = array('png','jpg');
  $poto = $_FILES['foto_gallery']['name'];
  $x = explode('.', $poto);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['foto_gallery']['size'];
  // $file_tmp = $_FILES['poto']['tmp_name'];


  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 5044070){                
           $query=mysqli_query($con, "INSERT INTO gallery (id_gallery, judul_gallery, foto_gallery, caption_gallery) values (null,'$judul_gallery','$poto','$caption_gallery')") or die (mysqli_error($con));
           move_uploaded_file($_FILES['foto_gallery']['tmp_name'], 'gallery/poto/'.$poto);
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
?>