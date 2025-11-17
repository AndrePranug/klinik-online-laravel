@extends('layouts.doctor')

@section('title', 'Daftar Janji Temu')

@section('content')
<div x-data="{ openFilter: false }" class="space-y-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Daftar Janji Temu
            </h2>
            <p class="text-sm text-gray-500 mt-1">Kelola daftar janji temu pasien Anda dengan mudah.</p>
        </div>

        <button 
            @click="openFilter = !openFilter"
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 018 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
            </svg>
            Filter
        </button>
    </div>

    <!-- Filter Section -->
    <div 
        x-show="openFilter"
        x-transition
        class="bg-white rounded-xl shadow-md p-6 border border-gray-100"
        style="display: none;"
    >
        <form method="GET" action="{{ route('doctor.appointments.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="date" id="date" value="{{ request('date') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow transition duration-200">
                    Terapkan
                </button>
                <a href="{{ route('doctor.appointments.index') }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <div class="p-4 flex justify-between items-center">
            <h3 class="font-semibold text-gray-800">Janji Temu Hari Ini</h3>
            <input 
                type="text" 
                placeholder="Cari pasien..." 
                class="w-64 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                x-data
                @input.debounce.300ms="window.searchTerm = $event.target.value"
            >
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">No. Antrian</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Pasien</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $appointment->queue_number }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $appointment->user->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $appointment->appointment_date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $appointment->appointment_time->format('H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $colors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'confirmed' => 'bg-blue-100 text-blue-700',
                                    'completed' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $colors[$appointment->status] ?? 'bg-gray-100 text-gray-600' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('doctor.appointments.show', $appointment) }}" class="inline-flex items-center text-blue-600 hover:text-blue-900 font-medium transition duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-gray-500">Tidak ada janji temu ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection
