<x-app-layout>
    @hasrole('owner')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Stok Seluruh Cabang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Laporan") }}
                    <x-table>
                        <x-slot name="header">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok Tersedia</th>
                                <th scope="col">Stok Minimal</th>
                                <th scope="col">Cabang</th>
                            </tr>
                        </x-slot>
                        @foreach ($stokHarian as $stok)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stok->produk->nama }}</td>
                                <td>{{ $stok->produk->deskripsi }}</td>
                                <td>{{ number_format($stok->produk->harga, 2) }}</td>
                                <td>{{ $stok->jumlah }}</td>
                                <td>{{ $stok->produk->stok_minimal }}</td>
                                <td>{{ $stok->cabang->nama }}</td>
                            </tr>
                        @endforeach
                    </x-table>
                                        
                </div>
            </div>
        </div>
    </div>
    @endhasrole
</x-app-layout>
