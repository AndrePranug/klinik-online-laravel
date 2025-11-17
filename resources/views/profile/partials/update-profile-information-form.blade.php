<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input id="name" 
                       name="name" 
                       type="text" 
                       value="{{ old('name', $user->name) }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input id="email" 
                       name="email" 
                       type="email" 
                       value="{{ old('email', $user->email) }}" 
                       required 
                       autocomplete="username"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800">
                            Email Anda belum diverifikasi.
                            <button form="send-verification" class="underline text-sm text-blue-600 hover:text-blue-700">
                                Klik di sini untuk verifikasi ulang.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-green-600">
                                Link verifikasi baru telah dikirim ke email Anda.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">
                    Nomor Telepon
                </label>
                <input id="phone" 
                       name="phone" 
                       type="text" 
                       value="{{ old('phone', $user->phone) }}" 
                       autocomplete="tel"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                       placeholder="08123456789">
                @error('phone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Birth -->
            <div>
                <label for="date_of_birth" class="block text-sm font-bold text-gray-700 mb-2">
                    Tanggal Lahir
                </label>
                <input id="date_of_birth" 
                       name="date_of_birth" 
                       type="date" 
                       value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}" 
                       max="{{ date('Y-m-d') }}"
                       autocomplete="bday"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('date_of_birth')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-sm font-bold text-gray-700 mb-2">
                    Jenis Kelamin
                </label>
                <select id="gender" 
                        name="gender"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label for="address" class="block text-sm font-bold text-gray-700 mb-2">
                    Alamat Lengkap
                </label>
                <textarea id="address" 
                          name="address" 
                          rows="3"
                          autocomplete="street-address"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                          placeholder="Jl. Contoh No. 123, Kota, Provinsi">{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
            <button type="submit" 
                    class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-blue-600 hover:to-indigo-700 transition transform hover:scale-105 shadow-md">
                💾 Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600 font-semibold">
                    ✓ Tersimpan!
                </p>
            @endif
        </div>
    </form>
</section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>