<?php

namespace App\Http\Livewire\Users;

use App\Models\Tariff;
use App\Models\OrderItem;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Traits\Restore;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;

class UserTariffsTableView extends TableView
{
    use Actions;
    use SoftDelete;
    use Restore;

    protected $model = Tariff::class;

    public $searchBy = [
        'name',
    ];

    public function repository(): Builder
    {
        $userId = auth()->id();
        $tariffs = auth()->user()->tariffs;
    
        return Tariff::whereIn('id', $tariffs->pluck('id'));
    }
    

    public function headers(): array
    {
        return [
            Header::title(__('tariffs.attributes.name'))->sortBy('name'),
            Header::title(__('tariffs.attributes.type'))->sortBy('type'),
            Header::title(__('tariffs.attributes.qty'))->sortBy('qty'), // Dodana kolumna 'qty'
            Header::title(__('tariffs.attributes.number'))->sortBy('number'),
            Header::title(__('tariffs.attributes.data_rozpoczecia')),
            Header::title(__('tariffs.attributes.data_zakonczenia')),

        ];
    }

    public function row($model): array
    {
    // Pobierz order_items dla danego modelu (taryfy) i danego użytkownika
    $orderItems = OrderItem::whereHas('order', function ($query) {
        $query->where('user_id', auth()->id()); // Dodaj to, aby uwzględnić tylko zamówienia tego użytkownika
    })->where('tariff_id', $model->id)->sum('qty'); // Zmieniono na sumę bezpośrednio

    
        return [
            $model->name,
            $model->type,
            $orderItems, // Dodana kolumna 'qty'
            $model->number,
            $model->data_rozpoczecia,
            $model->data_zakonczenia,
        ];
    }
}
