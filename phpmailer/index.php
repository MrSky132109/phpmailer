<?php 
session_start();
if(!$_SESSION['user']){
    header("location:login.php");
}
?>
<h1>Hi, SELAMAT DATANG DI HALAMAN UTAMA, ANDA TELAH BERHASIL LOGIN DAN VERIF</h1>