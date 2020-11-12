
   
   <section class="content-header">
      <h1>
        Data Bidang 
        <small>Dinas Pendidikan Kota Kediri</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master Data</a></li>
        <li class="active">Bidang</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        	<div class="row">
		    	<div class="col-xs-9">
		    		<label>
		          <a href="" class="btn btn-default btn-sm"> <i class="glyphicon glyphicon-refresh"></i></a>
		    			<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>   Tambah</button></label>
		    	</div>
		      <div style="margin-bottom: 20px;">
		        <form class="form-inline" action="" method="post">
		          <div class="form-group" >
		            <input type="text" name="pencarian" class="form-control" placeholder="Ketikkan Nama Bidang">
		          </div>
		          <div class="form-group">
		            <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		          </div>
		        </form>
		      </div>
		    </div>
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tabel Data Bidang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php
		  	include 'config/koneksi.php';
		 	?>
              <table  class="table table-bordered table-striped" id="datatables">
                <thead>
					<tr>
					  <th>No</th>
					  <th>Nama Bidang</th>
					  <th>Kepala Bidang</th>
					  <th>Kepala Sub Bidang</th>
					  <th>Action</th>
					</tr>
                </thead>
                <tbody>
                	<?php
	                  $batas=1000;
	                  $hal = @$_GET['hal'];
	                  if(empty($hal)) {
	                    $posisi = 0;
	                    $hal = 1 ;
	                  } else {
	                    $posisi = ($hal - 1) * $batas;
	                  }
	                  $no =1;
	                  if($_SERVER['REQUEST_METHOD'] == "POST") {
	                    $pencarian = trim(mysqli_real_escape_string($koneksi, $_POST['pencarian']));
	                    if($pencarian != '') {
	                      $sql = "SELECT * FROM bidang where nama_bidang LIKE '%$pencarian%'";
	                      $query = $sql;
	                      $queryJml = $sql;
	                    } else {
	                      $query = "SELECT * FROM bidang LIMIT $posisi, $batas";
	                      $queryJml = "SELECT * FROM bidang";
	                      $no = $posisi + 1;
	                    }
	                  } else {
	                      $query = "SELECT * FROM bidang LIMIT $posisi, $batas";
	                      $queryJml = "SELECT * FROM bidang";
	                      $no = $posisi + 1;
	                  }



					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					if (mysqli_num_rows($data) > 0) {
						while($d = mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d['nama_bidang']; ?></td>
							<td><?php echo $d['kepala_bidang']; ?></td>
							<td><?php echo $d['kepala_sub']; ?></td>
							<td class="text-left"> 
		                      <a href="#" type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal<?php echo $d['id_bidang']; ?>"> <ic class="glyphicon glyphicon-edit"></i></a>
		                      <a href="hapusBidang.php?id_bidang=<?php echo $d['id_bidang']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
		                    </td>
						</tr>
						<?php
					}
					
					}else {
						echo "<tr><td colspan=\"4\" align=\" center\"> Data tidak ditemukan </td><tr>";
					}
		           ?>
					
				</tbody>
              </table>
            </div>	
            <?php
            if(empty($_POST['pencarian'])) { ?>
              <div style="float:left;">
                <?php
                $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
                echo "Jumlah data : <b>$jml</b>";
                ?>
              </div>
              <div style="float:right;">
                <ul class="pagination pagination-sm" style="margin:0"> 
                  <?php 
                  $jml_hal = ceil($jml / $batas);
                  for ($i=1; $i <= $jml_hal ; $i++) { 
                    if($i != $hal) {
                      echo "<li><a href=\"?hal=$i\">$i</a></li>";
                    } else {
                      echo "<li class=\"active\"><a>$i</a></li>";
                    }
                  }
                  ?>
                </ul>
              </div>
              <?php
            } else { 
              echo "<div style=\"float:left;\">";
              $jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
              echo "Data hasil pencarian: <b>$jml</b>";
              echo "</div>";
            }
            ?>

					<?php
					$no =1;
					$data = mysqli_query($koneksi,"select * from bidang");
					while($d = mysqli_fetch_array($data)){
					?>
					<!-- Modal -->
					<div class="modal-default">
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Tambah Data Bidang</h4>
						  </div>
						  <div class="modal-body" >
								<form method="POST" name="formTambah" id="formTambah" action="simpanBidang.php" >
									<div class="form-group" >
								        <label for="namabidang">Nama Bidang:</label>
								    	<input type="text" name="namabidang" class="form-control" >
								    </div>	
								    <div class="form-group">
								        <label for="kepalabidang">Kepala Bidang:</label>
								        <select name="kepalabidang" id="kepalabidang" class="form-control" required>
								        	<option value="">- Pilih -</option>
								        	<?php 
								        	$sql_peg = mysqli_query($koneksi, "SELECT * FROM pegawai") or die (mysqli_error($koneksi));
								        	while ($data_peg = mysqli_fetch_array($sql_peg)) {
								        		echo '<option value="'.$data_peg['Nama'].'">'.$data_peg['Nama'].'</option>';
								        		# code...
								        	}?>
								        </select>
								        <!-- <input type="text" name="kepalabidang" class="form-control" > -->
								    </div>
								    <div class="form-group">
								        <label for="kepalasub">Kepala Sub Bidang:</label>
								        <select name="kepalasub" id="kepalasub" class="form-control" required>
								        	<option value="">- Pilih -</option>
								        	<?php 
								        	$sql_peg = mysqli_query($koneksi, "SELECT * FROM pegawai") or die (mysqli_error($koneksi));
								        	while ($data_peg = mysqli_fetch_array($sql_peg)) {
								        		echo '<option value="'.$data_peg['Nama'].'">'.$data_peg['Nama'].'</option>';
								        		# code...
								        	}?>
								        </select>
								    </div>
									<div>
										<label>
										    <button type="submit" name="simpan" class="btn btn-primary" >Simpan </button>
										</label>
									</div>        
								</form>
						  </div>
						  <div class="modal-footer">
						  </div>
						</div> 
					  </div>
					</div>
					</div>


					<!-- Modal FOR eDIT -->
					<div class="modal fade" id="myModal<?php echo $d['id_bidang']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel1">Edit Data Bidang</h4>
						  </div>
						  <div class="modal-body">
										<form method="GET" name="formEdit" id="formEdit" action="editBidang.php">
											<?php
					                        $id_bidang = $d['id_bidang']; 
					                        $query_edit = mysqli_query($koneksi, "SELECT * FROM bidang WHERE id_bidang='$id_bidang'");
					                        while ($row = mysqli_fetch_array($query_edit)) {  
					                        ?>
												<div class="form-group" >
										        <label for="namabidang">Nama Bidang:</label>
										    	<input type="text" value="<?php echo $d['nama_bidang']; ?>" name="namabidang" class="form-control" >
										    </div>	
										    <div class="form-group">
										        <label for="kepalabidang">Kepala Bidang:</label>
										        <select name="kepalabidang" id="kepalabidang" class="form-control" required>
										        	<option value=""><?php echo $d['kepala_bidang']; ?></option>
										        	<?php 
										        	$sql_peg = mysqli_query($koneksi, "SELECT * FROM pegawai") or die (mysqli_error($koneksi));
										        	while ($data_peg = mysqli_fetch_array($sql_peg)) {
										        		echo '<option value="'.$data_peg['Nama'].'">'.$data_peg['Nama'].'</option>';
										        		# code...
										        	}?>
										        </select>
										        <!-- <input type="text" name="kepalabidang" class="form-control" > -->
										    </div>
										    <div class="form-group">
										        <label for="kepalasub">Kepala Sub Bidang:</label>
										        <select name="kepalasub" id="kepalasub" class="form-control" required>
										        	<option value=""><?php echo $d['kepala_sub']; ?></option>
										        	<?php 
										        	$sql_peg = mysqli_query($koneksi, "SELECT * FROM pegawai") or die (mysqli_error($koneksi));
										        	while ($data_peg = mysqli_fetch_array($sql_peg)) {
										        		echo '<option value="'.$data_peg['Nama'].'">'.$data_peg['Nama'].'</option>';
										        		# code...
										        	}?>
										        </select>
										    </div>
											<div>
												<label>
												    <button type="submit" name="simpan" class="btn btn-primary" >Simpan </button>
												</label>
											</div>
										<?php 
				                        }
				                        ?>		
										</form>
					
						  </div>
						  <div class="modal-footer">
						
						  </div>
						 
						</div>
					  </div>
					</div>
					<?php
	            
		           }
		           ?>
            <!-- /.box-body -->
            
          </div>
          <!-- /.box -->
        </div>
		<!-- /.col -->
      </div>
      <!-- /.row -->
    </section>