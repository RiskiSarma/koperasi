<?php
$id_admin=mysqli_real_escape_string($con,$_GET['id_admin']);
$sql=mysqli_query($con,"select * from admin where id_admin = '$id_admin'") or die (mysqli_error($con));
$data=mysqli_fetch_array($sql);
?>
<h3><i class="fa fa-angle-right"></i> Edit Data Admin/User</h3>
<!-- BASIC FORM ELELEMNTS -->
	<div class="row mt">
		<div class="col-lg-12">
        <div class="form-panel">
        	  <h4 class="mb"><i class="fa fa-angle-right"></i> Admin/User</h4>
            <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_admin" value="<?php echo $data['nama_admin'] ?>" class="form-control">
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">No Hp</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_hp" class="form-control" value="<?php echo $data['no_hp'] ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" value="<?php echo $data['email'] ?>"><small class="text-danger">*mengubah email tidak mengubah username</small>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" value="<?php echo $data['username'] ?>" class="form-control" readonly><small class="text-danger">*Username tak dapat diubah</small>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="pass_admin" class="form-control"><small class="text-info">*Isi jika ingin mengubah password</small>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat_admin" class="form-control"> <?php echo $data['alamat_admin'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Level</label>
                    <div class="col-sm-10">
                        <select name="level_admin" class="form-control">
                          <option value="Administrator" <?php if($data['level_admin']=="Administrator") { echo 'selected'; } ?> >Administrator</option>
                          <option value="Petugas" <?php if($data['level_admin']=="Petugas") { echo 'selected'; } ?>>Petugas</option> 
                          <option value="Kepala" <?php if($data['level_admin']=="Kepala") { echo 'selected'; } ?>>Kepala</option> 
                        </select>
                    </div>
                </div>
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                   <a href="?page=admin-user" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
		</div><!-- col-lg-12-->      	
	</div><!-- /row -->
</div>
<?php
  if (isset($_POST['simpan'])) {
  
  $id_admin=mysqli_real_escape_string($con,@$_GET['id_admin']);    
  $nama_admin=mysqli_real_escape_string($con,@$_POST['nama_admin']);
  $no_hp=mysqli_real_escape_string($con,@$_POST['no_hp']);
  $email=mysqli_real_escape_string($con,@$_POST['email']);
  $pass_admin=mysqli_real_escape_string($con,@$_POST['pass_admin']);
  $pass=md5($pass_admin);
  $alamat_admin=mysqli_real_escape_string($con,@$_POST['alamat_admin']);
  $level_admin=mysqli_real_escape_string($con,@$_POST['level_admin']);

  if($pass_admin != ""){
    mysqli_query($con, "UPDATE admin set nama_admin='$nama_admin', no_hp='$no_hp', email='$email', pass_admin='$pass', alamat_admin='$alamat_admin', level_admin='$level_admin' WHERE id_admin='$id_admin' ") or die (mysqli_error($con));    
  } else {
    mysqli_query($con, "UPDATE admin set nama_admin='$nama_admin', no_hp='$no_hp', email='$email', alamat_admin='$alamat_admin', level_admin='$level_admin' WHERE id_admin='$id_admin' ") or die (mysqli_error($con));
  }
  echo "<script>window.location.href='?page=admin-user';</script>";
    
}
?>