<x-layouts.app title="Cadastro">
    <div class="mx-auto max-w-md rounded-xl bg-white p-8 shadow">
        <h1 class="mb-6 text-2xl font-bold">Criar conta</h1>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium">Nome</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full rounded border border-slate-300 px-3 py-2 focus:border-slate-500 focus:outline-none">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium">Confirmar senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full rounded border border-slate-300 px-3 py-2 focus:border-slate-500 focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full rounded bg-slate-900 px-4 py-2 font-medium text-white hover:bg-slate-800">
                Cadastrar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-600">
            Ja tem conta?
            <a href="{{ route('login') }}" class="font-medium text-slate-900 underline">Entrar</a>
        </p>
    </div>
</x-layouts.app>
