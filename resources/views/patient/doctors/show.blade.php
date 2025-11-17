<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('patient.doctors.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-2">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Dokter
        </a>
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Detail Dokter
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Doctor Profile Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8" data-aos="fade-up">
                <div class="relative h-64 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-700">
                    <div class="absolute inset-0 bg-black opacity-10"></div>
                    <div class="absolute -bottom-20 left-1/2 transform -translate-x-1/2">
                        @if($doctor->photo)
                            <img class="h-40 w-40 rounded-full object-cover border-8 border-white shadow-2xl" 
                                 src="{{ Storage::url($doctor->photo) }}" 
                                 alt="{{ $doctor->user->name }}">
                        @else
                            <div class="h-40 w-40 rounded-full bg-white border-8 border-white shadow-2xl flex items-center justify-center">
                                <span class="text-6xl font-bold text-blue-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="pt-24 pb-8 px-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $doctor->user->name }}</h1>
                    <p class="text-lg text-blue-600 font-semibold mb-4">{{ $doctor->specialization->name }}</p>
                    
                    <div class="flex justify-center space-x-6 mb-6">
                        <div class="text-center">
                            <div class="bg-blue-100 rounded-full p-3 inline-block mb-2">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $doctor->experience_years }}</p>
                            <p class="text-sm text-gray-600">Tahun Pengalaman</p>
                        </div>

                        <div class="text-center">
                            <div class="bg-green-100 rounded-full p-3 inline-block mb-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($doctor->consultation_fee, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Biaya Konsultasi</p>
                        </div>

                        <div class="text-center">
                            <div class="bg-purple-100 rounded-full p-3 inline-block mb-2">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $doctor->license_number }}</p>
                            <p class="text-sm text-gray-600">No. Lisensi</p>
                        </div>
                    </div>

                    <a href="{{ route('patient.appointments.create', ['doctor_id' => $doctor->id]) }}" 
                       class="inline-flex items-center bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full font-bold hover:from-green-600 hover:to-green-700 transition transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Buat Janji Temu Sekarang
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Doctor -->
                    <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            Tentang Dokter
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $doctor->bio ?? 'Informasi bio belum tersedia.' }}
                        </p>
                    </div>

                    <!-- Specialization Info -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 border border-blue-100" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            Spesialisasi
                        </h3>
                        <div class="bg-white rounded-xl p-4">
                            <p class="text-lg font-bold text-blue-600 mb-2">{{ $doctor->specialization->name }}</p>
                            @if($doctor->specialization->description)
                            <p class="text-gray-600">{{ $doctor->specialization->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column - Schedule -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <div class="bg-green-100 rounded-lg p-2 mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            Jadwal Praktik
                        </h3>
                        
                        @forelse($doctor->schedules as $schedule)
                        <div class="mb-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-100 hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-bold text-gray-800">{{ $schedule->day }}</p>
                                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">{{ $schedule->slot_duration }} menit</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold">{{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }} WIB</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <div class="bg-gray-100 rounded-full p-4 inline-block mb-3">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500">Jadwal praktik belum tersedia</p>
                        </div>
                        @endforelse

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('patient.appointments.create', ['doctor_id' => $doctor->id]) }}" 
                               class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center py-3 rounded-xl font-bold hover:from-blue-600 hover:to-blue-700 transition shadow-md">
                                📅 Pilih Jadwal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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