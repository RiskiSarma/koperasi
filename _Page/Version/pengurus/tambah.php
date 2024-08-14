<h3><i class="fa fa-angle-right"></i> Tambah Data Pengurus</h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Data Pengurus</h4>
            <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_pengurus" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Poto</label>
                    <div class="col-sm-10">
                        <input type="file" name="poto" class="form-control">
                        <small>Ukuran File : max 5 mb | Ukuran Poto : 272 x 303 | Format file : jpg, png </small>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" name="jabatan_pengurus" class="form-control">
                    </div>
                </div>                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                   <a href="?page=pengurus" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {
      
  $nama_pengurus=mysqli_real_escape_string($con,@$_POST['nama_pengurus']);
  $jabatan_pengurus=mysqli_real_escape_string($con,@$_POST['jabatan_pengurus']);

  $ekstensi_diperbolehkan = array('png','jpg');
  $poto = $_FILES['poto']['name'];
  $x = explode('.', $poto);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['poto']['size'];
  // $file_tmp = $_FILES['poto']['tmp_name'];


  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 5044070){                
           $query=mysqli_query($con, "INSERT INTO pengurus (id_pengurus, nama_pengurus, poto_pengurus, jabatan_pengurus) values (null,'$nama_pengurus','$poto','$jabatan_pengurus')") or die (mysqli_error($con));
           move_uploaded_file($_FILES['poto']['tmp_name'], 'pengurus/poto/'.$poto);
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
?>