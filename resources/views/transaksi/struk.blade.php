<x-app-layout>
    @hasrole('kasir')
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Struk Pembelian') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-wrap p-6 text-gray-900 justify-center">
                        <div class="flex flex-wrap justify-center w-1/2 bg-gray-200 rounded">
                            <h1 class="flex w-2/3 justify-center font-bold mt-4">STRUK PEMBELIAN</h1>
                            <p>==============================================</p>
                            <p class="w-2/3"><strong>ID Transaksi:</strong> {{ $transaksi->id }}</p>
                            <p class="w-2/3"><strong>Nama Produk:</strong> {{ $transaksi->produk->nama }}</p>   
                            <p class="w-2/3"><strong>Jumlah:</strong> {{ $transaksi->jumlah }}</p>   
                            <p class="w-2/3"><strong>Harga Satuan:</strong> Rp {{ number_format($transaksi->produk->harga, 0, ',', '.') }}</p> 
                            <p class="w-2/3"><strong>Total Harga:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>   
                            <p class="w-2/3"><strong>Tanggal Transaksi:</strong>
                             {{ $transaksi->created_at->format('d-m-Y H:i:s') }}</p>  
                             <p>==============================================</p>
                            <div class="mt-4 mb-4 w-2/3">
                                <p><strong>Total Pembayaran:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                            </div>
                            <p>==============================================</p>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
     @endhasrole
</x-app-layout>