<x-app-layout>
    @hasrole('owner')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Transaksi Seluruh Cabang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-inherit ">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ __('Transaksi Harian') }}
                    </div>
                </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                
                    <x-table>
                            <x-slot name="header">
                                <tr class="py-10">  
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Cabang</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </x-slot>
                               @foreach($transaksiHarian as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->cabang->nama }}</td>
                                    <td>{{ $transaksi->produk->nama }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                    <td>{{ $transaksi->total_harga }}</td>
                                    <td>{{ $transaksi->created_at }}</td>
                                 </tr>
                                @endforeach
                                
                        </x-table>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-inherit ">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ __('Transaksi Bulanan') }}
                    </div>
                </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-table>
                            <x-slot name="header">
                                <tr class="py-10">  
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Cabang</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </x-slot>
                               @foreach($transaksiBulanan as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->cabang->nama }}</td>
                                    <td>{{ $transaksi->produk->nama }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                    <td>{{ $transaksi->total_harga }}</td>
                                    <td>{{ $transaksi->created_at }}</td>
                                 </tr>
                                @endforeach
                                
                        </x-table>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-inherit ">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ __('Transaksi Tahunan') }}
                    </div>
                </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-table>
                            <x-slot name="header">
                                <tr class="py-10">  
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Cabang</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </x-slot>
                               @foreach($transaksiTahunan as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->id }}</td>
                                    <td>{{ $transaksi->cabang->nama }}</td>
                                    <td>{{ $transaksi->produk->nama }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                    <td>{{ $transaksi->total_harga }}</td>
                                    <td>{{ $transaksi->created_at }}</td>
                                 </tr>
                                @endforeach
                                
                        </x-table>
                </div>
            </div>
        </div>
    </div>
    @endhasrole
</x-app-layout>
