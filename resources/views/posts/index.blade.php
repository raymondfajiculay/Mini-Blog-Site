<x-layout>
    <h1 class="title">Latest Post</h1>

    {{-- <img src="{{ asset('storage/post_images/mr736lwifwBNCPaWHlmGZRYLshGEBXnBXO79pdVH.jpg') }}" alt=""> --}}

    {{-- List of Posts --}}
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post"/>
        @endforeach
    </div>

    {{-- Pagination Link --}}
    <div>
        {{$posts->links()}}
    </div>
</x-layout>
