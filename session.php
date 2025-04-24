<?php
    session_start();

    // Periksa apakah user sudah login
    if(!isset($_SESSION['login'])){
        header("location: login.php");
        exit;
    }

    // Jika user sudah login, periksa apakah session id_user sudah diset
    if(isset($_SESSION['login']) && !isset($_SESSION['id_user'])){
        // Redirect ke halaman lain atau tampilkan pesan kesalahan
        // Contoh: header("location: error.php");
    }

    // Gunakan $_SESSION['id_user'] untuk identifikasi user dalam halaman ini
    $id_user = $_SESSION['id_user'];
?>