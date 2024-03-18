<?php
session_start();

$koneksi = mysqli_connect("localhost", "root", "", "phpmailer");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $qry = $koneksi->query("SELECT * FROM data WHERE email='$email' AND password='$password'");
    $cek = $qry->num_rows;

    if($cek > 0){
        $verif = $qry->fetch_assoc();
        if($verif['is_ver'] == 1){
            $_SESSION['user'] = $verif;
            echo "<script>alert('login berhasil');window.location='index.php';</script>";
        }else{
            echo "<script>alert('Harap Vertifikasi Akun anda!');window.location='login.php';</script>";
        }
        }else{
            echo "<script>alert('Email atau password salah!');window.location='login.php';</script>";
        }
    }
?>

<form action="" method="post">
    <div>
        <label for="">Masukan Email</label>
        <input type="email" name="email">
    </div>
    <div>
        <label for="">Masukan Password</label>
        <input type="password" name="password">
    </div>

    <button type="submit" name="login">Login</button>
    <p>Belum punya akun? <a href="register.php">daftar</a></p>
</form>