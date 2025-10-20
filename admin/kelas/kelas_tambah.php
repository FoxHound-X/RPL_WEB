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
        echo "<script>alert('Data kelas berhasil ditambahkan');window.location='../../dashboard.php?page=kelas&pesan=tambah';</script>";
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
            <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: X-RPL-1" required>
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

        <div class="button-group">
            <button type="submit" name="simpan" class="btn-save">Simpan</button>
            <a href="../../dashboard.php?page=kelas" class="btn-secondary">Kembali</a>
        </div>
    </form>

    
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 40px 20px;
    }

    .card {
        max-width: 600px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card h2 {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        margin: 0;
        font-size: 28px;
        font-weight: 600;
        text-align: center;
        letter-spacing: 0.5px;
    }

    form {
        padding: 40px;
    }

    .form-group {
        margin-bottom: 28px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        color: #333;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8f9fa;
        color: #333;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-control:hover {
        border-color: #b8c1ec;
    }

    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23667eea' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 20px;
        padding-right: 45px;
    }

    select.form-control option {
        padding: 10px;
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 35px;
    }

    .btn-save {
        flex: 1;
        padding: 15px 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6);
    }

    .btn-save:active {
        transform: translateY(-1px);
    }

    .btn-secondary {
        flex: 1;
        padding: 15px 30px;
        background: #6c757d;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        text-align: center;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(108, 117, 125, 0.5);
    }

    .btn-secondary:active {
        transform: translateY(-1px);
    }

    /* Icon untuk input */
    .form-group::before {
        content: '';
        position: absolute;
        left: 18px;
        top: 46px;
        width: 20px;
        height: 20px;
        opacity: 0.5;
        pointer-events: none;
    }

    .form-group:nth-child(1)::before {
        content: '🏫';
    }

    .form-group:nth-child(2)::before {
        content: '👨‍🏫';
    }

    .form-group:nth-child(3)::before {
        content: '📚';
    }

    .form-group input.form-control,
    .form-group select.form-control {
        padding-left: 50px;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .card {
            border-radius: 15px;
        }

        .card h2 {
            font-size: 24px;
            padding: 25px;
        }

        form {
            padding: 30px 25px;
        }

        .button-group {
            flex-direction: column;
        }

        .btn-save,
        .btn-secondary {
            width: 100%;
        }
    }
</style>

</div>