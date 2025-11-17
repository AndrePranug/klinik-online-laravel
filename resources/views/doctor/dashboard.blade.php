@extends('layouts.doctor')

@section('title', 'Dashboard')

@section('content')
    
        <h2 name="header" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Dokter') }}
        </h2>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Janji Temu Hari Ini</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $stats['today_appointments'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Menunggu Konfirmasi</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $stats['pending_appointments'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Selesai</p>
                                <p class="text-2xl font-semibold text-gray-700">{{ $stats['completed_appointments'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Today's Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Hari Ini</h3>
                        <div class="space-y-4">
                            @forelse($today_appointments as $appointment)
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $appointment->user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $appointment->appointment_time->format('H:i') }} WIB</p>
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($appointment->complaint, 50) }}</p>
                                    </div>
                                    <div>
                                        @if($appointment->status === 'pending')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu
                                            </span>
                                        @elseif($appointment->status === 'confirmed')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Dikonfirmasi
                                            </span>
                                        @elseif($appointment->status === 'completed')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Selesai
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('doctor.appointments.show', $appointment) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                            @empty
                            <p class="text-sm text-gray-500 text-center py-4">Tidak ada jadwal hari ini</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Jadwal Mendatang</h3>
                        <div class="space-y-4">
                            @forelse($upcoming_appointments as $appointment)
                            <div class="border-l-4 border-green-500 pl-4 py-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $appointment->user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $appointment->appointment_date->format('d M Y') }} - {{ $appointment->appointment_time->format('H:i') }} WIB</p>
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($appointment->complaint, 50) }}</p>
                                    </div>
                                    <div>
                                        @if($appointment->status === 'pending')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu
                                            </span>
                                        @elseif($appointment->status === 'confirmed')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Dikonfirmasi
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('doctor.appointments.show', $appointment) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                            @empty
                            <p class="text-sm text-gray-500 text-center py-4">Tidak ada jadwal mendatang</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection