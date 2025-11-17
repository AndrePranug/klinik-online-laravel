@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg border border-gray-100">
            <div>
                <h2 class="font-bold text-3xl text-gray-800 mb-2 flex items-center gap-3">
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text">
                        {{ __('Manajemen Dokter') }}
                    </span>
                    <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">
                        {{ $doctors->count() }} Dokter
                    </span>
                </h2>
                <p class="text-gray-600">Kelola data dokter dan spesialisasi dengan mudah</p>
            </div>
            <a href="{{ route('admin.doctors.create') }}" 
               class="group relative bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Dokter
            </a>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="mb-6 animate-fade-in" style="animation-delay: 0.1s">
        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-2xl shadow-lg border border-gray-100">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <input type="text" 
                           id="searchInput" 
                           placeholder="Cari dokter berdasarkan nama, spesialisasi, atau lisensi..." 
                           class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <select id="filterSpecialization" class="px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    <option value="">Semua Spesialisasi</option>
                    @foreach($doctors->pluck('specialization.name')->unique() as $spec)
                        <option value="{{ $spec }}">{{ $spec }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="doctorGrid">
        @forelse($doctors as $index => $doctor)
        <div class="doctor-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 overflow-hidden border border-gray-100 animate-fade-in" 
             style="animation-delay: {{ $index * 0.1 }}s"
             data-name="{{ strtolower($doctor->user->name) }}"
             data-specialization="{{ strtolower($doctor->specialization->name) }}"
             data-license="{{ strtolower($doctor->license_number) }}">
            
            <!-- Card Header with Gradient -->
            <div class="h-32 bg-gradient-to-br from-blue-500 to-purple-600 relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/20 rounded-full"></div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/20 rounded-full"></div>
            </div>

            <!-- Doctor Photo -->
            <div class="relative px-6 -mt-16 mb-4">
                <div class="inline-block">
                    @if($doctor->photo)
                        <img class="h-24 w-24 rounded-2xl object-cover border-4 border-white shadow-xl ring-4 ring-blue-100" 
                             src="{{ Storage::url($doctor->photo) }}" 
                             alt="{{ $doctor->user->name }}">
                    @else
                        <div class="h-24 w-24 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center border-4 border-white shadow-xl ring-4 ring-blue-100">
                            <span class="text-white font-bold text-3xl">{{ substr($doctor->user->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <div class="absolute -bottom-2 -right-2 bg-green-500 h-6 w-6 rounded-full border-4 border-white"></div>
                </div>
            </div>

            <!-- Card Content -->
            <div class="px-6 pb-6">
                <h3 class="font-bold text-xl text-gray-800 mb-1">{{ $doctor->user->name }}</h3>
                <p class="text-gray-500 text-sm mb-4 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    {{ $doctor->user->email }}
                </p>

                <!-- Info Grid -->
                <div class="space-y-3 mb-6">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-xl">
                        <span class="text-gray-600 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Spesialisasi
                        </span>
                        <span class="font-semibold text-blue-700 text-sm">{{ $doctor->specialization->name }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-xl">
                        <span class="text-gray-600 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                            Lisensi
                        </span>
                        <span class="font-semibold text-purple-700 text-sm">{{ $doctor->license_number }}</span>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                        <span class="text-gray-600 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pengalaman
                        </span>
                        <span class="font-semibold text-green-700 text-sm">{{ $doctor->experience_years }} tahun</span>
                    </div>

                    <div class="p-4 bg-gradient-to-r from-orange-50 to-red-50 rounded-xl border border-orange-200">
                        <div class="text-gray-600 text-xs mb-1">Biaya Konsultasi</div>
                        <div class="font-bold text-2xl text-orange-600">
                            Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <a href="{{ route('admin.doctors.edit', $doctor) }}" 
                       class="flex-1 text-center bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-semibold py-3 px-4 rounded-xl shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <button onclick="confirmDelete('{{ $doctor->user->name }}', '{{ route('admin.doctors.destroy', $doctor) }}')" 
                            class="bg-red-500 hover:bg-red-600 text-white font-semibold p-3 rounded-xl shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada dokter</h3>
                <p class="text-gray-600 mb-6">Mulai tambahkan dokter untuk mengelola data mereka</p>
                <a href="{{ route('admin.doctors.create') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Dokter Pertama
                </a>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Empty State for Search -->
    <div id="emptyState" class="hidden col-span-full">
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100 mt-6">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada hasil</h3>
            <p class="text-gray-600">Coba gunakan kata kunci yang berbeda</p>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-fade-in">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 transform scale-95 animate-scale-in">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Konfirmasi Hapus</h3>
        <p class="text-gray-600 text-center mb-6">Apakah Anda yakin ingin menghapus dokter <span id="doctorName" class="font-semibold text-gray-800"></span>?</p>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" 
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scale-in {
    from {
        transform: scale(0.9);
    }
    to {
        transform: scale(1);
    }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out forwards;
}

.animate-scale-in {
    animation: scale-in 0.3s ease-out forwards;
}
</style>

<script>
// Search functionality
const searchInput = document.getElementById('searchInput');
const filterSpecialization = document.getElementById('filterSpecialization');
const doctorCards = document.querySelectorAll('.doctor-card');
const doctorGrid = document.getElementById('doctorGrid');
const emptyState = document.getElementById('emptyState');

function filterDoctors() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedSpec = filterSpecialization.value.toLowerCase();
    let visibleCount = 0;

    doctorCards.forEach(card => {
        const name = card.dataset.name;
        const specialization = card.dataset.specialization;
        const license = card.dataset.license;

        const matchesSearch = name.includes(searchTerm) || 
                            specialization.includes(searchTerm) || 
                            license.includes(searchTerm);
        const matchesSpec = !selectedSpec || specialization.includes(selectedSpec);

        if (matchesSearch && matchesSpec) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Show/hide empty state
    if (visibleCount === 0 && doctorCards.length > 0) {
        emptyState.classList.remove('hidden');
    } else {
        emptyState.classList.add('hidden');
    }
}

searchInput.addEventListener('input', filterDoctors);
filterSpecialization.addEventListener('change', filterDoctors);

// Delete confirmation modal
function confirmDelete(doctorName, actionUrl) {
    document.getElementById('doctorName').textContent = doctorName;
    document.getElementById('deleteForm').action = actionUrl;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Close modal on outside click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});
</script>
@endsection