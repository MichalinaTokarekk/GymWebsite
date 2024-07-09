<?php

namespace App\Http\Livewire\Tariffs;

use App\Models\Tariff;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Users\Filters\UsersRoleFilter;
use App\Http\Livewire\Tariffs\Actions\AddToCartAction;
use App\Http\Livewire\Tariffs\Actions\EditTariffAction;
use App\Http\Livewire\Tariffs\Filters\TariffsTypeFilter;
use App\Http\Livewire\Tariffs\Filters\TariffsPriceFilter;
use App\Http\Livewire\Tariffs\Actions\RestoreTariffAction;
use App\Http\Livewire\Tariffs\Actions\SoftDeleteTariffAction;

class TariffsTableView extends TableView
{

    use Actions;
    protected $model = User::class;


    public $searchBy = [
        'name',
        'type',
        'number',
        'price',

    ];
    public function repository():Builder
    {
        return Tariff::query();
    }

    public function headers(): array
    {
        return [
            Header::title(__('tariffs.attributes.name'))->sortBy('name'),
            Header::title(__('tariffs.attributes.type'))->sortBy('type'),
            Header::title(__('tariffs.attributes.number'))->sortBy('number'),
            Header::title(__('tariffs.attributes.price'))->sortBy('price'),      
        ];
    }


    public function row($model): array
    {
        return [
            $model->name,
            $model->type,
            $model->number,
            number_format($model->price, 2, '.', ','),
    
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
        if(request()->user() !== null && request()->user()->can('manage', Tariff::class)){
            return [
               new EditTariffAction('tariffs.edit', __('tariffs.actions.edit')),
               new SoftDeleteTariffAction(),
               new RestoreTariffAction(),
            ];
        }else if(request()->user() !== null && request()->user()->isOnlyUser()){
            return [
                new AddToCartAction()
             ];
        }else{
            return [];
        }
    }

    public function softDelete(int $id)
    {
        $tariff = Tariff::find($id);
        $tariff->delete();
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
