

   <section class="content-header">
      <h1>
        Buat SPPD
        <small>...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master Data</a></li>
        <li class="active">Golongan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
    <div class="col-xs-12">
    <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Form &amp; Surat Perintah Perjalanan Dinas</h3>
            </div>
            <div class="box-body">
            <?php
		  	include 'config/koneksi.php';
		  	$data = mysqli_query($koneksi,"select * from pegawai");
					while($d = mysqli_fetch_array($data)){
					
		 	?>
		 	<?php
            
		    }
		    ?>
              <!-- Color Picker -->
              <form method="GET" name="formTambah" id="formTambah" action="simpanSppd.php">
										<table width="100%" border="0" align="center">
										<tr>
											<td width="200">Lembar ke</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="number" name="Lembar_ke" id="Lembar_ke"  />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Kode No</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="number" name="Kode_No" id="Kode_No"  />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Nomor</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="number" name="Nomor" id="Nomor" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Pejabat pembuat komitmen</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="pejabat" id="pejabat" required />
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
											<td width="200">Pangkat</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Pangkat" id="Pangkat" required />
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
											<td width="200">Tingkat Biaya Perjadin</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Biaya" id="Biaya" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="">Maksud</td>
											<td width=""><div align="left"> :</div></td>
											<td width=""><label>
												<div class="box-body pad">
									              <form>
									                    <textarea id="editor1" name="editor1" rows="10" cols="80" style="visibility: hidden; display: none;"> This is my textarea to be replaced with CKEditor.
									                    </textarea>
										
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Transportasi</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Transportasi" id="Transportasi" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Tempat Berangkat</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Tempat_Berangkat" id="Tempat_Berangkat" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Tempat Tujuan</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Tempat_Tujuan" id="Tempat_Tujuan" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Lama Perjadin</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Lama_Perjadin" id="Lama_Perjadin" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Tanggal Berangkat</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
											<div class="input-group date">
                  								<div class="input-group-addon">
                    								<i class="fa fa-calendar"></i>
                 	 							</div>
                  								<input type="text" class="form-control pull-right" id="datepicker" name="Tanggal_Berangkat">
                							</div>
                							</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Tanggal Kembali</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
											<div class="input-group date">
                  								<div class="input-group-addon">
                    								<i class="fa fa-calendar"></i>
                 	 							</div>
                  								<input type="text" class="form-control pull-right" id="datepicker" name="Tanggal_Kembali">
                							</div>
                							</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Pengikut</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Pengikut" id="Pengikut" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200">Pembebanan Anggaran</td>
											<td width="18"><div align="left"> :</div></td>
											<td width="200"><label>
												<input type="text" name="Pembebanan_Anggaran" id="Pembebanan_Anggaran" required />
												</label>          
											</td>
										</tr>
										<tr>
											<td width="200"></td>
											<td width="18"><div align="left"> </div></td>
											<td width="200"><label>
												<button type="submit" name="simpan1" class="btn btn-primary">Save changes</button>
											</label>          
											</td>
										</tr>
										</table>
										
								</form>

            </div>
        </div>
    </div>

            <!-- /.box-body -->
          </div>
    </section>
</html>