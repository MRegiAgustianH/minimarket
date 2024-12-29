<x-app-layout>
@if(auth()->user()->hasRole('kasir'))
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Minimarket Pak Jayusman') }}{{' '}}{{$cabangStoks->first()->cabang->nama}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("List Produk") }}
                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">ID</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($cabangStoks as $cabangs)
                        <tr>
                            <td>{{$cabangs->produk->id}}</td>
                            <td>{{$cabangs->produk->nama}}</td>
                            <td>{{$cabangs->produk->harga }}</td>
                            <td>
                                <form action="{{ route('transaksi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cabang_id" value="{{ $cabangs->cabang->id }}">
                                    <input type="hidden" name="produk_id" value="{{ $cabangs->produk->id }}">
                                    <input type="number" name="jumlah" value="1" min="1" required>
                                    <x-primary-button type="submit" class="btn btn-primary">Tambah</x-primary-button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@else
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                {{ "Selamat datang di Minimarket, " . auth()->user()->name . "!" }}
                </div>
            </div>
        </div>
    </div>
@endif
</x-app-layout>
