<?php
	include 'config/koneksi.php';
	$query = mysqli_query($koneksi, "SELECT * FROM bendahara");
	$row_query = mysqli_fetch_array($query);


?>
<section class="content-header">
      <h1>
        Bendahara 
        <small>Dinas Pendidikan Kota Kediri</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Master Data</a></li>
        <li class="active">Bendahara</li>
      </ol>
    </section>

    <!-- Main content -->

	
    <section class="content">

      <div class="row">
        <div class="col-xs-6">
        <div class="box box-solid box-primary">
		        <div class="box-header">
		          <b class="box-title">Ubah Bendahara</b> 
		        </div><!-- /.box-header -->
		        <div class="box-body">
		          <div class="col-sm-10 col-sm-offset-1">
		          	
		            <form method="GET" name="formTambah" id="formTambah" action="simpanBend.php">
		              <div class="form-group">
		                <label for="nip_bend">NIP Bendahara</label>
		                <input type="text" value="<?php echo $row_query['nip_bend'] ?>" name="nipbend" class="form-control" readonly>
		              </div>
		              <div class="form-group">
		                <label for="nama_bend">Nama Bendahara</label>
		                <input type="text" value="<?php echo $row_query['nama'] ?>" name="namabend" class="form-control" readonly>
		              </div>
		              <div class="form-group">
		              </div>
		              <a href="?page=ubahbend" type="button" class="btn btn-warning"> <ic class="glyphicon glyphicon-edit"> Ubah</i></a>
		            </form>
		            
		          </div>
		        </div><!-- /.box-body -->
        </div>	
        </div>
		<!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    


    