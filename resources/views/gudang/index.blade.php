<x-app-layout>
@hasrole('pegawai')
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
                                <th scope="col">Cabang ID</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">jumlah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @foreach ($cabangStoks as $cabangs)
                        <tr>
                            <td>{{$cabangs->cabang_id}}</td>
                            <td>{{$cabangs->produk->nama}}</td>
                            <td>{{$cabangs->jumlah}}</td>
                        </tr>
                        @endforeach
                    </x-table>

                </div>
            </div>
        </div>
    </div>
    @endhasrole
</x-app-layout>