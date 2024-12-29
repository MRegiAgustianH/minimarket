<x-app-layout>
@hasrole('pegawai')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengadaan Stok') }}
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
                                <th scope="col">Cabang</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Tanggal Pengadaan</th>
                                <th scope="col">Status</th> 
                            </tr>
                        </x-slot>
                        @foreach($pengadaanStoks as $pengadaan)
                        <tr>
                            <td>{{ $pengadaan->id }}</td>
                            <td>{{ $pengadaan->cabang->nama }}</td>
                            <td>{{ $pengadaan->produk->nama }}</td>
                            <td>{{ $pengadaan->jumlah }}</td>
                            <td>{{ $pengadaan->tanggal_pengadaan }}</td>
                            <td>{{ $pengadaan->status ?? 'pending' }}</td>
                            <td>
                                @if(empty($pengadaan->status) || $pengadaan->status == 'pending')
                                    <form action="{{ route('gudang.approve', $pengadaan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>
                                @endif
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