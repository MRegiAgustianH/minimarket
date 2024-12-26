<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.create') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-gray-700">Role</label>
                            <select name="role" id="role" class="mt-1 block w-full rounded" required>
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-4" id="cabangSelect" style="display: none;">
                            <label for="cabang_id">Cabang</label>
                            <select class="form-control mt-1 block w-full rounded" id="cabang_id" name="cabang_id" >
                                <option value="">Pilih Cabang</option>
                                @foreach($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-primary-button class=" text-white px-4 py-2 rounded">Tambah User</x-primary-button>
                        </div>
                    </form>
                    <div x-data="{ showAlert: @json($errors->has('cabang_id')) }">
                        <template x-if="showAlert">
                            <div x-show="showAlert" class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Cabang ini sudah memiliki ') }}{{$role->name}}
                                    </h2>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button @click="showAlert = false">
                                            {{ __('Tutup') }}
                                        </x-secondary-button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>