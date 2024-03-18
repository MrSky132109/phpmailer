<?php
$koneksi = mysqli_connect("localhost", "root", "", "phpmailer");

$code = $_GET['code'];

if(isset($code)){
    $qry = $koneksi->query("SELECT * FROM data WHERE code_ver='$code' ");
    $result = $qry->fetch_assoc();

    $koneksi->query("UPDATE data SET is_ver=1 WHERE id='".$result['id']."'");
    echo "<script>alert('Vertifikasi berhasil, Silahkan Login');window.location='login.php'</script>";
}