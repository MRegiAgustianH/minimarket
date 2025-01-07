<x-app-layout>
    @hasrole('supervisor')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Data Stok di ') }} {{ Auth::user()->cabang->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form action="{{ route('cabang.stok.export') }}" method="GET">
                        <div class="mb-4">
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Pilih Tanggal Stok</label>
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
                                <th scope="col">Nama Cabang</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                
                            </tr>
                        </x-slot>
                        @foreach ($cabangStoks as $cabang)
                            <tr>
                                <td>{{ $cabang->id }}</td>
                                <td>{{ $cabang->cabang->nama }}</td>
                                <td>{{ $cabang->produk->nama }}</td>
                                <td>{{ $cabang->jumlah }}</td>
                        
                            </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>
        </div>
    </div>
    @endhasrole
    @hasrole('manager')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stok di Semua Cabang Minimarket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <x-primary-button tag="a" href="{{ route('gudang.create') }}">
                                    Ajukan Pengadaan Stok
                                </x-primary-button>
                <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">ID</th>
                                <th scope="col">Nama Cabang</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                            </tr>
                        </x-slot>
                        @foreach ($cabangStoks as $cabang)
                            <tr>
                                <td>{{ $cabang->id }}</td>
                                <td>{{ $cabang->cabang->nama }}</td>
                                <td>{{ $cabang->produk->nama }}</td>
                                <td>{{ $cabang->jumlah }}</td>
                            </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>
        </div>
    </div>
    @endhasrole
</x-app-layout>