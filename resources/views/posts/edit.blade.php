<x-layout>
    <a href="{{route('dashboard')}}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your dashboard</a>
    <div class="card">
        <h2 class="font-bold mb-4">Create a new post</h2>
        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" class="input" value="{{ $post->title }}">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- Post Body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="5" class="input">{{ $post->body }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current Cover photo if exist --}}
            @if ($post->image)
                <div class="h-64 rounded-md mb-4 w-1/4 object-cover">
                    <label>Current cover photo</label>
                    <img src="{{asset('storage/'.$post->image)}}" alt="">
                </div>
            @endif

            {{-- Post Image --}}
            <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" name="image" id="image">
                @error('image')
                    <p class="error">{{$message}}</p>
                @enderror
            </div>
            {{-- Submit Button --}}
            <button class="btn bg-slate-700 px-5 py-3 rounded text-slate-50">Update</button>
        </form>
    </div>
</x-layout>
