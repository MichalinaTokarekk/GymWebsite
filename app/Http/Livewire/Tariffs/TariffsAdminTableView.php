<?php

namespace App\Http\Livewire\Tariffs;

use App\Models\Tariff;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Tariffs\Actions\EditTariffAction;
use App\Http\Livewire\Tariffs\Filters\TariffsTypeFilter;
use App\Http\Livewire\Tariffs\Filters\TariffsPriceFilter;
use App\Http\Livewire\Tariffs\Actions\RestoreTariffAction;
use App\Http\Livewire\Tariffs\Actions\SoftDeleteTariffAction;

class TariffsAdminTableView extends TableView
{

    use Actions;
    protected $model = User::class;


    public $searchBy = [
        'name',
        'type',
        'number',
        'price',

        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function repository():Builder
    {
        return Tariff::query()->withTrashed();
    }

    public function headers(): array
    {
        return [
            Header::title(__('tariffs.attributes.name'))->sortBy('name'),
            Header::title(__('tariffs.attributes.type'))->sortBy('type'),
            Header::title(__('tariffs.attributes.number'))->sortBy('number'),
            Header::title(__('tariffs.attributes.price'))->sortBy('price'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    public function row($model): array
    {
        return [
            $model->name,
            $model->type,
            $model->number,
            number_format($model->price, 2, '.', ','),
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    protected function filters()
    {
        return [
            new TariffsPriceFilter,
            new TariffsTypeFilter,
        ];
    }

    protected function actionsByRow()
    {
         return [
            new EditTariffAction('tariffs.edit', __('tariffs.actions.edit')),
            new SoftDeleteTariffAction(),
            new RestoreTariffAction(),
         ];
    }

    public function softDelete(int $id)
    {
        $tariff = Tariff::find($id);
        $tariff->delete();
    
        // Emit an event to notify CartCounter about the product deletion
        $this->emit('productDeleted', $id);
    
        session()->flash('delete_success', 'TEST');
    
        $this->notification()->success(
            $title = __('tariffs.messages.successes.destroy_title'),
            $description = __('tariffs.messages.successes.destroy', [
                'name' => $tariff->name,
            ])
        );
    }
    

    public function restore(int $id)
    {
        $tariff = Tariff::withTrashed()->find($id);
        $tariff->restore();
        $this->notification()->success(
            $title = __('tariffs.messages.successes.restore_title'),
            $description = __('tariffs.messages.successes.restore', [
                'name' => $tariff->name,
            ]),
        );
    }
}
