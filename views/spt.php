  
  <style type="text/css">
    @media print {
      .pencarian {
        display: none;
      }

    }
  </style>

   <section class="content-header">
      <h1>
        Surat Perintah Tugas
        <small>...</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master Data</a></li>
        <li class="active">SPT</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
    	<div class="col-xs-2">
    		<label>
          <a href="" class="btn btn-default btn-sm"> <i class="glyphicon glyphicon-refresh"></i></a>
          <a href="?page=tmbspt" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a>
    		<!-- 	<button data-toggle="modal" data-target=".bd-example-modal-lg" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>   Tambah</button></label> -->
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
        <?php
        include 'config/koneksi.php';
        ?>
            <div class="box-header">
              <h3 class="box-title">Daftar Surat Perintah Tugas</h3>
            </div>
            <nav aria-label="Page navigation example">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No SPT</th>
                    <th>NIP(Pelaksana)</th>
                    <th>Kota Tujuan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $batas=3;
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
                      $sql = "SELECT * FROM spt where nama_pelaksana LIKE '%$pencarian%'";
                      $query = $sql;
                      $queryJml = $sql;
                    } else {
                      $query = "SELECT * FROM spt LIMIT $posisi, $batas";
                      $queryJml = "SELECT * FROM spt";
                      $no = $posisi + 1;
                    }
                  } else {
                      $query = "SELECT * FROM spt LIMIT $posisi, $batas";
                      $queryJml = "SELECT * FROM spt";
                      $no = $posisi + 1;
                  }
                  
                  $query = "SELECT * FROM spt INNER JOIN pegawai ON spt.nama_pelaksana = pegawai.NIP 
                                              INNER JOIN kota ON spt.kota_tujuan = kota.id_kota ";
                  $data = mysqli_query($koneksi,$query);
                  while($d = mysqli_fetch_array($data)){
                  ?>

                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['no_spt']; ?></td>
                    <td><?php echo $d['nama_pelaksana']; ?> (<?php echo $d['Nama']; ?>)</td>
                    <td><?php echo $d['nama_kota']; ?></td>
                    <td class="text-left"> 
                      <a href="cetakSPT.php?id_spt=<?php echo $d['id_spt'];?>" target="_blank" type="button" class="btn btn-default btn-xs"> <ic class="glyphicon glyphicon-print"></i> cetak_spt</a>

                      <a href="?page=editspt&id_spt=<?php echo $d['id_spt'];?>" type="button" class="btn btn-warning btn-xs"> <ic class="glyphicon glyphicon-edit"></i></a>
                      <!-- <a href="#" type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal<?php //echo $d['id_spt']; ?>"> <ic class="glyphicon glyphicon-edit"></i></a> -->
                      <a href="hapusSPT.php?id_spt=<?php echo $d['id_spt']; ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                  </tr>
                  <?php
                  }
                       ?>
                  
                </tbody>
                <tfoot>
                <tr>
                  
                </tr>
                </tfoot>
              </table>
              </div>
            </div>
            <!-- /.box-body -->

            <?php
            if (empty($_POST['pencarian'])) { ?>
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
          <!-- Modal FOR eDIT -->
          <div class="modal fade" id="myModal<?php echo $d['id_spt']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel1">Edit Data SPT</h4>
              </div>
              <div class="modal-body">
                  <form method="POST" name="formTambah" id="formTambah" action="simpanSPT.php" enctype="multipart/form-data">
                        <?php
                              $id_kota = $d['id_spt']; 
                              $query_edit = mysqli_query($koneksi, "SELECT * FROM kota WHERE id_spt='$id_spt'");
                              while ($row = mysqli_fetch_array($query_edit)) {  
                              ?>
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
          </div>
            <!-- /.box-body -->
    </section>