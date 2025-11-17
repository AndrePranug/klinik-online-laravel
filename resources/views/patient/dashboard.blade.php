<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Halo, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="text-sm text-gray-600 mt-1">Selamat datang kembali di Klinik Online</p>
            </div>
            <div class="hidden md:block">
                <span class="text-sm text-gray-500">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section with Next Appointment -->
            @if($next_appointment)
            <div class="mb-8 relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700 shadow-xl" data-aos="fade-up">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-10 rounded-full"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-white opacity-5 rounded-full"></div>
                
                <div class="relative p-8 text-white">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-blue-100 text-sm font-medium mb-1">Janji Temu Berikutnya</p>
                            <h3 class="text-3xl font-bold">{{ $next_appointment->queue_number }}</h3>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
                            <span class="text-sm font-semibold">
                                {{ $next_appointment->status === 'confirmed' ? '✓ Dikonfirmasi' : '⏳ Menunggu' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-blue-100 text-xs">Dokter</p>
                                <p class="font-semibold">{{ $next_appointment->doctor->user->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-blue-100 text-xs">Tanggal & Waktu</p>
                                <p class="font-semibold">{{ $next_appointment->appointment_date->format('d M Y') }}</p>
                                <p class="text-sm">{{ $next_appointment->appointment_time->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg p-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-blue-100 text-xs">Spesialisasi</p>
                                <p class="font-semibold">{{ $next_appointment->doctor->specialization->name }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('patient.appointments.show', $next_appointment) }}" class="inline-flex items-center bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-50 transition transform hover:scale-105">
                        Lihat Detail
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            @else
            <div class="mb-8 relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-500 via-purple-600 to-pink-600 shadow-xl" data-aos="fade-up">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative p-8 text-center text-white">
                    <div class="mb-6">
                        <div class="inline-block bg-white/20 backdrop-blur-sm rounded-full p-6 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Belum Ada Janji Temu</h3>
                        <p class="text-purple-100">Yuk, buat janji temu dengan dokter pilihan Anda!</p>
                    </div>
                    <a href="{{ route('patient.doctors.index') }}" class="inline-flex items-center bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-purple-50 transition transform hover:scale-105">
                        Cari Dokter Sekarang
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            @endif

            <!-- Quick Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Mendatang</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['upcoming_appointments'] }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Selesai</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['completed_appointments'] }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500 hover:shadow-xl transition transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Dibatalkan</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $stats['cancelled_appointments'] }}</p>
                        </div>
                        <div class="bg-red-100 rounded-full p-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions dengan Animasi -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Menu Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('patient.doctors.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="100">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition"></div>
                        <div class="p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full w-16 h-16 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold mb-2">Cari Dokter</h4>
                            <p class="text-blue-100 text-sm mb-4">Temukan dokter terbaik sesuai kebutuhan Anda</p>
                            <div class="flex items-center text-sm font-semibold">
                                Mulai Pencarian
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('patient.appointments.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="200">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition"></div>
                        <div class="p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full w-16 h-16 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold mb-2">Buat Janji Temu</h4>
                            <p class="text-green-100 text-sm mb-4">Jadwalkan konsultasi dengan mudah</p>
                            <div class="flex items-center text-sm font-semibold">
                                Buat Sekarang
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('patient.appointments.index') }}" class="group relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="zoom-in" data-aos-delay="300">
                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition"></div>
                        <div class="p-6 text-white">
                            <div class="bg-white/20 backdrop-blur-sm rounded-full w-16 h-16 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold mb-2">Riwayat Medis</h4>
                            <p class="text-purple-100 text-sm mb-4">Lihat semua riwayat konsultasi Anda</p>
                            <div class="flex items-center text-sm font-semibold">
                                Lihat Riwayat
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Appointments dengan Timeline -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Riwayat Terbaru</h3>
                    @if($recent_appointments->count() > 0)
                    <a href="{{ route('patient.appointments.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold flex items-center">
                        Lihat Semua
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    @endif
                </div>

                <div class="space-y-4">
                    @forelse($recent_appointments as $appointment)
                    <div class="relative pl-8 pb-6 border-l-2 
                        {{ $appointment->status === 'completed' ? 'border-green-400' : 
                           ($appointment->status === 'cancelled' ? 'border-red-400' : 
                           ($appointment->status === 'confirmed' ? 'border-blue-400' : 'border-yellow-400')) }}
                        last:border-transparent last:pb-0">
                        
                        <div class="absolute left-0 top-0 -translate-x-1/2 w-4 h-4 rounded-full
                            {{ $appointment->status === 'completed' ? 'bg-green-500' : 
                               ($appointment->status === 'cancelled' ? 'bg-red-500' : 
                               ($appointment->status === 'confirmed' ? 'bg-blue-500' : 'bg-yellow-500')) }}
                            ring-4 ring-white"></div>

                        <div class="bg-gray-50 rounded-xl p-4 hover:bg-gray-100 transition">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <h4 class="font-bold text-gray-800">{{ $appointment->doctor->user->name }}</h4>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($appointment->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : 
                                               ($appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                            {{ $appointment->status === 'pending' ? 'Menunggu' : 
                                               ($appointment->status === 'confirmed' ? 'Dikonfirmasi' : 
                                               ($appointment->status === 'completed' ? 'Selesai' : 'Dibatalkan')) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1">{{ $appointment->doctor->specialization->name }}</p>
                                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $appointment->appointment_date->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            {{ $appointment->queue_number }}
                                        </span>
                                    </div>
                                </div>
                                <a href="{{ route('patient.appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold whitespace-nowrap">
                                    Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <div class="inline-block bg-gray-100 rounded-full p-6 mb-4">
                            <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 mb-4">Belum ada riwayat konsultasi</p>
                        <a href="{{ route('patient.doctors.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                            Buat Janji Temu Pertama
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>
</x-app-layout>