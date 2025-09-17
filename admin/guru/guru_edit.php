<?php
include "../../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: ../../index.php?page=guru&pesan=tambah");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM guru WHERE id_guru=$id"));

if (isset($_POST['update'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $almat    = $_POST['almat'];
    $telp    = $_POST['telp'];
    $username    = $_POST['username'];
    $password    = $_POST['password'];

    mysqli_query($koneksi, "UPDATE guru (nama_guru, tgl_lahir, almat, telp, username, password) VALUES ('$nama_guru','$tgl_lahir','$almat','$telp','$username','$password')");
    header("Location: ../../index.php?page=guru&pesan=tambah");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="card-container">
            <div class="card">
                <div class="card-header">
                    <h2>
                        <div class="icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        Edit Data Guru
                    </h2>
                </div>
                <div class="card-body">
                    <form method="post" id="editForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user"></i>
                                        Nama Lengkap
                                    </label>
                                    <input type="text" name="nama_guru" class="form-control" 
                                           value="<?= htmlspecialchars($data['nama_guru']) ?>" 
                                           placeholder="Masukkan nama lengkap guru" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-calendar"></i>
                                        Tanggal Lahir
                                    </label>
                                    <input type="date" name="tgl_lahir" class="form-control" 
                                           value="<?= htmlspecialchars($data['tgl_lahir']) ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Alamat
                            </label>
                            <textarea name="alamat" class="form-control" rows="3" 
                                      placeholder="Masukkan alamat lengkap" required><?= htmlspecialchars($data['almat']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-phone"></i>
                                        Nomor Telepon
                                    </label>
                                    <input type="tel" name="telp" class="form-control" 
                                           value="<?= htmlspecialchars($data['telp']) ?>" 
                                           placeholder="Contoh: 08123456789" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user-circle"></i>
                                        Username
                                    </label>
                                    <input type="text" name="username" class="form-control" 
                                           value="<?= htmlspecialchars($data['username']) ?>" 
                                           placeholder="Username untuk login" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>
                                Password
                            </label>
                            <input type="password" name="password" class="form-control" 
                                   value="<?= htmlspecialchars($data['password']) ?>" 
                                   placeholder="Masukkan password baru" required>
                        </div>

                        <div class="btn-group">
                            <button type="submit" name="update" class="btn btn-success">
                                <i class="fas fa-save"></i>
                                Update Data
                            </button>
                            <a href="index.php?page=guru" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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