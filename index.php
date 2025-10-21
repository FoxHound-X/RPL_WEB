<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMSR DIGITAL - SMK Negeri 1 Sukawati</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF6B00', // Orange from logo
                        secondary: '#1E1E1E',
                        accent: '#F5F3FF',
                    },
                }
            }
        }
    </script>
    <link rel="stylesheet" href="landpage.css"> <!-- For custom animations if needed -->
</head>
<body class="bg-gradient-to-br from-secondary to-gray-800 text-accent min-h-screen flex flex-col">

    <!-- Header -->
    <header class="sticky top-0 bg-secondary/80 backdrop-blur-md shadow-lg z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="logo flex items-center gap-3">
                <img src="https://smkn1sukawati.sch.id/wp-content/uploads/2024/02/logo.png" alt="SMK Negeri 1 Sukawati Logo" class="w-12 h-12">
                <h1 class="text-2xl font-bold">SMSR DIGITAL</h1>
            </div>
            <nav class="nav-links hidden md:flex gap-6">
                <a href="#home" class="hover:text-primary transition">Home</a>
                <a href="#mpk" class="hover:text-primary transition">MPK</a>
                <a href="#spp" class="hover:text-primary transition">Pembayaran SPP</a>
                <a href="#features" class="hover:text-primary transition">Jurnal</a>
                <a href="#contact" class="hover:text-primary transition">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero relative h-[80vh] flex items-center justify-center text-center bg-cover bg-center" style="background-image: url('https://www.shutterstock.com/image-vector/online-learning-digital-courses-icons-260nw-2102420422.jpg');">
        <div class="absolute inset-0 bg-secondary/70"></div>
        <div class="container mx-auto px-4 relative z-10">
            <h2 class="text-5xl font-bold mb-4 animate-fade-in">SMSR DIGITAL</h2>
            <p class="text-xl max-w-2xl mx-auto mb-8">Platform digital untuk absensi, jurnal guru, dan rekap pembayaran SPP di SMK Negeri 1 Sukawati. Empowering knowledge through technology.</p>
            <a href="login.php" class="btn bg-primary text-secondary px-6 py-3 rounded-lg hover:bg-orange-600 transition text-lg">Get Started</a>
        </div>
    </section>

    <!-- MPK Section -->
    <section id="mpk" class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-12">Majelis Permusyawaratan Kelas (MPK)</h3>
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-lg mb-6">MPK memungkinkan pengabsenan siswa secara digital saat baris di lapangan. Fitur ini memudahkan monitoring kehadiran dan integrasi data real-time.</p>
                    <ul class="list-disc pl-6 mb-6">
                        <li>Absensi harian otomatis</li>
                        <li>Laporan kehadiran bulanan</li>
                        <li>Notifikasi untuk siswa absen</li>
                    </ul>
                    <a href="mpk.php" class="btn bg-primary text-secondary px-6 py-3 rounded-lg hover:bg-orange-600 transition">Akses MPK</a>
                </div>
                <img src="https://images.stockcake.com/public/f/9/6/f9631831-84b8-47bb-b4bc-88c20daca52c_large/joyful-learning-moment-stockcake.jpg" alt="MPK Activity" class="rounded-xl shadow-lg">
            </div>
        </div>
    </section>

    <!-- Pembayaran SPP Section -->
    <section id="spp" class="py-20">
        <div class="container mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-12">Pembayaran SPP</h3>
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <img src="https://images.stockcake.com/public/3/0/4/304665f9-0911-4a8e-acb4-866e6c092aea_large/joyful-learning-moment-stockcake.jpg" alt="SPP Payment" class="rounded-xl shadow-lg">
                <div>
                    <p class="text-lg mb-6">Rekap pembayaran SPP secara online. Siswa dan pegawai dapat melihat status pembayaran, input data, dan generate laporan.</p>
                    <ul class="list-disc pl-6 mb-6">
                        <li>Input pembayaran real-time</li>
                        <li>Riwayat transaksi</li>
                        <li>Reminder tunggakan</li>
                    </ul>
                    <a href="loginuser.php" class="btn bg-primary text-secondary px-6 py-3 rounded-lg hover:bg-orange-600 transition">Akses SPP</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-12">Fitur Yang Tersedia</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card bg-secondary/50 backdrop-blur-md p-6 rounded-xl shadow-lg hover:scale-105 transition">
                    <i class="text-4xl mb-4">📚</i>
                    <h4 class="text-2xl font-semibold mb-2">Absensi Siswa</h4>
                    <p>MPK dapat mengabsen anggota kelas secara digital.</p>
                </div>
                <div class="card bg-secondary/50 backdrop-blur-md p-6 rounded-xl shadow-lg hover:scale-105 transition">
                    <i class="text-4xl mb-4">🎓</i>
                    <h4 class="text-2xl font-semibold mb-2">Jurnal Guru</h4>
                    <p>Guru mengisi jurnal online dengan mudah.</p>
                </div>
                <div class="card bg-secondary/50 backdrop-blur-md p-6 rounded-xl shadow-lg hover:scale-105 transition">
                    <i class="text-4xl mb-4">💻</i>
                    <h4 class="text-2xl font-semibold mb-2">Rekap SPP</h4>
                    <p>Lihat dan input pembayaran SPP siswa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20">
        <div class="container mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-12">Our Learning Moments</h3>
            <div class="grid md:grid-cols-4 gap-4">
                <img src="https://media.gettyimages.com/id/1468140092/photo/happy-elementary-students-raising-their-hands-on-a-class-at-school.jpg?s=612x612&w=gi&k=20&c=cSnjUefDYC1-SPMuoeUwA3PvUWfCNweGLv1pSGAXPd4=" alt="Learning Moment 1" class="rounded-xl shadow-lg hover:scale-105 transition" loading="lazy">
                <img src="https://images.stockcake.com/public/7/c/9/7c910ddb-d3ea-4db4-be4a-be3c4629c99d_large/joyful-learning-moment-stockcake.jpg" alt="Learning Moment 2" class="rounded-xl shadow-lg hover:scale-105 transition" loading="lazy">
                <img src="https://images.stockcake.com/public/f/9/6/f9631831-84b8-47bb-b4bc-88c20daca52c_large/joyful-learning-moment-stockcake.jpg" alt="Learning Moment 3" class="rounded-xl shadow-lg hover:scale-105 transition" loading="lazy">
                <img src="https://images.stockcake.com/public/3/0/4/304665f9-0911-4a8e-acb4-866e6c092aea_large/joyful-learning-moment-stockcake.jpg" alt="Learning Moment 4" class="rounded-xl shadow-lg hover:scale-105 transition" loading="lazy">
            </div>
        </div>
    </section>

    <!-- Testimonial Section (New) -->
    <section class="py-20 bg-gray-900">
        <div class="container mx-auto px-4">
            <h3 class="text-4xl font-bold text-center mb-12">What Our Users Say</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="testimonial bg-secondary/50 backdrop-blur-md p-6 rounded-xl shadow-lg">
                    <p>"Platform ini memudahkan absensi siswa!"</p>
                    <span class="block mt-4 font-semibold">- Guru MPK</span>
                </div>
                <div class="testimonial bg-secondary/50 backdrop-blur-md p-6 rounded-xl shadow-lg">
                    <p>"Rekap SPP jadi lebih transparan."</p>
                    <span class="block mt-4 font-semibold">- Orang Tua Siswa</span>
                </div>
                <div class="testimonial bg-secondary/50 backdrop-blur-md p-6 rounded-xl shadow-lg">
                    <p>"Jurnal online hemat waktu."</p>
                    <span class="block mt-4 font-semibold">- Guru</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary py-8 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 SMSR DIGITAL - SMK Negeri 1 Sukawati. All rights reserved.</p>
            <div class="flex justify-center gap-6 mt-4">
                <a href="#mpk" class="hover:text-primary">MPK</a>
                <a href="#spp" class="hover:text-primary">SPP</a>
                <a href="#features" class="hover:text-primary">Jurnal</a>
            </div>
        </div>
    </footer>

</body>
</html>