<?php
/**
 * SISTEM PEMBAYARAN SPP - SMK NEGERI 1 SUKAWATI
 * =============================================
 * File: pembayaran.php
 * Fungsi: Halaman form pembayaran SPP siswa dengan multiple select bulan
 */

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
include("../koneksi.php");

// ===== BAGIAN 1: AMBIL DATA SISWA UNTUK DROPDOWN =====
$siswa_list = mysqli_query($koneksi, "SELECT id_siswa, nama_siswa, nis FROM siswa ORDER BY nama_siswa ASC");

// ===== BAGIAN 2: FUNGSI UNTUK CEK BULAN YANG SUDAH DIBAYAR =====
function getBulanTerbayar($koneksi, $id_siswa) {
    $bulan_terbayar = [];
    $query = mysqli_query($koneksi, "SELECT DISTINCT bulan FROM pembayaran WHERE id_siswa = '$id_siswa' ORDER BY bulan ASC");
    while ($row = mysqli_fetch_assoc($query)) {
        $bulan_terbayar[] = $row['bulan'];
    }
    return $bulan_terbayar;
}

// ===== VARIABEL UNTUK MENYIMPAN ID SISWA YANG BARU BAYAR =====
$siswa_terpilih = isset($_GET['siswa']) ? $_GET['siswa'] : '';

