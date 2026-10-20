<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\NotaFiscal;
use App\Models\Produto;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Painel protegido, so acessivel apos o login.
     */
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'user' => $request->user(),
            'totais' => [
                'clientes' => Cliente::count(),
                'produtos' => Produto::count(),
                'vendedores' => Vendedor::count(),
                'notas' => NotaFiscal::count(),
            ],
        ]);
    }
}
