<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Pengaturan Profile 👤
            </h2>
            <p class="text-sm text-gray-600 mt-1">Kelola informasi akun dan keamanan Anda</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Sidebar Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24" data-aos="fade-right">
                        <div class="text-center">
                            <div class="relative inline-block">
                                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4 shadow-xl">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="absolute bottom-2 right-2 bg-green-500 w-6 h-6 rounded-full border-4 border-white"></div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-gray-600 mb-1">{{ Auth::user()->email }}</p>
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                                   (Auth::user()->role === 'doctor' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>

                        <div class="mt-6 space-y-3 text-sm">
                            @if(Auth::user()->phone)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ Auth::user()->phone }}
                            </div>
                            @endif

                            @if(Auth::user()->date_of_birth)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ Auth::user()->date_of_birth->format('d F Y') }}
                            </div>
                            @endif

                            @if(Auth::user()->gender)
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ Auth::user()->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </div>
                            @endif

                            @if(Auth::user()->address)
                            <div class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="flex-1">{{ Auth::user()->address }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-xs text-gray-500 text-center">
                                Member sejak {{ Auth::user()->created_at->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Update Profile Information -->
                    <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-left">
                        <div class="flex items-center mb-6">
                            <div class="bg-blue-100 rounded-lg p-3 mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Informasi Profile</h3>
                                <p class="text-sm text-gray-600">Update informasi akun dan data pribadi Anda</p>
                            </div>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-left" data-aos-delay="100">
                        <div class="flex items-center mb-6">
                            <div class="bg-green-100 rounded-lg p-3 mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Update Password</h3>
                                <p class="text-sm text-gray-600">Pastikan akun Anda menggunakan password yang aman</p>
                            </div>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-red-200" data-aos="fade-left" data-aos-delay="200">
                        <div class="flex items-center mb-6">
                            <div class="bg-red-100 rounded-lg p-3 mr-4">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Hapus Akun</h3>
                                <p class="text-sm text-gray-600">Hapus akun Anda secara permanen</p>
                            </div>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
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