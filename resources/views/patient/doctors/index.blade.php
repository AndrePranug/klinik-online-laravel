<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Cari Dokter 🔍
            </h2>
            <p class="text-sm text-gray-600 mt-1">Temukan dokter terbaik sesuai kebutuhan Anda</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search & Filter Section -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-down">
                <form method="GET" action="{{ route('patient.doctors.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Search Input -->
                        <div class="md:col-span-2">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Dokter</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    placeholder="Cari dokter..."
                                    class="pl-10 w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition">
                            </div>
                        </div>

                        <!-- Specialization Filter -->
                        <div>
                            <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">Spesialisasi</label>
                            <select name="specialization" id="specialization"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition">
                                <option value="">Semua Spesialisasi</option>
                                @foreach($specializations as $specialization)
                                    <option value="{{ $specialization->id }}" {{ request('specialization') == $specialization->id ? 'selected' : '' }}>
                                        {{ $specialization->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-xl font-semibold hover:from-blue-600 hover:to-blue-700 transition transform hover:scale-105 shadow-md">
                            🔍 Cari Dokter
                        </button>
                        <a href="{{ route('patient.doctors.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded-xl font-semibold hover:bg-gray-200 transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            <div class="mb-6" data-aos="fade-up">
                <p class="text-gray-600">
                    Ditemukan <span class="font-bold text-blue-600">{{ $doctors->count() }}</span> dokter
                </p>
            </div>

            <!-- Doctors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($doctors as $index => $doctor)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2" 
                     data-aos="zoom-in" 
                     data-aos-delay="{{ $index * 100 }}">
                    
                    <!-- Doctor Image/Avatar -->
                    <div class="relative h-48 bg-gradient-to-br from-blue-400 to-indigo-600">
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            @if($doctor->photo)
                                <img class="h-32 w-32 rounded-full object-cover border-4 border-white shadow-xl" 
                                     src="{{ Storage::url($doctor->photo) }}" 
                                     alt="{{ $doctor->user->name }}">
                            @else
                                <div class="h-32 w-32 rounded-full bg-white flex items-center justify-center border-4 border-white shadow-xl">
                                    <span class="text-5xl font-bold text-blue-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Doctor Info -->
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $doctor->user->name }}</h3>
                            <p class="text-sm text-blue-600 font-semibold">{{ $doctor->specialization->name }}</p>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <div class="bg-blue-100 rounded-lg p-2 mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span><span class="font-semibold">{{ $doctor->experience_years }}</span> tahun pengalaman</span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600">
                                <div class="bg-green-100 rounded-lg p-2 mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="font-bold text-green-600">Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($doctor->bio)
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $doctor->bio }}</p>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex space-x-2">
                            <a href="{{ route('patient.doctors.show', $doctor) }}" 
                               class="flex-1 bg-blue-50 text-blue-600 text-center py-2 rounded-xl font-semibold hover:bg-blue-100 transition">
                                Detail
                            </a>
                            <a href="{{ route('patient.appointments.create', ['doctor_id' => $doctor->id]) }}" 
                               class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white text-center py-2 rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition shadow-md">
                                Buat Janji
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-16" data-aos="fade-up">
                    <div class="inline-block bg-gray-100 rounded-full p-8 mb-4">
                        <svg class="w-20 h-20 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Dokter Tidak Ditemukan</h3>
                    <p class="text-gray-600 mb-4">Coba kata kunci atau filter lain</p>
                    <a href="{{ route('patient.doctors.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-semibold">
                        Lihat Semua Dokter
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @endforelse
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