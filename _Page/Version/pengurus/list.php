<h3><i class="fa fa-angle-right"></i> Jenis Pengurus Koperasi HW</h3>
<div class="row mt">
	<div class="col-lg-12">
		<div class="content-panel">
			<a href="?page=pengurus&action=tambah" title="Tambah" class="btn btn-primary" style="margin-left: 5px">Tambah</a>
          <h4><i class="fa fa-angle-right"></i> Data Pengurus</h4>          
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
                  $sql_pengurus = mysqli_query($con,"SELECT * FROM pengurus") or die (mysqli_error($con));
					while($data = mysqli_fetch_array($sql_pengurus)){
                  ?>
                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $data['nama_pengurus'] ?></td>
                      <td><?php echo $data['jabatan_pengurus'] ?></td>
                      <td><img src="pengurus/poto/<?php echo $data['poto_pengurus'];?>" alt="<?php echo $data['nama_pengurus'] ?>" width="200"></td>
                      <td><a class="btn btn-warning btn-xs" href="?page=pengurus&action=edit&id_pengurus=<?php echo $data['id_pengurus'];?>" title="Edit Data">Edit</a> 
            	<a class="btn btn-danger btn-xs" href="?page=pengurus&action=hapus&id_pengurus=<?php echo $data['id_pengurus'];?>" title="Hapus Data" onclick="javascript: return confirm('Apakah anda yakin?');"><i class="fa fa-trash"> Hapus</i></a></td>
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