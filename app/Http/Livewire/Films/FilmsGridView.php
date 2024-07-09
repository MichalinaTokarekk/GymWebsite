<?php

namespace App\Http\Livewire\Films;

use App\Http\Livewire\Films\Actions\EditFilmAction;
use App\Http\Livewire\Films\Actions\RestoreFilmAction;
use App\Http\Livewire\Films\Actions\SoftDeleteFilmAction;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use App\Models\Film;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class FilmsGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;


    protected $model = Film::class;

    protected $paginate = 20;
    public $maxCols = 1;

    public $cardComponent = 'livewire.films.grid-view-item';


    public $searchBy = [
        'title',
        'description',
    ];

    public function repository():Builder
    {

        $query = Film::query();
            if (request()->user() !== null && request()->user()->can('manage', Film::class)){
                $query->withTrashed();
            }
            return $query;
        }
   
    public function card($model)
    {
        return [
         
            'title' => $model->title,
            'description' => $model->description,
            'video' => $model->video
            
        ];
    
    }
    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }



    protected function actionsByRow()
    {
       if (request()->user() !== null && request()->user()->can('manage', Film::class)) {
        return [
           new EditFilmAction('films.edit', __('translation.actions.edit')
        ),
            new SoftDeleteFilmAction(),
            new RestoreFilmAction(),
        
        ];
       } else {
        return [];
       }
    }

    protected function softDeleteNotificationDescription(Model $model)
    {
        return __('films.messages.successes.destroy', [
            'title' => $model->title

        ]);
    }


    protected function restoreNotificationDescription(Model $model)
    {
        return __('films.messages.successes.restore', [
            'title' => $model->title

        ]);
    }
    
}
