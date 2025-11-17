@extends('layouts.doctor')

@section('title', 'Detail Janji Temu')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <a href="{{ route('doctor.appointments.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 mb-4 transition-colors">
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
                    <h1 class="text-2xl font-bold text-gray-900">Detail Janji Temu</h1>
                    <p class="text-sm text-gray-600 mt-1">Informasi lengkap konsultasi pasien</p>
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
        <!-- Left Column - 2/3 width -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Janji Temu -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
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
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-orange-50 to-red-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Keluhan Pasien
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-lg">{{ $appointment->complaint }}</p>
                </div>
            </div>

            <!-- Hasil Konsultasi -->
            @if($appointment->diagnosis || $appointment->prescription)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Hasil Konsultasi
                        </h3>
                        @if($appointment->status === 'completed')
                        <a href="{{ route('doctor.appointments.edit', $appointment) }}" 
                           class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        @endif
                    </div>
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
                            <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-lg">{{ $appointment->diagnosis ?? '-' }}</p>
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
                            <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-lg">{{ $appointment->prescription ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column - 1/3 width -->
        <div class="space-y-6">
            <!-- Informasi Pasien -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
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
                        @if($appointment->user->date_of_birth)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 p-2 bg-gray-100 rounded-lg">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <dt class="text-xs font-medium text-gray-500">Tanggal Lahir</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $appointment->user->date_of_birth->format('d F Y') }}</dd>
                            </div>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Update Status Actions -->
            @if($appointment->status !== 'completed' && $appointment->status !== 'cancelled')
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update Status
                    </h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('doctor.appointments.update-status', $appointment) }}" class="space-y-3">
                        @csrf
                        @method('PATCH')
                        
                        @if($appointment->status === 'pending')
                            <button type="submit" name="status" value="confirmed" 
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-sm transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Konfirmasi Janji Temu
                            </button>
                        @endif
                        
                        @if($appointment->status === 'confirmed')
                            <a href="{{ route('doctor.appointments.edit', $appointment) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl shadow-sm transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Selesaikan Konsultasi
                            </a>
                        @endif
                        
                        <button type="submit" name="status" value="cancelled" 
                                onclick="return confirm('Yakin ingin membatalkan janji temu ini?')"
                                class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-100 hover:bg-red-200 text-red-700 font-semibold rounded-xl transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batalkan Janji Temu
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex items-center justify-end">
        <a href="{{ route('doctor.appointments.index') }}" 
           class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>
</div>
@endsection