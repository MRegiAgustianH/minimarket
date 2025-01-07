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
        {{ __('Data Transaksi di ') }} {{ Auth::user()->cabang->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('transaksi.export') }}" method="GET">
                        <div class="mb-4">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Pilih Tanggal Transaksi</label>
                            <select name="tanggal" id="tanggal" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($uniqueDates as $date)
                                    <option value="{{ $date }}">{{ $date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-primary-button type="submit">DOWNLOAD EXCEL</x-primary-button>
                    </form>
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
                                <th scope="col">Aksi</th>
                                
                            </tr>
                        </x-slot>
                        @foreach ($transaksis as $transaksi)
                        <tr>
                            <td>{{$transaksi->id}}</td>
                            <td>{{$transaksi->produk->nama}}</td>
                            <td>{{$transaksi->jumlah}}</td>
                            <td>{{$transaksi->total_harga}}</td>
                            <td>
                                <x-primary-button tag="a" href="{{ route('transaksi.struk', $transaksi->id) }}">Cetak Struk</x-primary-button>
                            </td>
                        </tr>
                        @endforeach
                    </x-table>

                </div>
            </div>
        </div>
    </div>
    @endhasrole

    
</x-app-layout>