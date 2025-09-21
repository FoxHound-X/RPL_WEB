<?php
include "../../koneksi.php";

// Proses simpan data
if (isset($_POST['simpan'])) {
    $nama_kelas = $_POST['nama_kelas'];
    $id_guru = $_POST['id_guru'];
    $id_jurusan = $_POST['id_jurusan'];

    $sql = "INSERT INTO kelas (nama_kelas, id_guru, id_jurusan) 
            VALUES ('$nama_kelas', '$id_guru', '$id_jurusan')";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        echo "<script>alert('Data kelas berhasil ditambahkan');window.location='kelas.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');</script>";
    }
}

// Ambil data guru untuk dropdown
$guru = mysqli_query($koneksi, "SELECT * FROM guru");
// Ambil data jurusan untuk dropdown
$jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
?>

<div class="card">
    <h2>Tambah Kelas</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Wali Kelas (Guru)</label>
            <select name="id_guru" class="form-control" required>
                <option value="">-- Pilih Guru --</option>
                <?php while ($g = mysqli_fetch_assoc($guru)) { ?>
                    <option value="<?= $g['id_guru'] ?>"><?= $g['nama_guru'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Jurusan</label>
            <select name="id_jurusan" class="form-control" required>
                <option value="">-- Pilih Jurusan --</option>
                <?php while ($j = mysqli_fetch_assoc($jurusan)) { ?>
                    <option value="<?= $j['id_jurusan'] ?>"><?= $j['nama_jurusan'] ?></option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn-save">Simpan</button>
        <a href="../../index.php?page=kelas" class="btn btn-secondary">
    </form>
</div>
