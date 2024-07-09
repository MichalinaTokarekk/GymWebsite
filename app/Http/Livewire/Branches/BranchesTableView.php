<?php

namespace App\Http\Livewire\Branches;

use App\Http\Controllers\ElementController;
use App\Models\User;
use App\Models\Branch;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Traits\Restore;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Branches\Actions\Bar;
use App\Http\Livewire\Branches\Actions\WiFi;
use App\Http\Livewire\Branches\Actions\Sauna;
use App\Http\Livewire\Branches\Actions\Szafki;
use App\Http\Livewire\Branches\Actions\Fitness;
use App\Http\Livewire\Branches\Actions\Kontakt;
use App\Http\Livewire\Branches\Actions\Parking;
use App\Http\Livewire\Branches\Actions\Solarium;
use App\Http\Livewire\Branches\Actions\Atmosfera;
use App\Http\Livewire\Branches\Actions\EditBranchAction;
use App\Http\Livewire\Branches\Actions\ZajeciaGrupowe;
use App\Models\Element;
use BaconQrCode\Renderer\Path\Path;

class BranchesTableView extends TableView
{
    use Actions;
    use SoftDelete;
    
    protected $model = Branch::class;
    
    public $searchBy = [
        'place',
        'name',
        'address',
        'phone',
      
    ];
    public function repository():Builder
    {
        return Branch::query()->withTrashed();
    }
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('branches.attributes.place'))->sortBy('place'),
            Header::title(__('branches.attributes.name'))->sortBy('name'),
            Header::title(__('branches.attributes.address'))->sortBy('address'),
            Header::title(__('branches.attributes.phone'))->sortBy('phone'),
            Header::title(__('branches.attributes.elements')),
            Header::title(__('')),
         
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */

     
    public function row($model): array
    {
        $elementNames = [];
        foreach($model->elements as $element)
        {
            array_push($elementNames, $element->name);
        }
        return [
            $model->place,
            $model->name,
            $model->address,
            $model->phone,  
            view( 'elements.index',
                ['elements' => $elementNames]
            )
        ];
    }

        protected function actionsByRow()
        {
            return [
                new EditBranchAction('branches.edit', __('translation.actions.edit')),
            ];

        }


}
