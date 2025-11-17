@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 mb-4 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Janji Temu
            </a>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0 p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-3xl font-bold text-gray-900">Detail Janji Temu</h1>
                        <p class="text-sm text-gray-600 mt-1">Informasi lengkap janji temu pasien</p>
                    </div>
                </div>
                
                <!-- Status Badge -->
                <div>
                    @if($appointment->status === 'pending')
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-yellow-100 text-yellow-800 shadow-sm">
                            <span class="w-2.5 h-2.5 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                            Menunggu
                        </span>
                    @elseif($appointment->status === 'confirmed')
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-blue-100 text-blue-800 shadow-sm">
                            <span class="w-2.5 h-2.5 bg-blue-500 rounded-full mr-2"></span>
                            Dikonfirmasi
                        </span>
                    @elseif($appointment->status === 'completed')
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-green-100 text-green-800 shadow-sm">
                            <span class="w-2.5 h-2.5 bg-green-500 rounded-full mr-2"></span>
                            Selesai
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold bg-red-100 text-red-800 shadow-sm">
                            <span class="w-2.5 h-2.5 bg-red-500 rounded-full mr-2"></span>
                            Dibatalkan
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informasi Janji Temu -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Informasi Janji Temu
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <dt class="text-xs font-medium text-gray-500 uppercase">Nomor Antrian</dt>
                                    <dd class="mt-1 text-2xl font-bold text-gray-900">#{{ $appointment->queue_number }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <dt class="text-xs font-medium text-gray-500 uppercase">Tanggal</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $appointment->appointment_date->format('d F Y') }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <dt class="text-xs font-medium text-gray-500 uppercase">Waktu</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $appointment->appointment_time->format('H:i') }} WIB</dd>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Keluhan -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-orange-50 to-red-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Keluhan Pasien
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-700 leading-relaxed">{{ $appointment->complaint }}</p>
                    </div>
                </div>

                <!-- Hasil Konsultasi -->
                @if($appointment->diagnosis || $appointment->prescription)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Hasil Konsultasi
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <h4 class="ml-2 text-sm font-semibold text-gray-700">Diagnosis</h4>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed pl-10">{{ $appointment->diagnosis ?? '-' }}</p>
                            </div>
                            <div>
                                <div class="flex items-center mb-3">
                                    <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                    </div>
                                    <h4 class="ml-2 text-sm font-semibold text-gray-700">Resep</h4>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed pl-10">{{ $appointment->prescription ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Informasi Pasien -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Informasi Pasien
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-16 w-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-2xl">{{ strtoupper(substr($appointment->user->name, 0, 2)) }}</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">{{ $appointment->user->name }}</h4>
                                <p class="text-sm text-gray-500">Pasien</p>
                            </div>
                        </div>
                        <dl class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-gray-100 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <dt class="text-xs font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900 break-all">{{ $appointment->user->email }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-gray-100 rounded-lg">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <dt class="text-xs font-medium text-gray-500">Telepon</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $appointment->user->phone ?? '-' }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Informasi Dokter -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-cyan-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi Dokter
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-16 w-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-2xl">{{ strtoupper(substr($appointment->doctor->user->name, 0, 2)) }}</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">{{ $appointment->doctor->user->name }}</h4>
                                <p class="text-sm text-gray-500">Dokter Spesialis</p>
                            </div>
                        </div>
                        <dl class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-indigo-100 rounded-lg">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <dt class="text-xs font-medium text-gray-500">Spesialisasi</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $appointment->doctor->specialization->name }}</dd>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <dt class="text-xs font-medium text-gray-500">Biaya Konsultasi</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900">Rp {{ number_format($appointment->doctor->consultation_fee, 0, ',', '.') }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mt-8 flex items-center justify-end">
            <a href="{{ route('admin.appointments.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection