<?php
// Fungsi format uang dalam rupah
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}

// Fungsi rupiah untuk laporan pada halaman admin
function rp($uang){
  $rp = "";
  $digit = strlen($uang);
  
  while($digit > 3)
  {
    $rp = "." . substr($uang,-3) . $rp;
    $lebar = strlen($uang) - 3;
    $uang  = substr($uang,0,$lebar);
    $digit = strlen($uang);  
  }
  $rp = $uang . $rp . ",-";
  return $rp;
}
?> 
