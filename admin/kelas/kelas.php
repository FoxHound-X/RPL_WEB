<?php
// Cek apakah ada pencarian
include "koneksi.php";
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM kelas,jurusan,guru
                                      WHERE kelas.id_jurusan=jurusan.id_jurusan AND kelas.id_guru=guru.Id_guru AND nama_kelas LIKE '%$cari%'  
                                      ORDER BY id_kelas DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM kelas,jurusan,guru  WHERE kelas.id_jurusan=jurusan.id_jurusan AND kelas.id_guru=guru.Id_guru ORDER BY id_kelas DESC");
}
?>

<!-- kelas.php -->
<div class="card">
    <h2>🏫 Data Kelas</h2>

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success">
            <?php 
            if ($_GET['pesan'] == 'tambah') echo "✅ Data kelas berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data kelas berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data kelas berhasil dihapus!";
            ?>
        </div>
    <?php endif; ?>

    <!-- Pencarian + Tombol Tambah -->
    <div class="search-add">
        <form method="get" action="">
            <input type="hidden" name="page" value="kelas">
            <input type="text" name="cari" placeholder="Cari kelas/guru/jurusan..." value="<?= htmlspecialchars($cari) ?>">
            <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>
        </form>
        <a href="admin/kelas/kelas_tambah.php" class="btn-add"><i class="fas fa-plus"></i> Tambah Kelas</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Nama Guru</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $no = 1; 
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_kelas'] ?></td>
                    <td><?= $row['nama_guru'] ?></td>
                    <td><?= $row['nama_jurusan'] ?></td>
                    <td>
                        <a href="admin/kelas/kelas_edit.php?id=<?= $row['id_kelas'] ?>" class="btn-edit"><i class="fas fa-edit"></i></a>
                        <a href="admin/kelas/kelas_hapus.php?id=<?= $row['id_kelas'] ?>" 
                           class="btn-delete" 
                           onclick="return confirm('Yakin ingin menghapus jurusan ini?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
        <?php } 
        } else { ?>
            <tr>
                <td colspan="4" class="text-center text-muted">⚠️ Data tidak ditemukan</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<style>
/* === Kartu utama === */
.card {
    background-color: #1e293b;
    border-radius: 10px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    margin-top: 24px;
    font-family: 'Inter', sans-serif;
}

/* === Judul halaman === */
.card h2 {
    font-size: 20px;
    font-weight: 600;
    color: #e8e8e8ff;
    margin-bottom: 20px;
}

/* === Area pencarian dan tombol tambah === */
.search-add {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: center;
    margin-bottom: 20px;
    gap: 12px;
}

.search-add form {
    display: flex;
    gap: 10px;
}

.search-add input[type="text"] {
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    width: 250px;
}

.btn-search {
    background-color: #0d6efd;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.2s ease;
}

.btn-search:hover {
    background-color: #0b5ed7;
}

.btn-add {
    background-color: #198754;
    color: #fff;
    padding: 10px 16px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    transition: 0.2s ease;
}

.btn-add i {
    margin-right: 6px;
}

.btn-add:hover {
    background-color: #157347;
}

/* === Tabel === */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.table thead {
    background-color: #f8f9fa;
}

.table th, .table td {
    padding: 12px 16px;
    border-bottom: 1px solid #e9ecef;
    text-align: center;
}

.table tbody tr:hover {
    background-color: #0d0d0d46;
}

/* === Tombol Aksi === */
.btn-edit,
.btn-delete {
    padding: 8px 10px;
    font-size: 14px;
    border-radius: 6px;
    text-decoration: none;
    margin: 0 2px;
    display: inline-block;
    transition: 0.2s ease;
}

.btn-edit {
    background-color: #ffc107;
    color: #000;
}

.btn-edit:hover {
    background-color: #e0a800;
    color: #000;
}

.btn-delete {
    background-color: #dc3545;
    color: #fff;
}

.btn-delete:hover {
    background-color: #bb2d3b;
}

/* === Notifikasi / Alert === */
.alert {
    padding: 12px 16px;
    background-color: #d1e7dd;
    color: #0f5132;
    border-left: 4px solid #198754;
    border-radius: 6px;
    margin-bottom: 20px;
    font-size: 14px;
}

</style>