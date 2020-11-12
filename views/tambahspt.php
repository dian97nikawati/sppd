    <section class="content-header">
      <h1>
        Tambah SPT
        <small>...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">SPT</a></li>
        <li class="active">Tambah SPT</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="box box-solid box-primary">
        <?php
        include 'config/koneksi.php';
        ?>
            <div class="box-header">
              <b class="box-title">Data SPT</b>
            </div>
            <nav aria-label="Page navigation example">
            <!-- /.box-header -->
            <div class="box-body">
              <section class="content">
                      <form method="POST" name="formTambah" id="formTambah" action="simpanSPT.php">
                        <div class="row">
                        <div class="col-xs-3">
                          <div class="form-group" >
                              <label>Nomor SPT:</label>
                              <input type="text" name="no_spt" id="no_spt"  class="form-control" >
                          </div>
                          <div class="form-group" >
                              <label>Tanggal Berangkat:</label>
                              <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control" >
                          </div>  
                          <div class="form-group">
                              <label>Tanggal Kembali:</label>
                              <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" >
                          </div>
                          <div class="form-group" >
                              <label>Kota Asal:</label>
                              <select class="form-control select2" name="kota_asal" id='kota_asal' data-placeholder="Pilih Kota" required>
                                <option value="">-Pilih Kota-</option>
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
                                <option value="">-Pilih Kota-</option>
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
                                <option value="">- Pilih transportasi-</option>
                                <option value="Udara"> Udara </option>
                                <option value="Laut"> Laut </option>
                                <option value="Darat"> Darat </option>
                              </select>
                          </div>
                        </div>
                        <div class="col-xs-6">
                          <div class="form-group" >
                              <label>Nama Pelaksana PD:</label>
                              <select name="nama_pelaksana" id="nama_pelaksana" class="form-control" required>
                                <option value="">- Pilih -</option>
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
                              <select multiple name="pengikut"  id="pengikut" class="form-control select2" size="8" required>
                                <option value="">- Pilih Pengikut-</option>
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
                                <option value="">- Pilih Bidang-</option>
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
                              <input type="text" name="ppk" class="form-control" >
                          </div>  
                          <div class="form-group">
                              <label>MAK:</label>
                              <select name="mak" id="mak" class="form-control select2" required>
                                <option value="">- Pilih mak-</option>
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
                              <textarea name="dasar" id="dasar" class="form-control"></textarea>
                          </div>
                          <div class="form-group">
                              <label>Untuk:</label>
                              <input type="text" name="untuk" id="untuk" class="form-control" >
                          </div>
                        </div>
                        </div>        
                       <button type="submit" name="simpan" class="btn btn-block btn-primary btn-lg"> Simpan </button>   
                      </form>
                       
                        </section>
              </div>
            </div>
    </section>