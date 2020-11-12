    <section class="content-header">
      <h1>
        Ubah SPT
        <small>...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">SPT</a></li>
        <li class="active">Ubah SPT</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="box box-solid box-primary">
        <?php
        include 'config/koneksi.php';
        ?>
            <div class="box-header">
              <b class="box-title">Data SPT yang akan diubah</b>
            </div>
            <nav aria-label="Page navigation example">
            <!-- /.box-header -->
            <div class="box-body">
              <section class="content">
                <?php
                $no = $_GET['id_spt'];
                /*$data = mysqli_query($koneksi,"select * from spt ");
                while($d = mysqli_fetch_array($data)){*/
                ?>
                      <form method="POST" name="formEdit" id="formEdit" action="editSPT.php">
                        <?php
                         /* $id_spt = $d['id_spt']; */
                          // $query = "SELECT * FROM spt INNER JOIN pegawai ON spt.nama_pelaksana = pegawai.NIP 
                          //                     INNER JOIN kota ON spt.kota_tujuan = kota.id_kota ";
                          $query_edit = mysqli_query($koneksi, "SELECT * FROM spt 
                                              INNER JOIN pegawai ON spt.nama_pelaksana = pegawai.NIP 
                                              INNER JOIN kota ON spt.kota_asal = kota.id_kota
                                              INNER JOIN bidang ON spt.bidang = bidang.id_bidang
                                              INNER JOIN akun ON spt.mak = akun.id_akun
                                              WHERE id_spt='$no'");
                          while ($row = mysqli_fetch_array($query_edit)) {  
                        ?>
                        <div class="row">
                        <div class="col-xs-3">
                          <div class="form-group" >
                              <label>Nomor SPT:</label>
                              <input type="text" value="<?php echo $row['no_spt']; ?>" name="no_spt" id="no_spt"  class="form-control" >
                          </div>
                          <div class="form-group" >
                              <label>Tanggal Berangkat:</label>
                              <input type="date" value="<?php echo $row['tgl_berangkat']; ?>" name="tgl_berangkat" id="tgl_berangkat" class="form-control" >
                          </div>  
                          <div class="form-group">
                              <label>Tanggal Kembali:</label>
                              <input type="date" value="<?php echo $row['tgl_kembali']; ?>" name="tgl_kembali" id="tgl_kembali" class="form-control" >
                          </div>
                          <div class="form-group" >
                              <label>Kota Asal:</label>
                              <select class="form-control select2" name="kota_asal" id='kota_asal' required>
                                <option value="<?php echo $row['nama_kota']; ?>"><?php echo $row['nama_kota']; ?></option>
                                <?php 
                                $sql_kota = mysqli_query($koneksi, "SELECT * FROM kota") or die (mysqli_error($koneksi));
                                while ($data_kota = mysqli_fetch_array($sql_kota)) {
                                  echo '<option value="'.$data_kota['id_kota'].'">'.$data_kota['nama_kota'].'</option>';
                                  # code...
                                }?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Kota Tujuan:</label>
                              <select name="kota_tujuan" id="kota_tujuan" class="form-control select2" required>
                                <option value="<?php echo $row['kota_tujuan']; ?>"><?php echo $row['kota_tujuan']; ?></option>
                                <?php 
                                $sql_kota = mysqli_query($koneksi, "SELECT * FROM kota") or die (mysqli_error($koneksi));
                                while ($data_kota = mysqli_fetch_array($sql_kota)) {
                                  echo '<option value="'.$data_kota['id_kota'].'">'.$data_kota['nama_kota'].'</option>';
                                  # code...
                                }?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Transportasi:</label>
                              <select name="transportasi" id="transportasi" class="form-control" required>
                                <option value="<?php echo $row['transportasi']; ?>"><?php echo $row['transportasi']; ?></option>
                                <option value="Udara"> Udara </option>
                                <option value="Laut"> Laut </option>
                                <option value="Darat"> Darat </option>
                              </select>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group" >
                              <label>Nama Pelaksana PD:</label>
                              <select  value="" name="nama_pelaksana" id="nama_pelaksana" class="form-control" required>
                                <option value="<?php echo $row['Nama']; ?>"><?php echo $row['Nama']; ?></option>
                                <?php 
                                $sql_peg = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY Nama ASC") or die (mysqli_error($koneksi));
                                while ($data_peg = mysqli_fetch_array($sql_peg)) {
                                  echo '<option value="'.$data_peg['NIP'].'">'.$data_peg['Nama'].'</option>';
                                  # code...
                                }?>
                              </select>
                          </div>  
                          <div class="form-group">
                              <label>Pengikut:</label>
                              <select multiple name="pengikut" id="pengikut" class="form-control select2" size="8" required>
                                <option value="<?php echo $row['pengikut']; ?>" selected><?php echo $row['pengikut']; ?></option>
                                <?php 
                                $sql_peg = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY Nama ASC") or die (mysqli_error($koneksi));
                                while ($data_peg = mysqli_fetch_array($sql_peg)) {
                                  echo '<option value="'.$data_peg['NIP'].'">'.$data_peg['Nama'].'</option>';
                                  # code...
                                }?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Bidang:</label>
                              <select name="bidang" id="bidang" class="form-control select2" required>
                                <option value="<?php echo $row['nama_bidang']; ?>"><?php echo $row['nama_bidang']; ?></option>
                                <?php 
                                $sql_bid = mysqli_query($koneksi, "SELECT * FROM bidang") or die (mysqli_error($koneksi));
                                while ($data_bid = mysqli_fetch_array($sql_bid)) {
                                  echo '<option value="'.$data_bid['id_bidang'].'">'.$data_bid['nama_bidang'].'</option>';
                                  # code...
                                }?>
                              </select>
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group" >
                              <label>Pejabat Pembuat Komitmen:</label>
                              <input type="text" value="<?php echo $row['ppk']; ?>" name="ppk" class="form-control" >
                          </div>  
                          <div class="form-group">
                              <label>MAK:</label>
                              <select name="mak" id="mak" class="form-control select2" required>
                                <option value="<?php echo $row['mak']; ?> selected"><?php echo $row['mak']; ?></option>
                                <?php 
                                $sql_mak = mysqli_query($koneksi, "SELECT * FROM akun") or die (mysqli_error($koneksi));
                                while ($data_mak = mysqli_fetch_array($sql_mak)) {
                                  echo '<option value="'.$data_mak['id_akun'].'">'.$data_mak['mak'].'</option>';
                                  # code...
                                }?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Dasar Pelaksana:</label>
                              <textarea name="dasar" id="dasar" class="form-control"><?php echo $row['dasar']; ?></textarea>
                          </div>
                          <div class="form-group">
                              <label>Untuk:</label>
                              <input type="text" name="untuk" value="<?php echo $row['untuk']; ?>" id="untuk" class="form-control" >
                          </div>
                        </div>
                        </div>        
                       <button type="submit" name="simpan" class="btn btn-block btn-primary btn-lg"> Simpan </button>   
                       
                <?php 
                /*}*/
                ?>
                      </form>    

                <?php
                }
                ?>   
                        </section>
              </div>
            </div>
    </section>