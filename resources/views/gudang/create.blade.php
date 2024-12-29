<x-app-layout>
    @hasrole('manager')
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pengajuan Pengadaan Stok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- {{ __("Pengadaan Stok") }} -->
                    <div class="container">
                        <form action="{{ route('gudang.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="cabang_id">Cabang</label>
                                <select name="cabang_id" id="cabang_id" class="form-control mt-1 block w-full rounded" required>
                                    @foreach($cabangs as $cabang)
                                        <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="produk_id">Produk</label>
                                <select name="produk_id" id="produk_id" class="form-control mt-1 block w-full rounded" required>
                                    @foreach($produks as $produk)
                                        <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control mt-1 block w-full rounded" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="tanggal_pengadaan">Tanggal Pengadaan</label>
                                <input type="date" name="tanggal_pengadaan" id="tanggal_pengadaan" class="form-control mt-1 block w-full rounded" required>
                            </div>
                            <x-primary-button  class="btn btn-primary">Ajukan Pengadaan</x-primary-button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endhasrole
</x-app-layout>