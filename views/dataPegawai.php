
   
   <section class="content-header">
      <h1>
        Data Pegawai 
        <small>Dinas Pendidikan Kota Kediri</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Data Pegawai</a></li>
        <li class="active"></li>
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
              <h3 class="box-title">Data Pegawai</h3>
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
					  <th>NIP</th>
					  <th>Nama</th>
					  <th>Tanggal Lahir</th>
					  <th>Jabatan</th>
					  <th>Pangkat</th>
					  <th>Golongan</th>
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
	                      $sql = "SELECT * FROM pegawai where Nama LIKE '%$pencarian%'";
	                      $query = $sql;
	                      $queryJml = $sql;
	                    } else {
	                      $query = "SELECT * FROM pegawai LIMIT $posisi, $batas";
	                      $queryJml = "SELECT * FROM pegawai";
	                      $no = $posisi + 1;
	                    }
	                  } else {
	                      $query = "SELECT * FROM pegawai LIMIT $posisi, $batas";
	                      $queryJml = "SELECT * FROM pegawai";
	                      $no = $posisi + 1;
	                  }



					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					if (mysqli_num_rows($data) > 0) {
						while($d = mysqli_fetch_array($data)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d['NIP']; ?></td>
							<td><?php echo $d['Nama']; ?></td>
							<td><?php echo $d['Tanggal_Lahir']; ?></td>
							<td><?php echo $d['Jabatan']; ?></td>
							<td><?php echo $d['Pangkat']; ?></td>
							<td><?php echo $d['Golongan']; ?></td>
							<td class="text-left"> 
		                      <a href="#" type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal<?php echo $d['NIP']; ?>"> <ic class="glyphicon glyphicon-edit"></i></a>
		                      <a href="hapusPeg.php?NIP=<?php echo $d['NIP']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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
					$data = mysqli_query($koneksi,"select * from pegawai");
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
										<form method="GET" name="formTambah" id="formTambah" action="simpanPeg.php">
												<table width="50%" border="0" align="center">
												<tr>
													<td width="200">NIP</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="NIP" id="NIP" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Nama</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="Nama" id="Nama" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Tanggal Lahir</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<!--<input type="text" name="Tanggal_Lahir" id="Tanggal_Lahir" required /> -->
														<input type="date" name="Tanggal_Lahir" id="datepicker">
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Jabatan</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="Jabatan" id="Jabatan" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Pangkat</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="Pangkat" id="Pangkat" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Golongan</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="Golongan" id="Golongan" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200"></td>
													<td width="18"><div align="left"> </div></td>
													<td width="200"><label>
														<button type="submit" name="simpan" class="btn btn-primary">Save </button>
													</label>          
													</td>
												</tr>
												</table>
												
										</form>
						  </div>
						  <div class="modal-footer">
						
						  </div>
						 
						</div>
					  </div>
					</div>


					<!-- Modal FOR eDIT -->
					<div class="modal fade" id="myModal<?php echo $d['NIP']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel1">Edit Data Pegawai</h4>
						  </div>
						  <div class="modal-body">
										<form method="GET" name="formEdit" id="formEdit" action="editPeg.php">
											<?php
					                        $NIP = $d['NIP']; 
					                        $query_edit = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE NIP='$NIP'");
					                        while ($row = mysqli_fetch_array($query_edit)) {  
					                        ?>
												<table width="50%" border="0" align="center">
												<tr>
													<td width="200">NIP</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input  type="text" value="<?php echo $d['NIP']; ?>"  name="NIP" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Nama</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" value="<?php echo $d['Nama']; ?>" name="Nama" id="Nama" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Tanggal Lahir</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<!--<input type="text" name="Tanggal_Lahir" id="Tanggal_Lahir" required /> -->
														<input name="Tanggal_Lahir" id="datepicker" type="date" value="<?php echo $d['Tanggal_Lahir']; ?>" >
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Jabatan</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" value="<?php echo $d['Jabatan']; ?>" name="Jabatan" id="Jabatan" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Pangkat</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" value="<?php echo $d['Pangkat']; ?>" name="Pangkat" id="Pangkat" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Golongan</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" value="<?php echo $d['Golongan']; ?>" name="Golongan" id="Golongan" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200"></td>
													<td width="18"><div align="left"> </div></td>
													<td width="200"><label>
														<button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
													</label>          
													</td>
												</tr>
												</table>
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