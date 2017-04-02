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
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert dan update
else {
	// insert data
	if ($_GET['act']=='insert') {
		if (isset($_POST['simpan'])) {
			// ambil data hasil submit dari form
			$username  = mysqli_real_escape_string($mysqli, trim($_POST['username']));
			$password  = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
			$nama_user = mysqli_real_escape_string($mysqli, trim($_POST['nama_user']));
			$hak_akses = mysqli_real_escape_string($mysqli, trim($_POST['hak_akses']));

			// perintah query untuk menyimpan data ke tabel users
            $query = mysqli_query($mysqli, "INSERT INTO is_users(username,password,nama_user,hak_akses)
                                            VALUES('$username','$password','$nama_user','$hak_akses')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: ../../main.php?module=user&alert=1");
            }
		}	
	}
	
	// update data
	elseif ($_GET['act']=='update') {
		if (isset($_POST['simpan'])) {
			if (isset($_POST['id_user'])) {
				// ambil data hasil submit dari form
				$id_user            = mysqli_real_escape_string($mysqli, trim($_POST['id_user']));
				$username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
				$password           = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
				$nama_user          = mysqli_real_escape_string($mysqli, trim($_POST['nama_user']));
				$email              = mysqli_real_escape_string($mysqli, trim($_POST['email']));
				$telepon            = mysqli_real_escape_string($mysqli, trim($_POST['telepon']));
				$hak_akses          = mysqli_real_escape_string($mysqli, trim($_POST['hak_akses']));
				
				$nama_file          = $_FILES['foto']['name'];
				$ukuran_file        = $_FILES['foto']['size'];
				$tipe_file          = $_FILES['foto']['type'];
				$tmp_file           = $_FILES['foto']['tmp_name'];
				
				// tentuka extension yang diperbolehkan
				$allowed_extensions = array('jpg','jpeg','png');
				
				// Set path folder tempat menyimpan gambarnya
				$path_file          = "../../images/user/".$nama_file;
				
				// check extension
				$file               = explode(".", $nama_file);
				$extension          = array_pop($file);

				// jika password tidak diubah dan foto tidak diubah
				if (empty($_POST['password']) && empty($_FILES['foto']['name'])) {
					// perintah query untuk mengubah data pada tabel users
                    $query = mysqli_query($mysqli, "UPDATE is_users SET username 	= '$username',
                    													nama_user 	= '$nama_user',
                    													email       = '$email',
                    													telepon     = '$telepon',
                    													hak_akses   = '$hak_akses'
                                                                  WHERE id_user 	= '$id_user'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../main.php?module=user&alert=2");
                    }
				}
				// jika password diubah dan foto tidak diubah
				elseif (!empty($_POST['password']) && empty($_FILES['foto']['name'])) {
					// perintah query untuk mengubah data pada tabel users
                    $query = mysqli_query($mysqli, "UPDATE is_users SET username 	= '$username',
                    													nama_user 	= '$nama_user',
                    													password 	= '$password',
                    													email       = '$email',
                    													telepon     = '$telepon',
                    													hak_akses   = '$hak_akses'
                                                                  WHERE id_user 	= '$id_user'")
                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../main.php?module=user&alert=2");
                    }
				}
				// jika password tidak diubah dan foto diubah
				elseif (empty($_POST['password']) && !empty($_FILES['foto']['name'])) {
					// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
					if (in_array($extension, $allowed_extensions)) {
	                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
	                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
	                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
	                        // Proses upload
	                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                        		// Jika gambar berhasil diupload, Lakukan : 
                        		// perintah query untuk mengubah data pada tabel users
			                    $query = mysqli_query($mysqli, "UPDATE is_users SET username 	= '$username',
			                    													nama_user 	= '$nama_user',
			                    													email       = '$email',
			                    													telepon     = '$telepon',
			                    													foto 		= '$nama_file',
			                    													hak_akses   = '$hak_akses'
			                                                                  WHERE id_user 	= '$id_user'")
			                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

			                    // cek query
			                    if ($query) {
			                        // jika berhasil tampilkan pesan berhasil update data
			                        header("location: ../../main.php?module=user&alert=2");
			                    }
                        	} else {
	                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
	                            header("location: ../../main.php?module=user&alert=5");
	                        }
	                    } else {
	                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
	                        header("location: ../../main.php?module=user&alert=6");
	                    }
	                } else {
	                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
	                    header("location: ../../main.php?module=user&alert=7");
	                } 
				}
				// jika password diubah dan foto diubah
				else {
					// Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
					if (in_array($extension, $allowed_extensions)) {
	                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
	                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
	                        // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
	                        // Proses upload
	                        if(move_uploaded_file($tmp_file, $path_file)) { // Cek apakah gambar berhasil diupload atau tidak
                        		// Jika gambar berhasil diupload, Lakukan : 
                        		// perintah query untuk mengubah data pada tabel users
			                    $query = mysqli_query($mysqli, "UPDATE is_users SET username 	= '$username',
			                    													nama_user 	= '$nama_user',
			                    													password    = '$password',
			                    													email       = '$email',
			                    													telepon     = '$telepon',
			                    													foto 		= '$nama_file',
			                    													hak_akses   = '$hak_akses'
			                                                                  WHERE id_user 	= '$id_user'")
			                                                    or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

			                    // cek query
			                    if ($query) {
			                        // jika berhasil tampilkan pesan berhasil update data
			                        header("location: ../../main.php?module=user&alert=2");
			                    }
                        	} else {
	                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
	                            header("location: ../../main.php?module=user&alert=5");
	                        }
	                    } else {
	                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
	                        header("location: ../../main.php?module=user&alert=6");
	                    }
	                } else {
	                    // Jika tipe file yang diupload bukan jpg, jpeg, png, tampilkan pesan gagal upload
	                    header("location: ../../main.php?module=user&alert=7");
	                } 
				}
			}
		}
	}

	// update status menjadi aktif
	elseif ($_GET['act']=='on') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$id_user = $_GET['id'];
			$status  = "aktif";

			// perintah query untuk mengubah data pada tabel users
            $query = mysqli_query($mysqli, "UPDATE is_users SET status  = '$status'
                                                          WHERE id_user = '$id_user'")
                                            or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location: ../../main.php?module=user&alert=3");
            }
		}
	}

	// update status menjadi blokir
	elseif ($_GET['act']=='off') {
		if (isset($_GET['id'])) {
			// ambil data hasil submit dari form
			$id_user = $_GET['id'];
			$status  = "blokir";

			// perintah query untuk mengubah data pada tabel users
            $query = mysqli_query($mysqli, "UPDATE is_users SET status  = '$status'
                                                          WHERE id_user = '$id_user'")
                                            or die('Ada kesalahan pada query update status on : '.mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location: ../../main.php?module=user&alert=4");
            }
		}
	}		
}		
?>