<?php

namespace App\Http\Livewire\Updates;

use App\Models\Update;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Updates\Actions\EditUpdateAction;
use App\Http\Livewire\Updates\Actions\RestoreUpdateAction;
use App\Http\Livewire\Updates\Actions\SoftDeleteUpdateAction;



class UpdatesGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;

    protected $model = Update::class;

    protected $paginate = 10;
    public $maxCols = 1;

    public $searchBy = [
        'title',
        'description',
    ];
    public $cardComponent = 'livewire.updates.grid-view-item';
    public function repository():Builder
    {

        $query = Update::query(); 
            if (request()->user() !== null && request()->user()->can('manage', Update::class)){
                $query->withTrashed();
            }
            $query->orderBy('created_at', 'desc'); 
            return $query;
    }
   
    public function card($model)
    {
        return [
            'image' => $model->imageUrl(),
            'title' => $model->title,
            'description' => $model->description,
            
        ];
    
    }
    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }

    protected function actionsByRow()
    {
       if (request()->user() !== null && request()->user()->can('manage', Update::class)) {
        return [
            new EditUpdateAction('updates.edit', __('translation.actions.edit')
        ),
            new SoftDeleteUpdateAction(),
            new RestoreUpdateAction()

        ];
       } else {
        return [];
       }
    }

    protected function softDeleteNotificationDescription(Model $model)
    {
        return __('updates.messages.successes.destroy', [
            'title' => $model->title,
        ]);
    }


    protected function restoreNotificationDescription(Model $model)
    {
        return __('updates.messages.successes.restore', [
            'title' => $model->title

        ]);
    }


}
