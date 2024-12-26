<!-- resources/views/cabang/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Cabang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('cabang.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700">Nama Cabang</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="block text-gray-700">Alamat Cabang</label>
                            <input type="text" name="alamat" id="alamat" class="mt-1 block w-full rounded" required>
                        </div>

                        <div>
                            <x-primary-button class=" text-white px-4 py-2 rounded">Tambah Cabang</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>