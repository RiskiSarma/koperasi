<h3><i class="fa fa-angle-right"></i> Jenis Produk Koperasi</h3>
<div class="row mt">
    <div class="col-lg-12">
        <div class="content-panel">
            <a href="?page=jenis_produk&action=tambah" title="Tambah" class="btn btn-primary" style="margin-left: 5px">Tambah</a>
            <h4><i class="fa fa-angle-right"></i> Data Jenis Produk</h4>          
            <section id="unseen">
                <table class="table table-bordered table-striped" id="Datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Produk</th>
                            <th>Penjelasan</th>
                            <th width="10%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1;
                    $sql_jenis_produk = mysqli_query($con,"SELECT * FROM jenis_produk") or die (mysqli_error($con));
                    while($data = mysqli_fetch_array($sql_jenis_produk)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['jenis_produk'] ?></td>
                        <td><?php echo $data['desk_jenis'] ?></td>
                        <td><a class="btn btn-warning btn-xs" href="?page=jenis_produk&action=edit&id_jenis_produk=<?php echo $data['id_jenis_produk'];?>" title="Edit Data">Edit</a> 
                        <a class="btn btn-danger btn-xs" href="?page=jenis_produk&action=hapus&id_jenis_produk=<?php echo $data['id_jenis_produk'];?>" title="Hapus Data" onclick="javascript: return confirm('Apakah anda yakin?');"><i class="fa fa-trash"> Hapus</i></a></td>
                    </tr>
                    <?php 
                    }
                    ?>
                    </tbody>
                </table>
            </section>
        </div><!-- /content-panel -->
    </div>
</div>        

<?php
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "";
}

if ($action == "tambah") {
?>

<h3><i class="fa fa-angle-right"></i> Tambah Jenis Produk</h3>
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Jenis Produk</h4>
            <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" name="jenis_produk" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Deskripsi Singkat</label>
                    <div class="col-sm-10">
                        <textarea name="desk_jenis" class="form-control"></textarea>
                    </div>
                </div>
                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                   <a href="?page=jenis_produk" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
    </div>        
</div>

<?php
if (isset($_POST['simpan'])) {
    $jenis_produk = mysqli_real_escape_string($con, @$_POST['jenis_produk']);
    $desk_jenis = mysqli_real_escape_string($con, @$_POST['desk_jenis']);

    mysqli_query($con, "INSERT INTO jenis_produk (id_jenis_produk, jenis_produk, desk_jenis) VALUES (null,'$jenis_produk','$desk_jenis')") or die (mysqli_error($con));
    echo "<script>window.location.href='?page=jenis_produk';</script>";
}
} elseif ($action == "edit") {
    $id_jenis_produk = $_GET['id_jenis_produk'];
    $sql_edit = mysqli_query($con,"SELECT * FROM jenis_produk WHERE id_jenis_produk = '$id_jenis_produk'") or die (mysqli_error($con));
    $data_edit = mysqli_fetch_array($sql_edit);
?>

<h3><i class="fa fa-angle-right"></i> Edit Jenis Produk</h3>
<div class="row mt">
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Jenis Produk</h4>
            <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" name="jenis_produk" class="form-control" value="<?php echo $data_edit['jenis_produk']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Deskripsi Singkat</label>
                    <div class="col-sm-10">
                        <textarea name="desk_jenis" class="form-control"><?php echo $data_edit['desk_jenis']; ?></textarea>
                    </div>
                </div>
                
                <div class="form-group" style="margin-left: 5px"> 
                   <button type="submit" class="btn btn-primary" name="update">Update</button>
                   <a href="?page=jenis_produk" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
    </div>        
</div>

<?php
if (isset($_POST['update'])) {
    $jenis_produk = mysqli_real_escape_string($con, @$_POST['jenis_produk']);
    $desk_jenis = mysqli_real_escape_string($con, @$_POST['desk_jenis']);

    mysqli_query($con, "UPDATE jenis_produk SET jenis_produk='$jenis_produk', desk_jenis='$desk_jenis' WHERE id_jenis_produk='$id_jenis_produk'") or die (mysqli_error($con));
    echo "<script>window.location.href='?page=jenis_produk';</script>";
}
} elseif ($action == "hapus") {
    $id_jenis_produk = $_GET['id_jenis_produk'];
    mysqli_query($con, "DELETE FROM jenis_produk WHERE id_jenis_produk='$id_jenis_produk'") or die (mysqli_error($con));
    echo "<script>window.location.href='?page=jenis_produk';</script>";
}
?>
