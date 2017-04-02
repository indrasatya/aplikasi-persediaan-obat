<!-- Aplikasi Persediaan Obat pada Apotek
*******************************************************
* Developer    : Indra Styawantoro
* Company      : Indra Studio
* Release Date : 1 April 2017
* Website      : www.indrasatya.com
* E-mail       : indra.setyawantoro@gmail.com
* Phone        : +62-856-6991-9769
-->

<?php  
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";

// fungsi query untuk menampilkan data dari tabel user
$query = mysqli_query($mysqli, "SELECT id_user, nama_user, foto, hak_akses FROM is_users WHERE id_user='$_SESSION[id_user]'")
                                or die('Ada kesalahan pada query tampil Manajemen User: '.mysqli_error($mysqli));

// tampilkan data
$data = mysqli_fetch_assoc($query);
?>

<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
  <!-- User image -->

  <?php  
  if ($data['foto']=="") { ?>
    <img src="images/user/user-default.png" class="user-image" alt="User Image"/>
  <?php
  }
  else { ?>
    <img src="images/user/<?php echo $data['foto']; ?>" class="user-image" alt="User Image"/>
  <?php
  }
  ?>

    <span class="hidden-xs"><?php echo $data['nama_user']; ?> <i style="margin-left:5px" class="fa fa-angle-down"></i></span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">

      <?php  
      if ($data['foto']=="") { ?>
        <img src="images/user/user-default.png" class="img-circle" alt="User Image"/>
      <?php
      }
      else { ?>
        <img src="images/user/<?php echo $data['foto']; ?>" class="img-circle" alt="User Image"/>
      <?php
      }
      ?>

      <p>
        <?php echo $data['nama_user']; ?>
        <small><?php echo $data['hak_akses']; ?></small>
      </p>
    </li>
    
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a style="width:80px" href="?module=profil" class="btn btn-default btn-flat">Profil</a>
      </div>

      <div class="pull-right">
        <a style="width:80px" data-toggle="modal" href="#logout" class="btn btn-default btn-flat">Logout</a>
      </div>
    </li>
  </ul>
</li>