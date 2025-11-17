@extends('layouts.doctor')

@section('title', 'Input Diagnosis & Resep')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <a href="{{ route('doctor.appointments.show', $appointment) }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 mb-4 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Detail
        </a>
        <div class="flex items-center">
            <div class="flex-shrink-0 p-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h1 class="text-2xl font-bold text-gray-900">Input Diagnosis & Resep</h1>
                <p class="text-sm text-gray-600 mt-1">Lengkapi hasil konsultasi pasien</p>
            </div>
        </div>
    </div>

    <!-- Patient Info Card -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
        <h3 class="text-sm font-semibold text-blue-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Informasi Pasien
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Nama Pasien</p>
                <p class="font-semibold text-gray-900">{{ $appointment->user->name }}</p>
            </div>
            <div class="bg-white rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Nomor Antrian</p>
                <p class="font-semibold text-gray-900">#{{ $appointment->queue_number }}</p>
            </div>
            <div class="bg-white rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Tanggal Konsultasi</p>
                <p class="font-semibold text-gray-900">{{ $appointment->appointment_date->format('d F Y') }}</p>
            </div>
            <div class="bg-white rounded-lg p-4">
                <p class="text-xs text-gray-500 mb-1">Waktu</p>
                <p class="font-semibold text-gray-900">{{ $appointment->appointment_time->format('H:i') }} WIB</p>
            </div>
        </div>
        <div class="mt-4 bg-white rounded-lg p-4">
            <p class="text-xs text-gray-500 mb-2">Keluhan</p>
            <p class="text-sm text-gray-700">{{ $appointment->complaint }}</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Form Hasil Konsultasi
            </h3>
        </div>
        <div class="p-8">
            <form method="POST" action="{{ route('doctor.appointments.update', $appointment) }}">
                @csrf
                @method('PUT')

                <!-- Diagnosis -->
                <div class="mb-6">
                    <label for="diagnosis" class="block text-sm font-semibold text-gray-700 mb-2">
                        Diagnosis
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <textarea name="diagnosis" 
                                  id="diagnosis" 
                                  rows="6" 
                                  required
                                  class="pl-12 pt-3 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('diagnosis') border-red-300 @enderror"
                                  placeholder="Contoh: Pasien mengalami demam tinggi dengan indikasi infeksi saluran pernapasan atas (ISPA). Disarankan untuk istirahat yang cukup...">{{ old('diagnosis', $appointment->diagnosis) }}</textarea>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Tuliskan diagnosis lengkap berdasarkan pemeriksaan dan keluhan pasien</p>
                    @error('diagnosis')
                        <div class="mt-2 flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <!-- Resep Obat -->
                <div class="mb-8">
                    <label for="prescription" class="block text-sm font-semibold text-gray-700 mb-2">
                        Resep Obat
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <textarea name="prescription" 
                                  id="prescription" 
                                  rows="6" 
                                  required
                                  class="pl-12 pt-3 block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('prescription') border-red-300 @enderror"
                                  placeholder="Contoh:&#10;1. Paracetamol 500mg - 3x sehari sesudah makan&#10;2. Amoxicillin 500mg - 3x sehari sesudah makan&#10;3. Vitamin C 500mg - 1x sehari">{{ old('prescription', $appointment->prescription) }}</textarea>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Tuliskan nama obat, dosis, dan aturan pakai secara lengkap</p>
                    @error('prescription')
                        <div class="mt-2 flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <input type="hidden" name="status" value="completed">

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('doctor.appointments.show', $appointment) }}" 
                       class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan & Selesaikan Konsultasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h3 class="text-sm font-semibold text-blue-900 mb-1">Penting!</h3>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• Pastikan diagnosis dan resep sudah benar sebelum menyimpan</li>
                    <li>• Setelah disimpan, status janji temu akan otomatis berubah menjadi "Selesai"</li>
                    <li>• Pasien dapat melihat diagnosis dan resep yang Anda berikan</li>
                    <li>• Anda masih dapat mengedit diagnosis dan resep setelah disimpan</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection