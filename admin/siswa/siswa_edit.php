<?php
include "../../koneksi.php";

// Cek jika parameter ID tidak ada
if (!isset($_GET['id'])) {
    header("Location: ../../index.php?page=siswa&pesan=error");
    exit;
}

$id = $_GET['id'];

// Ambil data siswa beserta info kelasnya
$query = "SELECT siswa.*, kelas.nama_kelas 
          FROM siswa 
          LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
          WHERE siswa.id_siswa = $id";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($result);

// Ambil data kelas untuk dropdown
$query_kelas = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas");
if (!$query_kelas) {
    die("Query error: " . mysqli_error($koneksi));
}

// Proses update saat form disubmit
if (isset($_POST['update'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $no_absen   = $_POST['no_absen'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $alamat     = $_POST['alamat'];
    $telp       = $_POST['telp'];
    $nis        = $_POST['nis'];
    $nisn       = $_POST['nisn'];
    $id_kelas   = $_POST['id_kelas'];

    $update = "UPDATE siswa SET 
                nama_siswa = '$nama_siswa',
                no_absen = '$no_absen',
                tgl_lahir = '$tgl_lahir',
                alamat = '$alamat',
                telp = '$telp',
                nis = '$nis',
                nisn = '$nisn',
                id_kelas = '$id_kelas'
               WHERE id_siswa = $id";

    mysqli_query($koneksi, $update) or die("Update error: " . mysqli_error($koneksi));

    header("Location: ../../index.php?page=siswa&pesan=update");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Edit Data Siswa</h4>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control" value="<?= $data['nama_siswa'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>No. Absen</label>
                    <input type="number" name="no_absen" class="form-control" value="<?= $data['no_absen'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="text" name="telp" class="form-control" value="<?= $data['telp'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>NIS</label>
                    <input type="number" name="nis" class="form-control" value="<?= $data['nis'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>NISN</label>
                    <input type="number" name="nisn" class="form-control" value="<?= $data['nisn'] ?>" required>
                </div>
                <div class="mb-3">
                    <label>Kelas</label>
                    <select name="id_kelas" class="form-control" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php while($row = mysqli_fetch_assoc($query_kelas)) { ?>
                            <option value="<?= $row['id_kelas'] ?>" <?= ($row['id_kelas'] == $data['id_kelas']) ? 'selected' : '' ?>>
                                <?= $row['nama_kelas'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="../../index.php?page=siswa" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
