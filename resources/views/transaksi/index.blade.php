<x-app-layout>
    @hasrole('manager')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Transaksi Cabang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Laporan") }}
                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">ID</th>
                                <th scope="col">Nama Cabang</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Tanggal Transaksi</th>

                            </tr>
                        </x-slot>
                        @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{$transaksi->id}}</td>
                            <td>{{$transaksi->cabang->nama}}</td>
                            <td>{{$transaksi->produk->nama}}</td>
                            <td>{{$transaksi->total_harga}}</td>
                            <td>{{$transaksi->created_at}}</td>
                        </tr>
                        @endforeach
                    </x-table>

                </div>
            </div>
        </div>
    </div>
    @endhasrole

    @hasrole('supervisor')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Pembelian") }}
                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">ID</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{$transaksi->id}}</td>
                            <td>{{$transaksi->produk->nama}}</td>
                            <td>{{$transaksi->jumlah}}</td>
                            <td>{{$transaksi->total_harga}}</td>
                        </tr>
                        @endforeach
                    </x-table>

                </div>
            </div>
        </div>
    </div>
    @endhasrole

    @hasrole('kasir')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Pembelian") }}
                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">ID</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                
                            </tr>
                        </x-slot>
                        @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{$transaksi->id}}</td>
                            <td>{{$transaksi->produk->nama}}</td>
                            <td>{{$transaksi->jumlah}}</td>
                            <td>{{$transaksi->total_harga}}</td>
                        </tr>
                        @endforeach
                    </x-table>

                </div>
            </div>
        </div>
    </div>
    @endhasrole

    
</x-app-layout>