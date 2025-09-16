<!-- home.php -->
<div class="dashboard">
    <!-- Statistik Box -->
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-chalkboard-teacher"></i>
            <div class="stat-info">
                <h3>25</h3>
                <span>Guru</span>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <div class="stat-info">
                <h3>15</h3>
                <span>Pegawai</span>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-user-graduate"></i>
            <div class="stat-info">
                <h3>320</h3>
                <span>Siswa</span>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-door-open"></i>
            <div class="stat-info">
                <h3>12</h3>
                <span>Kelas</span>
            </div>
        </div>
    </div>

    <!-- Grafik & Pengumuman -->
    <div class="content-grid">
        <div class="card">
            <h2>Statistik Akademik</h2>
            <canvas id="chartData"></canvas>
        </div>

        <div class="card">
            <h2>Pengumuman</h2>
            <ul class="announcement-list">
                <li><i class="fas fa-bullhorn"></i> Ujian Tengah Semester dimulai tanggal 10 Oktober.</li>
                <li><i class="fas fa-bullhorn"></i> Rapat wali kelas hari Jumat jam 09:00 WIB.</li>
                <li><i class="fas fa-bullhorn"></i> Libur Maulid Nabi pada tanggal 15 Oktober.</li>
            </ul>
        </div>
    </div>
</div>

<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartData').getContext('2d');
    const chartData = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Guru', 'Pegawai', 'Siswa', 'Kelas'],
            datasets: [{
                label: 'Jumlah',
                data: [25, 15, 320, 12],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

<style>
.dashboard {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 15px;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.stat-card:hover {
    transform: translateY(-3px);
}

.stat-card i {
    font-size: 30px;
    color: #4e73df;
}

.stat-info h3 {
    margin: 0;
    font-size: 22px;
    font-weight: bold;
}

.stat-info span {
    color: #666;
    font-size: 14px;
}

.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

.card {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.card h2 {
    margin-bottom: 15px;
    font-size: 18px;
}

.announcement-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.announcement-list li {
    margin-bottom: 10px;
    font-size: 14px;
    color: #444;
}

.announcement-list i {
    color: #f6c23e;
    margin-right: 8px;
}
</style>
