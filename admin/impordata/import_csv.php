<?php
include '../../koneksi.php';

if (isset($_POST['nama'])) {
    $namaArr = $_POST['nama_pegawai'];
    $tglArr = $_POST['tgl_lahir'];
    $almatArr = $_POST['almat'];
    $telpArr = $_POST['telp'];
    $usernameArr = $_POST['username'];
    $passwordArr = $_POST['password'];

    $jumlah_import = 0;

    for ($i = 0; $i < count($namaArr); $i++) {
        $nama = mysqli_real_escape_string($koneksi, $namaArr[$i]);
        $tgl_lahir = mysqli_real_escape_string($koneksi, date('Y-m-d', strtotime($tglArr[$i])));
        $almat = mysqli_real_escape_string($koneksi, $almatArr[$i]);
        $telp = mysqli_real_escape_string($koneksi, $telpArr[$i]);
        $username = mysqli_real_escape_string($koneksi, $usernameArr[$i]);
        $password = mysqli_real_escape_string($koneksi, $passwordArr[$i]);

        $query = "INSERT INTO pegawai (nama_pegawai, tgl_lahir, almat, telp, username, password) 
                  VALUES ('$nama','$tgl_lahir', '$almat', '$telp', '$username', '$password')";
        mysqli_query($koneksi, $query);
        $jumlah_import++;
    }

    echo "✅ Import selesai.<br>";
    echo "👉 Data berhasil ditambahkan: <b>$jumlah_import</b><br>";
    echo "<a href='upload_csv.php'>Kembali</a>";
} else {
    echo "❌ Tidak ada data untuk diimport.";
}
?>
