<x-app-layout>
    <x-slot name="header">
        <a href="{{ $doctor ? route('patient.doctors.show', $doctor) : route('patient.doctors.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-2">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Buat Janji Temu 📅
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($doctor)
            <!-- Doctor Info Card -->
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-xl mb-8 overflow-hidden" data-aos="fade-down">
                <div class="p-6 text-white">
                    <p class="text-blue-100 text-sm mb-2">Anda akan membuat janji temu dengan:</p>
                    <div class="flex items-center">
                        @if($doctor->photo)
                            <img class="h-20 w-20 rounded-full object-cover border-4 border-white shadow-lg mr-4" 
                                 src="{{ Storage::url($doctor->photo) }}" 
                                 alt="{{ $doctor->user->name }}">
                        @else
                            <div class="h-20 w-20 rounded-full bg-white flex items-center justify-center border-4 border-white shadow-lg mr-4">
                                <span class="text-3xl font-bold text-blue-600">{{ substr($doctor->user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-2xl font-bold mb-1">{{ $doctor->user->name }}</h3>
                            <p class="text-blue-100 mb-1">{{ $doctor->specialization->name }}</p>
                            <p class="text-lg font-bold">Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Schedules -->
            @if($doctor->schedules->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                    <div class="bg-green-100 rounded-lg p-2 mr-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    Jadwal Praktik Tersedia
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($doctor->schedules as $schedule)
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-bold text-gray-800">{{ $schedule->day }}</p>
                                <p class="text-sm text-gray-600">{{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }} WIB</p>
                            </div>
                            <span class="bg-green-500 text-white text-xs px-3 py-1 rounded-full font-semibold">
                                {{ $schedule->slot_duration }} menit
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endif

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                <form method="POST" action="{{ route('patient.appointments.store') }}">
                    @csrf

                    @if($doctor)
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                    @else
                        <div class="mb-6">
                            <label for="doctor_id" class="block text-sm font-bold text-gray-700 mb-2">Pilih Dokter</label>
                            <select name="doctor_id" id="doctor_id" required
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition">
                                <option value="">Pilih Dokter</option>
                                <!-- Tambahkan list dokter jika diperlukan -->                                
                            </select>
                            @error('doctor_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="appointment_date" class="block text-sm font-bold text-gray-700 mb-2">
                                Tanggal Konsultasi
                            </label>
                            <input type="date" name="appointment_date" id="appointment_date" 
                                   value="{{ old('appointment_date') }}" 
                                   required 
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition">
                            @error('appointment_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Pilih tanggal sesuai jadwal dokter</p>
                        </div>

                        <div>
                            <label for="appointment_time" class="block text-sm font-bold text-gray-700 mb-2">
                                Waktu Konsultasi
                            </label>
                            <input type="time" name="appointment_time" id="appointment_time" 
                                   value="{{ old('appointment_time') }}" 
                                   required
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition">
                            @error('appointment_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Sesuaikan dengan jadwal praktik</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="complaint" class="block text-sm font-bold text-gray-700 mb-2">
                            Keluhan / Gejala yang Dialami
                        </label>
                        <textarea name="complaint" id="complaint" rows="5" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition"
                            placeholder="Jelaskan keluhan Anda secara detail agar dokter dapat mempersiapkan konsultasi dengan lebih baik...">{{ old('complaint') }}</textarea>
                        @error('complaint')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Important Notes -->
                    <div class="mb-6 bg-yellow-50 border-2 border-yellow-200 rounded-2xl p-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.363.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-yellow-800 font-bold mb-2">⚠️ Penting untuk Diperhatikan</h4>
                                <ul class="text-sm text-yellow-700 space-y-1 list-disc list-inside">
                                    <li>Pastikan tanggal dan waktu sesuai dengan <strong>jadwal praktik dokter</strong></li>
                                    <li>Datang <strong>15 menit sebelum</strong> waktu konsultasi</li>
                                    <li>Bawa <strong>kartu identitas</strong> dan riwayat medis jika ada</li>
                                    <li>Anda akan mendapatkan <strong>nomor antrian</strong> setelah konfirmasi</li>
                                    <li>Harap <strong>membatalkan</strong> jika berhalangan hadir</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ $doctor ? route('patient.doctors.show', $doctor) : route('patient.doctors.index') }}" 
                           class="flex-1 bg-gray-100 text-gray-700 text-center py-4 rounded-xl font-bold hover:bg-gray-200 transition">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-4 rounded-xl font-bold hover:from-blue-600 hover:to-blue-700 transition transform hover:scale-105 shadow-lg">
                            ✓ Buat Janji Temu
                        </button>
                    </div>
                </form>
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