<?php
// koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "ssribase"; // sesuai database kamu

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// query ambil data
$query = "SELECT nama_pegawai, tgl_lahir, alamat FROM pegawai";
$result = mysqli_query($koneksi, $query);
?>

<!-- pegawai.php -->
<div class="card">
    <h2>Data Pegawai</h2>
    <a href="tambah_pegawai.php" class="btn-add"><i class="fas fa-plus"></i> Tambah Pegawai</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_pegawai']; ?></td>
                    <td><?= $row['tgl_lahir']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td>
                        <a href="edit_pegawai.php?id=<?= $row['nama_pegawai']; ?>" class="btn-edit"><i class="fas fa-edit"></i></a>
                        <a href="hapus_pegawai.php?id=<?= $row['nama_pegawai']; ?>" class="btn-delete" onclick="return confirm('Yakin hapus data?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
mysqli_close($koneksi);
?>
