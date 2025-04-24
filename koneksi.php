<?php
  //koneksi ke database
  $con = new mysqli("localhost:3306","root","","pet_pals_revisi");
  
  // Check connection
  if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }
?>