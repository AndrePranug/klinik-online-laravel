@extends('layouts.doctor')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl shadow-lg overflow-hidden">
        <div class="px-8 py-6 sm:p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">
                        Selamat Datang, Dr. {{ auth()->user()->name }}! 👨‍⚕️
                    </h1>
                    <p class="text-green-100 text-sm sm:text-base">
                        Berikut adalah ringkasan aktivitas praktik Anda hari ini
                    </p>
                </div>
                <div class="hidden sm:block">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2">
                        <p class="text-white text-sm font-medium">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <!-- Janji Temu Hari Ini -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200 overflow-hidden group">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['today_appointments'] }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Janji Temu Hari Ini</p>
                    <div class="flex items-center text-xs text-blue-600 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Hari ini</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu Konfirmasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200 overflow-hidden group">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0 p-3 bg-yellow-100 rounded-lg group-hover:bg-yellow-200 transition-colors">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_appointments'] }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Menunggu Konfirmasi</p>
                    <div class="flex items-center text-xs text-yellow-600 font-medium">
                        <span class="flex h-2 w-2 mr-2">
                            <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-yellow-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-500"></span>
                        </span>
                        <span>Perlu tindakan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-200 overflow-hidden group">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['completed_appointments'] }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Konsultasi Selesai</p>
                    <div class="flex items-center text-xs text-green-600 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Total bulan ini</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Appointments Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Today's Appointments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Jadwal Hari Ini
                    </h3>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                        {{ $today_appointments->count() }} Pasien
                    </span>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($today_appointments as $appointment)
                    <div class="border-l-4 border-blue-500 bg-blue-50/50 rounded-r-lg pl-4 pr-4 py-3 hover:bg-blue-50 transition-colors">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr($appointment->user->name, 0, 2)) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold text-gray-900">{{ $appointment->user->name }}</p>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $appointment->appointment_time->format('H:i') }} WIB
                                    </div>
                                </div>
                            </div>
                            <div>
                                @if($appointment->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                        Menunggu
                                    </span>
                                @elseif($appointment->status === 'confirmed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                        Dikonfirmasi
                                    </span>
                                @elseif($appointment->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                        Selesai
                                    </span>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            <span class="font-medium text-gray-700">Keluhan:</span> {{ $appointment->complaint }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-gray-500">#{{ $appointment->queue_number }}</span>
                            <a href="{{ route('doctor.appointments.show', $appointment) }}" 
                               class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">Tidak ada jadwal hari ini</p>
                        <p class="text-xs text-gray-400 mt-1">Anda tidak memiliki janji temu untuk hari ini</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Jadwal Mendatang
                    </h3>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                        {{ $upcoming_appointments->count() }} Pasien
                    </span>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($upcoming_appointments as $appointment)
                    <div class="border-l-4 border-green-500 bg-green-50/50 rounded-r-lg pl-4 pr-4 py-3 hover:bg-green-50 transition-colors">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr($appointment->user->name, 0, 2)) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="font-semibold text-gray-900">{{ $appointment->user->name }}</p>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $appointment->appointment_date->format('d M Y') }} - {{ $appointment->appointment_time->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                @if($appointment->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                        Menunggu
                                    </span>
                                @elseif($appointment->status === 'confirmed')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full mr-1.5"></span>
                                        Dikonfirmasi
                                    </span>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            <span class="font-medium text-gray-700">Keluhan:</span> {{ $appointment->complaint }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-gray-500">#{{ $appointment->queue_number }}</span>
                            <a href="{{ route('doctor.appointments.show', $appointment) }}" 
                               class="inline-flex items-center text-sm text-green-600 hover:text-green-800 font-medium">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500 font-medium">Tidak ada jadwal mendatang</p>
                        <p class="text-xs text-gray-400 mt-1">Belum ada janji temu yang dijadwalkan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
        <h3 class="text-sm font-semibold text-blue-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Aksi Cepat
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('doctor.appointments.index') }}" 
               class="flex items-center p-4 bg-white rounded-lg hover:shadow-md transition-all group">
                <div class="flex-shrink-0 p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-gray-900">Semua Janji Temu</p>
                    <p class="text-xs text-gray-500">Lihat semua jadwal</p>
                </div>
            </a>

            <a href="{{ route('doctor.schedules.index') }}" 
               class="flex items-center p-4 bg-white rounded-lg hover:shadow-md transition-all group">
                <div class="flex-shrink-0 p-2 bg-green-100 rounded-lg group-hover:bg-green-200 transition-colors">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-gray-900">Jadwal Praktik</p>
                    <p class="text-xs text-gray-500">Kelola jadwal Anda</p>
                </div>
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="flex items-center p-4 bg-white rounded-lg hover:shadow-md transition-all group">
                <div class="flex-shrink-0 p-2 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-gray-900">Profil Saya</p>
                    <p class="text-xs text-gray-500">Edit informasi profil</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection