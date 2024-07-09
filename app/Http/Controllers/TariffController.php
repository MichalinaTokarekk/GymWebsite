<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Tariffs\Filters\TariffsPriceFilter;
use App\Models\Tariff;

class TariffController extends Controller
{
    public function index()
    {
        return view(
            'tariffs.index'
        );
    }

    public function create()
    {
        $this->authorize('create', Tariff::class);
        return view(
            'tariffs.form'
        );
    }

   
    public function edit(Tariff $tariff)
    {
        $this->authorize('update', $tariff);
        return view(
            'tariffs.form',
            [
                'tariff' => $tariff
            ]
        );
    }

}
