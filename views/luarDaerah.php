<section class="content-header">
      <h1>
        Standar Belanja Luar Daerah
        <small>...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Standar Belanja</a></li>
        <li class="active">Luar Daerah</li>
      </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-2">
		    		<label>
		          	<a href="" class="btn btn-default btn-sm"> <i class="glyphicon glyphicon-refresh"></i></a>
		    			<button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>   Tambah</button></label>
		    	</div>
			</div>
			<div class="box box-info">
				<div class="box-header">
              		<h3 class="box-title">Tabel &amp; Luar Daerah</h3>
            	</div>
            	<div class="box-body">
            		<?php
			  	include 'config/koneksi.php';
			 	?>
	              <table  class="table table-bordered table-striped" id="datatables">
	                <thead>
						<tr>
						  <th>No</th>
						  <th>Uraian</th>
						  <th>Volume</th>
						  <th>Satuan</th>
						  <th>Harga</th>
						  <th>Jumlah</th>
						  <th>Action</th>
						</tr>
	                </thead>
	                <tbody>
						<?php
						$no =1;
						$data = mysqli_query($koneksi,"select * from luardaerah");
						while($d = mysqli_fetch_array($data)){
						?>

						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $d['uraian']; ?></td>
							<td><?php echo $d['volume']; ?></td>
							<td><?php echo $d['satuan']; ?></td>
							<td><?php echo $d['harga']; ?></td>
							<td><?php echo $d['jumlah']; ?></td>
							<td>

								<a href="#" type="button" class="label label-primary" data-toggle="modal" data-target="#myModal<?php echo $d['NIP']; ?>">Edit</a>
								<a href="hapusluarDaerah.php?no=<?php echo $d['no']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
							</td>
						</tr>
						<?php
	            
			           }
			           ?>
						
					</tbody>
	              </table>
            	</div>
			</div>
			<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Tambah Data Standar Belanja</h4>
							<small>Luar Daerah</small>
						  </div>
						  <div class="modal-body">
						  	<div class="box box-info">
						  		<br>
						  				<form method="GET" name="formTambah" id="formTambah" action="simpanluarDaerah.php">
												<table width="50%" border="0" align="center">
												<tr>
													<td width="200">Uraian</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="uraian" id="uraian" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Volume</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="volume" id="volume" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Satuan</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="satuan" id="satuan" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Harga</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="harga" id="harga" required />
														</label>          
													</td>
												</tr>
												<tr>
													<td width="200">Jumlah</td>
													<td width="18"><div align="left"> :</div></td>
													<td width="200"><label>
														<input type="text" name="jumlah" id="jumlah" required />
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
						  </div>
						  <div class="modal-footer">
						
						  </div>
						 
						</div>
					  </div>
					</div>
		</div>
	</div>
</section>