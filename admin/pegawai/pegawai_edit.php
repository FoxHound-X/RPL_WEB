<?php
include "../../koneksi.php";

// Cek jika parameter ID tidak ada
if (!isset($_GET['id'])) {
    header("Location: ../../dashboard.php?page=pegawai&pesan=error");
    exit;
}

$id = $_GET['id'];

// Ambil data Pegawai dari database
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = $id"));

// Proses saat form disubmit
if (isset($_POST['update'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat     = $_POST['alamat'];
    $telp      = $_POST['telp'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];

    mysqli_query($koneksi, "UPDATE Pegawai SET 
        nama_pegawai = '$nama_pegawai',
        tgl_lahir = '$tgl_lahir',
        alamat = '$alamat',
        telp = '$telp',
        username = '$username',
        password = '$password'
        WHERE id_pegawai = $id
    ");

    header("Location: ../../dashboard.php?page=pegawai&pesan=update");
    exit;
}
?>

<!-- HTML FORM EDIT -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Edit Data Pegawai</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label>Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" class="form-control" value="<?= $data['nama_pegawai'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" value="<?= $data['tgl_lahir'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="almat" class="form-control" required><?= $data['almat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Telepon</label>
                        <input type="text" name="telp" class="form-control" value="<?= $data['telp'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" value="<?= $data['password'] ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="../../dashboard.php?page=Pegawai" class="btn btn-secondary">Kembali</a>
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation and user experience enhancements
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;
            
            // Re-enable button after 3 seconds if form doesn't submit (for error cases)
            setTimeout(() => {
                if (submitBtn.disabled) {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }, 3000);
        });

        // Auto-format phone number
        document.querySelector('input[name="telp"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0 && !value.startsWith('0')) {
                value = '0' + value;
            }
            e.target.value = value;
        });

        // Username validation
        document.querySelector('input[name="username"]').addEventListener('input', function(e) {
            e.target.value = e.target.value.toLowerCase().replace(/[^a-z0-9_]/g, '');
        });
    </script>
</body>
</html>

    <style>
        :root {
            --dark-bg: #0d1117;
            --dark-surface: #161b22;
            --dark-surface-hover: #21262d;
            --dark-border: #30363d;
            --accent-blue: #0ea5e9;
            --accent-blue-hover: #0284c7;
            --text-primary: #f0f6fc;
            --text-secondary: #8b949e;
            --success: #238636;
            --success-hover: #2ea043;
            --secondary: #6c757d;
            --secondary-hover: #5c636a;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1a1d29 100%);
            color: var(--text-primary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .main-container {
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .card-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: var(--dark-surface);
            border: 1px solid var(--dark-border);
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.4), 0 15px 15px -5px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #0284c7 100%);
            border-bottom: 1px solid var(--dark-border);
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .card-header h2 {
            color: white;
            font-weight: 700;
            font-size: 1.75rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .card-header .icon {
            background: rgba(255, 255, 255, 0.2);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 2.5rem;
        }

        .form-label {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: var(--accent-blue);
            width: 16px;
        }

        .form-control {
            background: var(--dark-surface-hover);
            border: 2px solid var(--dark-border);
            color: var(--text-primary);
            padding: 0.875rem 1rem;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: var(--dark-surface-hover);
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.2rem rgba(14, 165, 233, 0.15);
            color: var(--text-primary);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            min-width: 120px;
            justify-content: center;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success) 0%, var(--success-hover) 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, var(--success-hover) 0%, #2ea043 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(35, 134, 54, 0.3);
            color: white;
        }

        .btn-secondary {
            background: var(--dark-surface-hover);
            color: var(--text-secondary);
            border: 2px solid var(--dark-border);
        }

        .btn-secondary:hover {
            background: var(--secondary);
            color: white;
            border-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(108, 117, 125, 0.2);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -0.75rem;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 0.75rem;
        }

        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .main-container {
                padding: 1rem;
            }
            
            .card-header, .card-body {
                padding: 1.5rem;
            }
            
            .btn-group {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }

        /* Loading animation for form submission */
        .btn-success:active {
            transform: scale(0.98);
        }

        /* Input focus effects */
        .form-control:focus + .form-label {
            color: var(--accent-blue);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--dark-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--dark-border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-blue);
        }
    </style>