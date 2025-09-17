<?php
include "../../koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $almat    = $_POST['almat'];
    $telp    = $_POST['telp'];
    $username    = $_POST['username'];
    $password    = $_POST['password'];

    mysqli_query($koneksi, "INSERT INTO guru (nama_guru, tgl_lahir, almat, telp, username, password) VALUES ('$nama_guru','$tgl_lahir','$almat','$telp','$username','$password')");
    header("Location: ../../index.php?page=guru&pesan=tambah");
    exit;
}
?>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            <h2>
                <i class="fas fa-user-plus"></i>
                Tambah Data Guru
            </h2>
        </div>
        
        <div class="form-body">
            <form method="post">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> Nama Guru
                        </label>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" 
                                   name="nama_guru" 
                                   class="form-input" 
                                   placeholder="Masukkan nama lengkap" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar"></i> Tanggal Lahir
                        </label>
                        <div class="input-group">
                            <i class="fas fa-calendar"></i>
                            <input type="date" 
                                   name="tgl_lahir" 
                                   class="form-input" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i> Alamat
                        </label>
                        <textarea name="almat" 
                                  class="form-input form-textarea" 
                                  placeholder="Masukkan alamat lengkap" 
                                  required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i> No. Telepon
                        </label>
                        <div class="input-group">
                            <i class="fas fa-phone"></i>
                            <input type="text" 
                                   name="telp" 
                                   class="form-input" 
                                   placeholder="Masukkan nomor telepon" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user-circle"></i> Username
                        </label>
                        <div class="input-group">
                            <i class="fas fa-user-circle"></i>
                            <input type="text" 
                                   name="username" 
                                   class="form-input" 
                                   placeholder="Masukkan username" 
                                   required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" 
                                   name="password" 
                                   class="form-input" 
                                   placeholder="Masukkan password" 
                                   required>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <a href="../../index.php?page=guru" class="btn btn-secondary">
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


<style>
/* Modern form styles that match your dashboard */
.form-container {
    padding: 2rem;
    max-width: 800px;
    margin: 0 auto;
}

.form-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.form-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem 2rem;
    color: white;
}

.form-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-header i {
    font-size: 1.25rem;
}

.form-body {
    padding: 2rem;
}

.form-grid {
    display: grid;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.2s ease;
    background: #fafafa;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-input::placeholder {
    color: #9ca3af;
}

.form-textarea {
    min-height: 100px;
    resize: vertical;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
    font-size: 0.875rem;
}

.btn-secondary {
    background: #6b7280;
    color: white;
}

.btn-secondary:hover {
    background: #4b5563;
    transform: translateY(-1px);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

/* Responsive design */
@media (max-width: 768px) {
    .form-container {
        padding: 1rem;
    }
    
    .form-header {
        padding: 1rem 1.5rem;
    }
    
    .form-header h2 {
        font-size: 1.25rem;
    }
    
    .form-body {
        padding: 1.5rem;
    }
    
    .form-actions {
        flex-direction: column-reverse;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .form-container {
        padding: 0.5rem;
    }
    
    .form-header {
        padding: 1rem;
    }
    
    .form-body {
        padding: 1rem;
    }
    
    .form-header h2 {
        font-size: 1.125rem;
    }
}

/* Grid layout for larger screens */
@media (min-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr 1fr;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
}

/* Input icons */
.input-group {
    position: relative;
}

.input-group i {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    z-index: 1;
}

.input-group .form-input {
    padding-left: 2.5rem;
}
</style>
