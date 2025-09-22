<?php
include "../../koneksi.php";

// Ambil data kelas untuk dropdown
$query_kelas = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas");
if (!$query_kelas) {
    die("Query error: " . mysqli_error($koneksi));
}

// Proses simpan
if (isset($_POST['simpan'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $no_absen   = $_POST['no_absen'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $alamat     = $_POST['alamat'];
    $telp       = $_POST['telp'];
    $id_kelas   = $_POST['id_kelas'];  // foreign key dari dropdown
    $nis        = $_POST['nis'] ?? null;
    $nisn       = $_POST['nisn'] ?? null;

    // Simpan data ke tabel siswa, id_kelas sebagai foreign key
$sql = "INSERT INTO siswa (nama_siswa, no_absen, tgl_lahir, alamat, telp, id_kelas, nis, nisn) 
        VALUES ('$nama_siswa', '$no_absen', '$tgl_lahir', '$alamat', '$telp', '$id_kelas', '$nis', '$nisn')";

    mysqli_query($koneksi, $sql) or die("Error query: " . mysqli_error($koneksi));

    header("Location: ../../index.php?page=siswa&pesan=tambah");
    exit;
}

?>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>
                <i class="fas fa-user-plus"></i>
                Tambah Data Siswa
            </h2>
        </div>
        
        <div class="form-body">
            <form method="post">
                <div class="form-grid">
                    <!-- Nama Siswa -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Nama Siswa
                        </label>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" name="nama_siswa" class="form-input" placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar"></i> Tanggal Lahir
                        </label>
                        <div class="input-group">
                            <i class="fas fa-calendar"></i>
                            <input type="date" name="tgl_lahir" class="form-input" required>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Alamat
                        </label>
                        <textarea name="alamat" class="form-input form-textarea" placeholder="Masukkan alamat lengkap" required></textarea>
                    </div>

                    <!-- No. Telepon -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i> No. Telepon
                        </label>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="text" name="telp" class="form-input" placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>

                    <!-- No. Abasen -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i> No. Absen
                        </label>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="number" name="no_absen" class="form-input" placeholder="Masukkan nomor Absen" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i>NIS
                        </label>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="number" name="nis" class="form-input" placeholder="Masukkan NIS" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i>NISN
                        </label>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="number" name="nisn" class="form-input" placeholder="Masukkan NISN" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i>NIS
                        </label>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="number" name="nis" class="form-input" placeholder="Masukkan NIS" required>
                        </div>
                    </div>

                    <!-- Kelas Dropdown -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-school"></i> Kelas
                        </label>
                        <div class="input-group">
                            <i class="fas fa-school"></i>
                            <select name="id_kelas" class="form-input" required>
                                <option value="">-- Pilih Kelas --</option>
                                <?php while($row = mysqli_fetch_assoc($query_kelas)) { ?>
                                    <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Tombol -->
                <div class="form-actions">
                    <a href="../../index.php?page=siswa" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Style tetap pakai CSS kamu yang sudah ada -->


<style>
.form-container {
    padding: 2rem 1rem;
    max-width: 700px;
    margin: 0 auto;
}

.form-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem 2rem;
    color: #fff;
}

.form-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-body {
    padding: 2rem;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.form-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1.8px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    background: #fafafa;
    transition: border-color 0.3s ease;
    position: relative;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
}

.form-input::placeholder {
    color: #999;
}

.form-textarea {
    min-height: 110px;
    resize: vertical;
    padding-left: 1rem;
}

.input-group {
    position: relative;
}

.input-group i {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    pointer-events: none;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    border-top: 1px solid #eee;
    padding-top: 1.5rem;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-secondary {
    background-color: #6b7280;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #4b5563;
    transform: translateY(-2px);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(102, 126, 234, 0.4);
}

/* Responsive tweaks */
@media (max-width: 480px) {
    .form-actions {
        flex-direction: column-reverse;
        gap: 0.75rem;
    }
    .btn {
        width: 100%;
        justify-content: center;
    }
}

</style>
