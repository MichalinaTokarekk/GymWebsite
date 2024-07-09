<?php

namespace App\Http\Livewire\Trainers;

use App\Models\User;
use App\Models\Trainer;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Livewire\Users\Actions\EditTrainerAction;
use App\Http\Livewire\Users\Actions\RestoreUserAction;
use App\Http\Livewire\Users\Actions\RestoreTrainerAction;
use App\Http\Livewire\Users\Actions\SoftDeleteUserAction;
use App\Http\Livewire\Users\Actions\SoftDeleteTrainerAction;

class CadreGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;

    protected $model = User::class;     

    protected $paginate = 20;
    public $maxCols = 3;
    
    // public $searchBy = [
    //     'imie',
    //     'nazwisko',
    // ];
    
    public $cardComponent = 'livewire.trainers.grid-view-item';
   
    public function card($model)
    {
        return [
            'image' => $model->imageUrl(),
            'imie' => $model->imie,
            'nazwisko' => $model->nazwisko,
            'specializations' => $model->specializations,
            'opis' => $model->opis,
            
        ];
    
    }
    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }

    // protected function filters()
    // {
    //     return [
    //         new InputCategoryFilter,
    //     ];
    // }

    protected function actionsByRow()
    {
        if(request()->user()!==null)
            if (request()->user()->can('manage', User::class)) {
                return [
                    new EditTrainerAction('trainers.edit', __('translation.actions.edit')),
                    new SoftDeleteUserAction(),
                    new RestoreUserAction('users.edit', __('translation.actions.edit')),
                ];
            } else {
                return [];
            }
        return[];
    }

    protected function softDeleteNotificationDescription(Model $model)
    {
        return __('trainers.messages.successes.destroy', [
            'imie' => $model->imie, 'nazwisko' => $model->nazwisko

        ]);
    }

    protected function restoreNotificationDescription(Model $model)
    {
        return __('trainers.messages.successes.restore', [
            'imie' => $model->imie, 'nazwisko' => $model->nazwisko

        ]);
    }

}
