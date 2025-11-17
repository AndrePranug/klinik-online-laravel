<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('patient.appointments.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-2">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Riwayat
        </a>
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Detail Janji Temu
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Queue Number Card -->
            <div class="relative overflow-hidden rounded-2xl mb-8" data-aos="zoom-in">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700"></div>
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-10 rounded-full"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-white opacity-5 rounded-full"></div>
                
                <div class="relative p-8 text-center text-white">
                    <p class="text-blue-100 text-sm font-medium mb-2">Nomor Antrian Anda</p>
                    <h1 class="text-5xl font-bold mb-4">{{ $appointment->queue_number }}</h1>
                    <div class="inline-block bg-white/20 backdrop-blur-sm rounded-full px-6 py-2">
                        <span class="font-bold text-lg">
                            @if($appointment->status === 'pending')
                                ⏳ Menunggu Konfirmasi
                            @elseif($appointment->status === 'confirmed')
                                ✓ Dikonfirmasi
                            @elseif($appointment->status === 'completed')
                                ✓ Selesai
                            @else
                                ✗ Dibatalkan
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Doctor Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-right">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <div class="bg-blue-100 rounded-lg p-2 mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        Informasi Dokter
                    </h3>
                    
                    <div class="flex items-center mb-4">
                        @if($appointment->doctor->photo)
                            <img class="h-16 w-16 rounded-full object-cover mr-4" src="{{ Storage::url($appointment->doctor->photo) }}" alt="{{ $appointment->doctor->user->name }}">
                        @else
                            <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                                <span class="text-2xl font-bold text-blue-600">{{ substr($appointment->doctor->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-gray-800">{{ $appointment->doctor->user->name }}</p>
                            <p class="text-sm text-blue-600 font-semibold">{{ $appointment->doctor->specialization->name }}</p>
                        </div>
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span><span class="font-semibold">{{ $appointment->doctor->experience_years }}</span> tahun pengalaman</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span>{{ $appointment->doctor->license_number }}</span>
                        </div>
                    </div>
                </div>

                <!-- Appointment Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-left">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <div class="bg-green-100 rounded-lg p-2 mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        Jadwal Konsultasi
                    </h3>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Tanggal</p>
                            <p class="text-lg font-bold text-gray-800">{{ $appointment->appointment_date->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Waktu</p>
                            <p class="text-lg font-bold text-gray-800">{{ $appointment->appointment_time->format('H:i') }} WIB</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Biaya Konsultasi</p>
                            <p class="text-lg font-bold text-green-600">Rp {{ number_format($appointment->doctor->consultation_fee, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Complaint Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6" data-aos="fade-up">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <div class="bg-purple-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    Keluhan Anda
                </h3>
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-gray-700">{{ $appointment->complaint }}</p>
                </div>
            </div>

            <!-- Medical Results (if completed) -->
            @if($appointment->diagnosis || $appointment->prescription)
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-lg p-6 border-2 border-green-200 mb-6" data-aos="fade-up">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <div class="bg-green-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    Hasil Konsultasi
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl p-4">
                        <p class="text-sm font-semibold text-gray-500 mb-2">Diagnosis</p>
                        <p class="text-gray-800">{{ $appointment->diagnosis ?? '-' }}</p>
                    </div>
                    <div class="bg-white rounded-xl p-4">
                        <p class="text-sm font-semibold text-gray-500 mb-2">Resep Obat</p>
                        <p class="text-gray-800">{{ $appointment->prescription ?? '-' }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4" data-aos="fade-up">
                <a href="{{ route('patient.appointments.index') }}" 
                   class="flex-1 bg-gray-100 text-gray-700 text-center py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                    ← Kembali ke Riwayat
                </a>
                
                @if($appointment->status !== 'completed' && $appointment->status !== 'cancelled')
                <a href="{{ route('patient.appointments.cancel', $appointment) }}" 
                   onclick="return confirm('Yakin ingin membatalkan janji temu ini?')"
                   class="flex-1 bg-red-500 text-white text-center py-3 rounded-xl font-bold hover:bg-red-600 transition shadow-md">
                    ✗ Batalkan Janji Temu
                </a>
                @endif
            </div>

            <!-- Important Notes -->
            @if($appointment->status === 'confirmed')
            <div class="mt-6 bg-blue-50 border-2 border-blue-200 rounded-2xl p-6" data-aos="fade-up">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-blue-800 font-bold mb-2">Persiapan Konsultasi</h4>
                        <ul class="text-sm text-blue-700 space-y-1 list-disc list-inside">
                            <li>Datang <strong>15 menit</strong> sebelum waktu konsultasi</li>
                            <li>Bawa <strong>kartu identitas</strong> dan nomor antrian ini</li>
                            <li>Siapkan <strong>riwayat medis</strong> jika ada</li>
                            <li>Jika berhalangan, harap batalkan janji temu</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- AOS Animation -->
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