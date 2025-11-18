<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik Online - Sistem Antrian & Reservasi Dokter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
        <!-- Header -->
        <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full p-2 mr-3">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Klinik Online
                            </h1>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route(auth()->user()->role . 'dashboard') }}" 
                               class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-full font-semibold hover:from-blue-600 hover:to-indigo-700 transition transform hover:scale-105 shadow-md">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="text-gray-700 hover:text-blue-600 font-semibold transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" 
                               class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-full font-semibold hover:from-blue-600 hover:to-indigo-700 transition transform hover:scale-105 shadow-md">
                                Daftar Gratis
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <div class="inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                        ✨ Platform Kesehatan Digital Terpercaya
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Sistem Antrian & <br>
                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                            Reservasi Dokter
                        </span>
                        <br> Online
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Permudah proses konsultasi Anda dengan sistem reservasi online. 
                        Pilih dokter, pilih jadwal, dan dapatkan nomor antrian secara instan! 🚀
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        @auth
                            <a href="{{ route(auth()->user()->role . 'dashboard') }}" 
                               class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-8 py-4 rounded-full text-lg font-bold hover:from-blue-600 hover:to-indigo-700 transition transform hover:scale-105 shadow-xl text-center">
                                Ke Dashboard →
                            </a>
                        @else
                            <a href="{{ route('register') }}" 
                               class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-8 py-4 rounded-full text-lg font-bold hover:from-blue-600 hover:to-indigo-700 transition transform hover:scale-105 shadow-xl text-center">
                                Mulai Sekarang →
                            </a>
                            <a href="{{ route('login') }}" 
                               class="bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-bold border-2 border-blue-600 hover:bg-blue-50 transition text-center">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>

                <div data-aos="fade-left" class="relative">
                    <div class="relative">
                        <div class="absolute -top-10 -right-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                        <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                        
                        <div class="relative bg-white rounded-2xl shadow-2xl p-8">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-500 rounded-full w-3 h-3 mr-2"></div>
                                <span class="text-sm text-gray-600">Online Now</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Statistik Real-time</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Dokter Aktif</span>
                                    <span class="text-2xl font-bold text-blue-600">24+</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Pasien Terlayani</span>
                                    <span class="text-2xl font-bold text-green-600">1000+</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Rating</span>
                                    <span class="text-2xl font-bold text-yellow-500">⭐ 4.9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Kenapa Memilih Kami? 🌟</h2>
                <p class="text-xl text-gray-600">Solusi kesehatan digital yang mudah dan terpercaya</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-gradient-to-br from-blue-400 to-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">📅 Reservasi Online</h3>
                    <p class="text-gray-600 leading-relaxed">Buat janji temu dengan dokter pilihan Anda secara online, kapan saja dan di mana saja. Mudah dan praktis!</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-gradient-to-br from-green-400 to-green-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">⏱️ Sistem Antrian</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan nomor antrian otomatis dan ketahui jadwal konsultasi Anda dengan jelas. Tidak perlu lagi antri panjang!</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-gradient-to-br from-purple-400 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">📋 Riwayat Medis</h3>
                    <p class="text-gray-600 leading-relaxed">Akses riwayat konsultasi, diagnosis, dan resep Anda dengan mudah. Semua data tersimpan dengan aman!</p>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="bg-gradient-to-br from-blue-500 to-indigo-600 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 text-white" data-aos="fade-up">
                    <h2 class="text-4xl font-bold mb-4">Cara Menggunakan 🚀</h2>
                    <p class="text-xl text-blue-100">Hanya 4 langkah mudah untuk konsultasi dengan dokter</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center text-white" data-aos="zoom-in" data-aos-delay="100">
                        <div class="bg-white/20 backdrop-blur-sm w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl font-bold">1</div>
                        <h3 class="text-xl font-bold mb-2">Daftar/Login</h3>
                        <p class="text-blue-100">Buat akun gratis atau login ke sistem</p>
                    </div>

                    <div class="text-center text-white" data-aos="zoom-in" data-aos-delay="200">
                        <div class="bg-white/20 backdrop-blur-sm w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl font-bold">2</div>
                        <h3 class="text-xl font-bold mb-2">Pilih Dokter</h3>
                        <p class="text-blue-100">Cari dan pilih dokter sesuai kebutuhan</p>
                    </div>

                    <div class="text-center text-white" data-aos="zoom-in" data-aos-delay="300">
                        <div class="bg-white/20 backdrop-blur-sm w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl font-bold">3</div>
                        <h3 class="text-xl font-bold mb-2">Buat Janji</h3>
                        <p class="text-blue-100">Tentukan tanggal dan waktu konsultasi</p>
                    </div>

                    <div class="text-center text-white" data-aos="zoom-in" data-aos-delay="400">
                        <div class="bg-white/20 backdrop-blur-sm w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl font-bold">4</div>
                        <h3 class="text-xl font-bold mb-2">Konsultasi</h3>
                        <p class="text-blue-100">Datang sesuai jadwal dan nomor antrian</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-3xl shadow-2xl overflow-hidden" data-aos="zoom-in">
                <div class="px-8 py-16 text-center text-white">
                    <h2 class="text-4xl font-bold mb-4">Siap Memulai Konsultasi? 💙</h2>
                    <p class="text-xl mb-8 text-blue-100">Bergabunglah dengan ribuan pengguna yang telah merasakan kemudahan layanan kami</p>
                    @auth
                        <a href="{{ route(auth()->user()->role . 'dashboard') }}" 
                           class="inline-block bg-white text-blue-600 px-10 py-4 rounded-full text-lg font-bold hover:bg-blue-50 transition transform hover:scale-105 shadow-xl">
                            Ke Dashboard →
                        </a>
                    @else
                        <a href="{{ route('register') }}" 
                           class="inline-block bg-white text-blue-600 px-10 py-4 rounded-full text-lg font-bold hover:bg-blue-50 transition transform hover:scale-105 shadow-xl">
                            Daftar Sekarang - Gratis! 🎉
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold mb-2">Klinik Online</h3>
                    <p class="text-gray-400">Sistem Antrian & Reservasi Dokter Modern</p>
                </div>
                <div class="border-t border-gray-800 pt-6">
                    <p class="text-gray-400">&copy; 2025 Klinik Online. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });
    </script>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>
</html>