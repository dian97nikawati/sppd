
   
   <section class="content-header">
      <h1>
        Data Akun
        <small>Dinas Pendidikan Kota Kediri</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master Data</a></li>
        <li class="active">Data Akun</li>
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
		            <input type="text" name="pencarian" class="form-control" placeholder="Pencarian">
		          </div>
		          <div class="form-group">
		            <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		          </div>
		        </form>
		      </div>
		    </div>
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Akun</h3>
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
					  <th>MAK</th>
					  <th>Uraian</th>
					  <th>Pagu</th>
					  <th>Realisasi</th>
					  <th>Sisa</th>
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
	                      $sql = "SELECT * FROM akun where uraian LIKE '%$pencarian%'";
	                      $query = $sql;
	                      $queryJml = $sql;
	                    } else {
	                      $query = "SELECT * FROM akun LIMIT $posisi, $batas";
	                      $queryJml = "SELECT * FROM akun";
	                      $no = $posisi + 1;
	                    }
	                  } else {
	                      $query = "SELECT * FROM akun LIMIT $posisi, $batas";
	                      $queryJml = "SELECT * FROM akun";
	                      $no = $posisi + 1;
	                  }



					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					if (mysqli_num_rows($data) > 0) {
						while($d = mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d['mak']; ?></td>
							<td><?php echo $d['uraian']; ?></td>
							<td><?php echo $d['pagu']; ?></td>
							<td><?php echo $d['realisasi']; ?></td>
							<td><?php echo $d['sisa']; ?></td>
							<td class="text-left"> 
		                      <a href="#" type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal<?php echo $d['id_akun']; ?>"> <ic class="glyphicon glyphicon-edit"></i></a>
		                      <a href="hapusAkun.php?id_akun=<?php echo $d['id_akun']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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
					$data = mysqli_query($koneksi,"select * from akun");
					while($d = mysqli_fetch_array($data)){
					?>
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Tambah Data Pegawai</h4>
						  </div>
						  <div class="modal-body">
										<form method="POST" name="formTambah" id="formTambah" action="simpanAkun.php">
											<div class="form-group" >
										        <label for="mak">MAK:</label>
										    	<input type="text" name="mak" class="form-control" >
										    </div>	
										    <div class="form-group">
										        <label for="uraian">Uraian:</label>
										        <input type="text" name="uraian" id="uraian" class="form-control" >
										        <!-- <input type="text" name="kepalabidang" class="form-control" > -->
										    </div>
										    <div class="form-group">
										        <label for="pagu">Pagu:</label>
										        <input type="text" name="pagu" id="pagu" class="form-control" onfocus="mulaiHitung()" onblur="berhentiHitung()">
										    </div>
										    <div class="form-group">
										        <label for="realisasi">Realisasi:</label>
										        <input type="text" name="realisasi" id="realisasi" class="form-control" onfocus="mulaiHitung()" onblur="berhentiHitung()" >
										    </div>
										    <div class="form-group">
										        <label for="sisa">Sisa:</label>
										        <input type="text" value="" name="sisa" id="sisa" class="form-control" >
										    </div>
											<div>
												<label>
												    <button type="submit" name="simpan" class="btn btn-primary" >Simpan </button>
												</label>
											</div>
											<script type="text/javascript">
										    	function mulaiHitung(){
										    		Interval = setInterval("hitung()",1);
										    	}
										    	function hitung(){
										    		pagu 	   = parseInt(document.getElementById("pagu").value);
										    		realisasi  = parseInt(document.getElementById("realisasi").value);
										    		sisa 	   = pagu - realisasi ;
										    		document.getElementById("sisa").value = sisa;
										    	}
										    	function berhentiHitung(){
										    		clearInterval(Interval);
										    	}

										    </script>	
										</form>
						  </div>
						  <div class="modal-footer">
						
						  </div>
						 
						</div>
					  </div>
					</div>


					<!-- Modal FOR eDIT -->
					<div class="modal fade" id="myModal<?php echo $d['id_akun']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel1">Edit Data Akun</h4>
						  </div>
						  <div class="modal-body">
										<form method="POST" name="formEdit" id="formEdit" action="editAkun.php">
											<?php
					                        $id_akun = $d['id_akun']; 
					                        $query_edit = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_akun='$id_akun'");
					                        while ($row = mysqli_fetch_array($query_edit)) {  
					                        ?>
												<div class="form-group" >
										        <label for="mak">Mak :</label>
										    	<input type="text" value="<?php echo $d['mak']; ?>" name="mak" id="mak" class="form-control" >
										    </div>	
										    <div class="form-group">
										        <label for="uraian">Uraian :</label>
										        <input type="text" value="<?php echo $d['uraian']; ?>" name="uraian" id="uraian" class="form-control" >
										    </div>
										    <div class="form-group">
										        <label for="pagu">Pagu :</label>
										        <input type="text" value="<?php echo $d['pagu']; ?>" name="pagu" id="pagu" class="form-control" onfocus="mulaiHitung()" onblur="berhentiHitung()">
										    </div>
										    <div class="form-group">
										        <label for="realisasi">Realisasi :</label>
										        <input type="text" value="<?php echo $d['realisasi']; ?>" name="realisasi" id="realisasi" class="form-control" onfocus="mulaiHitung()" onblur="berhentiHitung()">
										    </div>
										    <div class="form-group">
										        <label for="sisa">Sisa :</label>
										        <input type="text" name="sisa" id="sisa" class="form-control" >
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
    										<script type="text/javascript">
										    	function mulaiHitung(){
										    		Interval = setInterval("hitung()",1);
										    	}
										    	function hitung(){
										    		pagu 	   = parseInt(document.getElementById("pagu").value);
										    		realisasi  = parseInt(document.getElementById("realisasi").value);
										    		sisa 	   = pagu - realisasi ;
										    		document.getElementById("sisa").value = sisa;
										    	}
										    	function berhentiHitung(){
										    		clearInterval(Interval);
										    	}

										    </script>
    </section>
