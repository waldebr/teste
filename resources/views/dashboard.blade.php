<x-layouts.app title="Painel">
    <h1 class="mb-2 text-2xl font-bold">Ola, {{ $user->name }}!</h1>
    <p class="mb-8 text-slate-600">Voce esta autenticado. Esta pagina e protegida pelo middleware <code>auth</code>.</p>

    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        @foreach ($totais as $nome => $valor)
            <div class="rounded-xl bg-white p-5 shadow">
                <div class="text-sm uppercase tracking-wide text-slate-500">{{ $nome }}</div>
                <div class="mt-1 text-3xl font-bold">{{ $valor }}</div>
            </div>
        @endforeach
    </div>

    @if ($user->vendedor)
        <div class="mt-8 rounded-xl bg-white p-5 shadow">
            <h2 class="mb-2 font-semibold">Vendedor vinculado</h2>
            <p class="text-slate-600">
                {{ $user->vendedor->nome }}
                @if ($user->vendedor->regiao)
                    — regiao {{ $user->vendedor->regiao->nome }}
                @endif
            </p>
        </div>
    @endif
</x-layouts.app>
