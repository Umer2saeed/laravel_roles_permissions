<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            @can('create roles')
                <a href="{{ route('roles.create') }}" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full">Create</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-md text-left rtl:text-right">
                        <thead class="bg-gray-100 text-md uppercase">
                        <tr class="border-b">
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Permissions</th>
                            <th class="px-6 py-3 text-left">Created At</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @if($roles->isNotEmpty())
                            @foreach($roles as $role)
                                <tr class="border-b">
                                    <td class="px-6 py-3 text-left" style="width: 50px">{{ $role->id }}</td>
                                    <th class="px-6 py-3 text-left">{{ $role->name }}</th>
                                    <td class="px-6 py-3 text-left">
                                        {{ $role->permissions->pluck('name')->implode(', ') }}
                                    </td>
                                    <td class="px-6 py-3 text-left" style="width: 180px">{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}</td>
                                    <td class="flex justify-center px-6 py-3 text-center">
                                        @can('edit roles')
                                            <a href="{{ route('roles.edit', $role->id) }}">
                                                <img width="40" src="{{ asset('assets/images/edit-2.svg') }}" alt="">
                                            </a>
                                        @endcan
                                        @can('delete roles')
                                            <a href="javascript:void(0);" onclick="deleteRole({{ $role->id }})">
                                                <img width="40" src="{{ asset('assets/images/delete-2.svg') }}" alt="">
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deleteRole(id) {
                if(confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route("roles.destroy") }}',
                        type: 'delete',
                        data: {id:id},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            window.location.href = '{{ route("roles.index") }}'
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
