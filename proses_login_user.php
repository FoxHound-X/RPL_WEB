<?php 
session_start();

include "koneksi.php";

$username = $_POST['username'];
$password = ($_POST['password']); // hashing md5 (sebaiknya gunakan password_hash untuk keamanan lebih)

// query cek data
$sql = "SELECT * FROM pegawai WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);

if (!$query) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);

    // simpan data ke session
    $_SESSION['nama_pegawai'] = $data['nama_pegawai'];
    $_SESSION['login'] = true;

    header('Location: user/pembayaran.php');
    exit;
} else {
    echo "Username atau password salah!";
}
?>
