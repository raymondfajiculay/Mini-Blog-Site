<x-layout>
    <h1 class="title">{{$user}}'s Posts &#9830;{{$posts->total()}}</h1>

    {{-- User's Posts --}}
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post"/>
        @endforeach
    </div>
    <div>
        {{$posts->links()}}
    </div>
</x-layout>
