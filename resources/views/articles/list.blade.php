<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            <a href="{{ route('articles.create') }}" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded-full">Create</a>
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
                            <th class="px-6 py-3 text-left">Title</th>
                            <th class="px-6 py-3 text-left">Content</th>
                            <th class="px-6 py-3 text-left">Author</th>
                            <th class="px-6 py-3 text-left">Created At</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @if($articles->isNotEmpty())
                            @foreach($articles as $article)
                                <tr class="border-b">
                                    <td class="px-6 py-3 text-left" style="width: 50px">{{ $article->id }}</td>
                                    <th class="px-6 py-3 text-left">{{ $article->title }}</th>
                                    <td class="px-6 py-3 text-left" style="width: 300px">{{ \Illuminate\Support\Str::limit($article->text, 60) }}</td>
                                    <td class="px-6 py-3 text-left">{{ $article->author }}</td>
                                    <td class="px-6 py-3 text-left" style="width: 150px">{{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}</td>
                                    <td class="flex justify-center px-6 py-3 text-center">
                                        <a href="{{ route('articles.edit', $article->id) }}">
                                            <img width="40" src="{{ asset('assets/images/edit-2.svg') }}" alt="">
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteArticle({{ $article->id }})">
                                            <img width="40" src="{{ asset('assets/images/delete-2.svg') }}" alt="">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="my-3">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script type="text/javascript">
            function deleteArticle(id) {
                if(confirm("Are you sure you want to delete?")) {
                    $.ajax({
                        url: '{{ route("articles.destroy") }}',
                        type: 'delete',
                        data: {id:id},
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            window.location.href = '{{ route("articles.index") }}'
                        }
                    });
                }
            }
        </script>
    </x-slot>
</x-app-layout>