// ===== BAGIAN 3: PROSES FORM KETIKA TOMBOL SUBMIT DITEKAN =====
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_siswa = mysqli_real_escape_string($koneksi, $_POST['id_siswa']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $bulan_array = isset($_POST['bulan']) ? $_POST['bulan'] : [];
    $metode = mysqli_real_escape_string($koneksi, $_POST['metode']);
    
    // ID Pegawai default
    $id_pegawai = 8;
    
    // Validasi: pastikan ada bulan yang dipilih
    if (empty($bulan_array)) {
        echo "<script>alert('⚠️ Silakan pilih minimal 1 bulan pembayaran!');</script>";
    } else {
        $success_count = 0;
        $failed_months = [];
        
        // Loop untuk setiap bulan yang dipilih
        foreach ($bulan_array as $bulan) {
            $bulan = mysqli_real_escape_string($koneksi, $bulan);
            $nominal = 150000; // Per bulan
            
            // Cek apakah bulan ini sudah dibayar sebelumnya
            $cek_bayar = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_siswa = '$id_siswa' AND bulan = '$bulan'");
            
            if (mysqli_num_rows($cek_bayar) == 0) {
                // Insert ke database
                $insert = mysqli_query($koneksi, "INSERT INTO pembayaran (id_siswa, tgl_pembayaran, bulan, nominal, metode, id_pegawai) 
                                                  VALUES ('$id_siswa', '$tanggal', '$bulan', '$nominal', '$metode', '$id_pegawai')");
                
                if ($insert) {
                    $success_count++;
                } else {
                    $failed_months[] = $bulan;
                }
            }
        }
        
        // Tampilkan hasil dan redirect dengan parameter siswa
        if ($success_count > 0) {
            $nama_siswa_query = mysqli_query($koneksi, "SELECT nama_siswa FROM siswa WHERE id_siswa = '$id_siswa'");
            $nama_siswa_data = mysqli_fetch_assoc($nama_siswa_query);
            $nama_siswa = $nama_siswa_data['nama_siswa'];
            
            $total_nominal = $success_count * 150000;
            
            echo "<script>
                alert('✅ PEMBAYARAN BERHASIL!\\n\\nNama: $nama_siswa\\nJumlah Bulan: $success_count bulan\\nTotal: Rp " . number_format($total_nominal, 0, ',', '.') . "');
                window.location='pembayaran.php?siswa=$id_siswa';
            </script>";
        } else {
            echo "<script>alert('❌ Semua bulan yang dipilih sudah dibayar sebelumnya!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP - SMK Negeri 1 Sukawati</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body>
    <div class="container">
        <!-- ===== BAGIAN KIRI: INFO SEKOLAH ===== -->
        <div class="left-section">
            <div class="school-info">
                <div class="school-logo">
                    <i class="fas fa-school"></i>
                </div>
                
                <h1>SMK NEGERI 1 SUKAWATI</h1>
                <p>Sistem Pembayaran SPP Online</p>
                
                <div class="info-card">
                    <h3><i class="fas fa-info-circle"></i> Informasi Pembayaran</h3>
                    <div class="info-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>Biaya SPP: <strong>Rp 150.000/bulan</strong></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Pembayaran periode Januari - Desember</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-check-double"></i>
                        <span>Bisa bayar beberapa bulan sekaligus</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Data terenkripsi dan aman</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ===== BAGIAN KANAN: FORM PEMBAYARAN ===== -->
        <div class="right-section">
            <div class="form-header">
                <h2>Form Pembayaran SPP</h2>
                <p>Silakan isi data pembayaran dengan lengkap dan benar</p>
            </div>
            
            <form method="POST" action="" id="formPembayaran">
                <!-- INPUT 1: DROPDOWN NAMA SISWA -->
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Nama Siswa</label>
                    <select name="id_siswa" id="id_siswa" class="form-control" required onchange="loadBulanTerbayar()">
                        <option value="">-- Pilih Nama Siswa --</option>
                        <?php while ($siswa = mysqli_fetch_assoc($siswa_list)): ?>
                            <option value="<?= $siswa['id_siswa']; ?>" <?= ($siswa_terpilih == $siswa['id_siswa']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($siswa['nama_siswa']); ?> (NIS: <?= $siswa['nis']; ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <!-- INPUT 2: TANGGAL PEMBAYARAN -->
                <div class="form-group">
                    <label><i class="fas fa-calendar-alt"></i> Tanggal Pembayaran</label>
                    <input type="date" name="tanggal" class="form-control" required value="<?= date('Y-m-d'); ?>">
                </div>
                
                <!-- INPUT 3: DROPDOWN MULTIPLE SELECT BULAN -->
                <div class="form-group">
                    <label><i class="fas fa-calendar"></i> Pilih Bulan Pembayaran</label>
                    <p class="helper-text">💡 Tahan <kbd>Ctrl</kbd> (Windows) atau <kbd>Cmd</kbd> (Mac) untuk pilih beberapa bulan</p>
                    
                    <div class="bulan-select-wrapper">
                        <select name="bulan[]" id="bulanSelect" class="form-control" multiple required onchange="updateNominal()">
                            <?php
                            $bulan_nama = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                            
                            foreach ($bulan_nama as $num => $nama) {
                                echo "<option value='$num' id='option_bulan_$num'>$nama</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="select-hint">
                        <i class="fas fa-info-circle"></i>
                        <span>Bulan yang sudah dibayar akan <strong>hilang otomatis</strong> dari daftar</span>
                    </div>
                </div>
                
                <!-- DISPLAY NOMINAL (AUTO CALCULATE) -->
                <div class="nominal-display">
                    <p>Total Pembayaran</p>
                    <h3 id="nominalDisplay">Rp 0</h3>
                    <p class="detail"><span id="jumlahBulan">0</span> bulan × Rp 150.000</p>
                </div>
                
                <!-- INPUT 4: DROPDOWN METODE PEMBAYARAN -->
                <div class="form-group">
                    <label><i class="fas fa-credit-card"></i> Metode Pembayaran</label>
                    <select name="metode" class="form-control" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Tunai">💵 Tunai</option>
                        <option value="Transfer">🏦 Transfer Bank</option>
                        <option value="E-Wallet">📱 E-Wallet (GoPay/OVO/Dana)</option>
                        <option value="Kartu">💳 Kartu Debit/Kredit</option>
                    </select>
                </div>
                
                <!-- TOMBOL SUBMIT -->
                <button type="submit" class="btn-submit" id="btnSubmit">
                    <i class="fas fa-paper-plane"></i> Proses Pembayaran
                </button>
            </form>
        </div>
    </div>

        <style>
        /* ===== RESET & GLOBAL STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        /* ===== CONTAINER UTAMA ===== */
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            max-width: 1200px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* ===== BAGIAN KIRI: GAMBAR & INFO ===== */
        .left-section {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.9)),
                        url('WhatsApp Image 2025-10-20 at 11.15.40_c3f1fa4f.jpg');
            background-size: cover;
            background-position: center;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            position: relative;
        }
        
        .left-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
        }
        
        .school-info {
            position: relative;
            z-index: 1;
        }
        
        .school-logo {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .school-logo i {
            font-size: 50px;
            color: #667eea;
        }
        
        .school-info h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .school-info p {
            font-size: 18px;
            opacity: 0.95;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .info-card h3 {
            font-size: 16px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        /* ===== BAGIAN KANAN: FORM ===== */
        .right-section {
            padding: 60px 50px;
            background: #f8f9fa;
            overflow-y: auto;
            max-height: 100vh;
        }
        
        .form-header {
            margin-bottom: 40px;
        }
        
        .form-header h2 {
            color: #2d3748;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .form-header p {
            color: #718096;
            font-size: 14px;
        }
        
        /* ===== STYLING FORM ===== */
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            color: #2d3748;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .form-group label i {
            color: #667eea;
            margin-right: 8px;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        /* Styling khusus untuk select dropdown */
        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23667eea' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 40px;
        }
        
        /* ===== CUSTOM DROPDOWN BULAN (HIDE PAID MONTHS) ===== */
        .bulan-select-wrapper {
            position: relative;
        }
        
        select[multiple].form-control {
            height: auto;
            min-height: 200px;
            padding: 10px;
            background-image: none;
        }
        
        select[multiple].form-control option {
            padding: 12px 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        select[multiple].form-control option:hover {
            background: #667eea !important;
            color: white !important;
        }
        
        select[multiple].form-control option:checked {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            color: white !important;
            font-weight: 600;
        }
        
        /* Hide disabled options completely */
        select[multiple].form-control option:disabled {
            display: none;
        }
        
        .select-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            padding: 10px;
            background: #f0f7ff;
            border-radius: 8px;
            font-size: 12px;
            color: #2563eb;
        }
        
        .select-hint i {
            font-size: 14px;
        }
        
        /* ===== NOMINAL DISPLAY ===== */
        .nominal-display {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 25px;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .nominal-display p {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        
        .nominal-display h3 {
            font-size: 32px;
            font-weight: 700;
        }
        
        .nominal-display .detail {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 8px;
        }
        
        /* ===== TOMBOL SUBMIT ===== */
        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        /* Helper Text */
        .helper-text {
            font-size: 12px;
            color: #718096;
            margin-top: 5px;
        }
        
        /* ===== RESPONSIVE DESIGN ===== */
                    @media (max-width: 968px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .left-section {
                padding: 40px 30px;
                min-height: 300px;
            }
            
            .school-info h1 {
                font-size: 26px;
            }
            
            .right-section {
                padding: 40px 30px;
            }
        }
        
        @media (max-width: 576px) {
            body {
                padding: 10px;
            }
            
            .left-section {
                padding: 30px 20px;
                min-height: 250px;
            }
            
            .school-logo {
                width: 70px;
                height: 70px;
                margin-bottom: 20px;
            }
            
            .school-logo i {
                font-size: 35px;
            }
            
            .school-info h1 {
                font-size: 22px;
            }
            
            .school-info p {
                font-size: 14px;
            }
            
            .right-section {
                padding: 30px 20px;
            }
            
            .form-header h2 {
                font-size: 22px;
            }
            
            .form-control {
                padding: 12px 15px;
                font-size: 14px;
            }
            
            .nominal-display h3 {
                font-size: 26px;
            }
        }
    </style>
    
    <!-- ===== JAVASCRIPT ===== -->
    <script>
        /**
         * FUNGSI 1: UPDATE NOMINAL OTOMATIS
         * Menghitung total nominal berdasarkan jumlah bulan yang dipilih
         */
        function updateNominal() {
            const selectElement = document.getElementById('bulanSelect');
            const selectedOptions = Array.from(selectElement.selectedOptions);
            const jumlahBulan = selectedOptions.length;
            const nominalPerBulan = 150000;
            const totalNominal = jumlahBulan * nominalPerBulan;
            
            // Update display
            document.getElementById('nominalDisplay').textContent = 'Rp ' + totalNominal.toLocaleString('id-ID');
            document.getElementById('jumlahBulan').textContent = jumlahBulan;
            
            // Enable/disable tombol submit
            const btnSubmit = document.getElementById('btnSubmit');
            btnSubmit.disabled = jumlahBulan === 0;
        }
        
        /**
         * FUNGSI 2: LOAD BULAN YANG SUDAH DIBAYAR
         * MENGHILANGKAN (hide) opsi bulan yang sudah dibayar dari dropdown
         */
        function loadBulanTerbayar() {
            const siswaId = document.getElementById('id_siswa').value;
            const selectElement = document.getElementById('bulanSelect');
            const allOptions = selectElement.querySelectorAll('option');
            
            if (!siswaId) {
                // Reset: tampilkan semua bulan jika tidak ada siswa dipilih
                allOptions.forEach(option => {
                    option.disabled = false;
                    option.selected = false;
                });
                updateNominal();
                return;
            }
            
            // AJAX Request ke server
            fetch('?ajax=get_bulan_terbayar&id_siswa=' + siswaId)
                .then(response => response.json())
                .then(data => {
                    // Reset: tampilkan semua bulan terlebih dahulu
                    allOptions.forEach(option => {
                        option.disabled = false;
                        option.selected = false;
                    });
                    
                    // HIDE (disable) bulan yang sudah dibayar - akan hilang dari tampilan
                    data.bulan_terbayar.forEach(bulan => {
                        const option = document.getElementById('option_bulan_' + bulan);
                        if (option) {
                            option.disabled = true; // Dengan CSS display:none, option akan hilang
                        }
                    });
                    
                    updateNominal();
                })
                .catch(error => console.error('Error:', error));
        }
        
        /**
         * FUNGSI 3: VALIDASI FORM SEBELUM SUBMIT
         */
        document.getElementById('formPembayaran').addEventListener('submit', function(e) {
            const siswa = document.getElementById('id_siswa').value;
            const selectElement = document.getElementById('bulanSelect');
            const selectedOptions = Array.from(selectElement.selectedOptions);
            
            if (!siswa) {
                e.preventDefault();
                alert('⚠️ Silakan pilih nama siswa!');
                return false;
            }
            
            if (selectedOptions.length === 0) {
                e.preventDefault();
                alert('⚠️ Silakan pilih minimal 1 bulan pembayaran!');
                return false;
            }
            
            // Konfirmasi sebelum submit
            const jumlahBulan = selectedOptions.length;
            const totalNominal = jumlahBulan * 150000;
            const bulanDipilih = selectedOptions.map(opt => opt.text).join(', ');
            
            const konfirmasi = confirm(`Konfirmasi Pembayaran:\n\nBulan: ${bulanDipilih}\nJumlah: ${jumlahBulan} bulan\nTotal: Rp ${totalNominal.toLocaleString('id-ID')}\n\nLanjutkan pembayaran?`);
            
            if (!konfirmasi) {
                e.preventDefault();
                return false;
            }
        });
        
        // Initialize: disable submit button on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btnSubmit').disabled = true;
            
            // Auto-load bulan terbayar jika ada siswa yang terpilih (setelah submit)
            const siswaSelect = document.getElementById('id_siswa');
            if (siswaSelect.value) {
                loadBulanTerbayar();
            }
        });
    </script>
</body>
</html>

<?php
/**
 * ===== AJAX HANDLER =====
 * Menangani request AJAX untuk mendapatkan data bulan yang sudah dibayar
 */
if (isset($_GET['ajax']) && $_GET['ajax'] == 'get_bulan_terbayar') {
    $id_siswa = mysqli_real_escape_string($koneksi, $_GET['id_siswa']);
    $bulan_terbayar = getBulanTerbayar($koneksi, $id_siswa);
    
    header('Content-Type: application/json');
    echo json_encode(['bulan_terbayar' => $bulan_terbayar]);
    exit;
}
?>