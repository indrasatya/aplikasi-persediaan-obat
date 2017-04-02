<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <i class="fa fa-lock icon-title"></i> Ubah Password
  </h1>
  <ol class="breadcrumb">
    <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
    <li class="active">Password</li>
    <li class="active">Ubah</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    } 
    // jika alert = 1
    // tampilkan pesan Gagal "Paswword lama Anda salah"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Gagal!</h4>
              Paswword lama Anda salah.
            </div>";
    }
    // jika alert = 2
    // tampilkan pesan Gagal "Password baru dan Ulangi password baru tidak cocok"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-danger alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-times-circle'></i> Gagal!</h4>
              Password baru dan Ulangi password baru tidak cocok.
            </div>";
    }
    // jika alert = 3
    // tampilkan pesan Sukses "Password berhasil diubah"
    elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Password berhasil diubah.
            </div>";
    }
    ?>

      <!-- form ubah password -->
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" class="form-horizontal" method="POST" action="modules/password/proses.php">
          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-2 control-label">Password Lama</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" name="old_pass" autocomplete="off" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" name="new_pass" autocomplete="off" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Ulangi Password Baru</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" name="retype_pass" autocomplete="off" required>
              </div>
            </div>
          </div><!-- /.box-body -->
          
          <div class="box-footer bg-btn-action">
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
              </div>
            </div>
          </div>
        </form>
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->