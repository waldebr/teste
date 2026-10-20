<x-layouts.app title="Entrar">
    <div class="mx-auto max-w-md rounded-xl bg-white p-8 shadow">
        <h1 class="mb-6 text-2xl font-bold">Entrar</h1>

        @if (session('status'))
            <div class="mb-4 rounded bg-green-100 p-3 text-sm text-green-800">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded border border-slate-300 px-3 py-2 focus:border-slate-500 focus:outline-none">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium">Senha</label>
                <input id="password" type="password" name="password" required
                       class="w-full rounded border border-slate-300 px-3 py-2 focus:border-slate-500 focus:outline-none">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" value="1" class="rounded border-slate-300">
                Lembrar de mim
            </label>

            <button type="submit"
                    class="w-full rounded bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800">
                Entrar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-600">
            Nao tem conta?
            <a href="{{ route('register') }}" class="font-medium text-slate-900 underline">Cadastre-se</a>
        </p>
    </div>
</x-layouts.app>
