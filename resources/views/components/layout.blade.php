<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 text-slate-900">
    <header class="bg-slate-800 shadow-lg p-5">
        <nav class="flex justify-between text-xl font-bold">
            <a href="{{ route('posts.index') }}" class="nav-link">Home</a>
            @auth
                <div class="relative grid place-items-center" x-data="{open:false}">
                    {{-- Dropdown Menu Button--}}
                    <button type="button" class="round-btn" x-on:click="open = !open">
                        <img src="https://picsum.photos/200" alt="">
                    </button>
                    {{-- Dropdown Menu --}}
                    <div class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light" x-show="open" @click.outside="open = false">
                        <p class="username">{{auth()->user()->username}}</p>
                        <a href="{{route('dashboard')}}" class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Dashboard</a>

                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="block hover:bg-slate-100 pl-4 pr-8 py-2 mb-1">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </div>
            @endguest
        </nav>
    </header>
    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>
    <footer>

    </footer>
</body>

</html>
