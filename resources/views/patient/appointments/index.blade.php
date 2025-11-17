<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Riwayat Janji Temu 📋
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola semua janji temu Anda</p>
            </div>
            <a href="{{ route('patient.doctors.index') }}" 
               class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-xl font-bold hover:from-green-600 hover:to-green-700 transition transform hover:scale-105 shadow-lg">
                <span class="hidden md:inline">+ Buat Janji Temu Baru</span>
                <span class="md:hidden">+ Buat Baru</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filter Tabs -->
            <div class="bg-white rounded-2xl shadow-lg p-2 mb-8 inline-flex space-x-2" data-aos="fade-down">
                <a href="{{ route('patient.appointments.index') }}" 
                   class="px-6 py-2 rounded-xl font-semibold transition {{ !request('status') ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Semua
                </a>
                <a href="{{ route('patient.appointments.index', ['status' => 'pending']) }}" 
                   class="px-6 py-2 rounded-xl font-semibold transition {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Menunggu
                </a>
                <a href="{{ route('patient.appointments.index', ['status' => 'confirmed']) }}" 
                   class="px-6 py-2 rounded-xl font-semibold transition {{ request('status') == 'confirmed' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Dikonfirmasi
                </a>
                <a href="{{ route('patient.appointments.index', ['status' => 'completed']) }}" 
                   class="px-6 py-2 rounded-xl font-semibold transition {{ request('status') == 'completed' ? 'bg-green-500 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    Selesai
                </a>
            </div>

            <!-- Appointments List -->
            <div class="space-y-4">
                @forelse($appointments as $index => $appointment)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 50 }}">
                    
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <!-- Left Side -->
                            <div class="flex-1 mb-4 md:mb-0">
                                <div class="flex items-center space-x-4 mb-3">
                                    <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full p-3">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">{{ $appointment->doctor->user->name }}</h3>
                                        <p class="text-sm text-blue-600 font-semibold">{{ $appointment->doctor->specialization->name }}</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 ml-0 md:ml-16">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="bg-gray-100 rounded-lg p-2 mr-2">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                        <span class="font-medium">{{ $appointment->queue_number }}</span>
                                    </div>

                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="bg-gray-100 rounded-lg p-2 mr-2">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span>{{ $appointment->appointment_date->format('d M Y') }}</span>
                                    </div>

                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="bg-gray-100 rounded-lg p-2 mr-2">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span>{{ $appointment->appointment_time->format('H:i') }} WIB</span>
                                    </div>
                                </div>

                                <div class="mt-3 ml-0 md:ml-16">
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">Keluhan:</span> {{ Str::limit($appointment->complaint, 80) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Right Side -->
                            <div class="flex flex-col items-end space-y-3">
                                <span class="px-4 py-2 rounded-full text-sm font-bold
                                    {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($appointment->status === 'confirmed' ? 'bg-blue-100 text-blue-800' : 
                                       ($appointment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')) }}">
                                    {{ $appointment->status === 'pending' ? '⏳ Menunggu' : 
                                       ($appointment->status === 'confirmed' ? '✓ Dikonfirmasi' : 
                                       ($appointment->status === 'completed' ? '✓ Selesai' : '✗ Dibatalkan')) }}
                                </span>

                                <div class="flex space-x-2">
                                    <a href="{{ route('patient.appointments.show', $appointment) }}" 
                                       class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl font-semibold hover:bg-blue-100 transition">
                                        Detail
                                    </a>
                                    @if($appointment->status !== 'completed' && $appointment->status !== 'cancelled')
                                    <a href="{{ route('patient.appointments.cancel', $appointment) }}" 
                                       onclick="return confirm('Yakin ingin membatalkan janji temu ini?')"
                                       class="bg-red-50 text-red-600 px-4 py-2 rounded-xl font-semibold hover:bg-red-100 transition">
                                        Batalkan
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl shadow-lg p-16 text-center" data-aos="fade-up">
                    <div class="inline-block bg-gray-100 rounded-full p-8 mb-4">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Janji Temu</h3>
                    <p class="text-gray-600 mb-6">Yuk, buat janji temu pertama Anda!</p>
                    <a href="{{ route('patient.doctors.index') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full font-bold hover:from-green-600 hover:to-green-700 transition transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Buat Janji Temu
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($appointments->hasPages())
            <div class="mt-8" data-aos="fade-up">
                {{ $appointments->links() }}
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