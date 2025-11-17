<section class="space-y-6">
    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
        <div class="flex">
            <svg class="h-5 w-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <div class="text-sm text-red-700">
                <p class="font-semibold mb-1">Perhatian!</p>
                <p>Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
            </p>
        </div>
    </div>

    <button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            type="button"
            class="bg-red-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-red-600 transition shadow-md">
        🗑️ Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-gray-900 mb-4">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="text-sm text-gray-600 mb-6">
                Setelah akun Anda dihapus, semua data dan informasi akan dihapus secara permanen. Masukkan password Anda untuk konfirmasi penghapusan akun.
            </p>

            <div class="mb-6">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                    Password
                </label>
                <input id="password"
                       name="password"
                       type="password"
                       placeholder="••••••••"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                @error('password', 'userDeletion')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-3 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>