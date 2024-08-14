<h3><i class="fa fa-angle-right"></i> Galleri BMT</h3>
<div class="row mt">
	<div class="col-lg-12">
		<div class="content-panel">
			<a href="?page=gallery&action=tambah" title="Tambah" class="btn btn-primary" style="margin-left: 5px">Tambah</a>
          <h4><i class="fa fa-angle-right"></i> Data Galleri</h4>          
              <section id="unseen">
                <table class="table table-bordered table-striped" id="Datatables">
                  <thead>
                  <tr>
	                  <th>No</th>
                      <th>Nama</th>
                      <th>Jabatan</th>
                      <th>Poto</th>
                      <th width="10%">Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $no = 1;
                  $sql_gallery = mysqli_query($con,"SELECT * FROM gallery") or die (mysqli_error($con));
					while($data = mysqli_fetch_array($sql_gallery)){
                  ?>
                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $data['judul_gallery'] ?></td>
                      <td><?php echo $data['caption_gallery'] ?></td>
                      <td><img src="gallery/poto/<?php echo $data['foto_gallery'];?>" alt="<?php echo $data['foto_gallery'] ?>" width="200"></td>
                      <td><a class="btn btn-warning btn-xs" href="?page=gallery&action=edit&id_gallery=<?php echo $data['id_gallery'];?>" title="Edit Data">Edit</a> 
            	<a class="btn btn-danger btn-xs" href="?page=gallery&action=hapus&id_gallery=<?php echo $data['id_gallery'];?>" title="Hapus Data" onclick="javascript: return confirm('Apakah anda yakin?');"><i class="fa fa-trash"> Hapus</i></a></td>
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