
<?php 
$host = 'localhost';
$user = 'setia';
$pass = 'setia2009';
$db = 'ssribase';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
