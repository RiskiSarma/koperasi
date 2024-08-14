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