<x-layout>
    <h1 class="text-3xl font-bold">Welcome Back</h1>

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('login') }}" method="post">
            @csrf
            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="text" name="email" class="input" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- Remember Checkbox --}}
            <div class="mb-4">
                <input type="checkbox" name="remember" id="remmber">
                <label for="remember">Remember Me</label>
            </div>
            @error('failed')
                <p class="error">{{ $message }}</p>
            @enderror
            <button class="btn bg-slate-700 px-5 py-3 rounded text-slate-50">Register</button>
        </form>
    </div>
</x-layout>
