<x-app-layout>
    @hasrole('owner')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List User') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <x-primary-button tag="a" href="{{ route('user.create') }}">Tambah Data User</x-primary-button>
                <x-table>
                    <x-slot name="header">
                        <tr class="py-10">
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </x-slot>


                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>
                                @foreach($user['roles'] as $role)
                                    {{ ucfirst($role['name']) }}{{ !$loop->last ? ', ' : '' }} 
                                @endforeach
                                {{ ' ' }}
                                @if(isset($user['cabang']))
                                    {{ $user['cabang']['nama'] }} 
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('user.destroy', $user['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button class="bg-red-500 text-red-600 hover:text-black hover:bg-red-400">Hapus</x-primary-button>
                                </form>
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
