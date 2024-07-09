<?php

namespace App\Http\Livewire\Users;

use WireUi\Traits\Actions;

use App\Models\User;
use App\Models\Competition;
use LaravelViews\Views\GridView;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Livewire\Competitions\Actions\EditCompetitionAction;

use App\Http\Livewire\Competitions\Actions\RestoreCompetitionAction;
use App\Http\Livewire\Competitions\Actions\SoftDeleteCompetitionAction;
use App\Models\Competitiont;
use App\Models\TrainerCompetition;

class TrainerCompetitionGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;


    protected $model = Competition::class;

    protected $paginate = 20;
    public $maxCols = 1;

    public $cardComponent = 'livewire.competitions.grid-view-item';


    public $searchBy = [
        'title',
        'description',
        'date',
        'categories.name'
    ];

    public function repository():Builder
    {
        $trainerId = request()->user()->id;

        $query = Competition::query()
        ->with(['categories', 'user'])
        ->where('trainer_id', $trainerId);

        return $query;
    }


    public function wypis(Competition $competition)
    {
        //dd($course);
        $user = Auth::user();
        $user->competitions()->detach($competition);

    }


   
    public function card($model)
    {
        
        return [
            'image' => $model->imageUrl(),
            'title' => $model->title,
            'description' => $model->description,
            'date' => $model->date,
            'categories' => $model->categories,
            'user' => User::find($model->trainer_id),
            
        ];
    
    }
    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }



    protected function actionsByRow()
    {
       if (request()->user()->can('manage', Competition::class)) {
        return [
           new EditCompetitionAction('competitions.edit', __('translation.actions.edit')
        ),
            new SoftDeleteCompetitionAction(),
            new RestoreCompetitionAction(),

        ];
       } else {
        return [];
       }
    }

    protected function softDeleteNotificationDescription(Model $model)
    {
        return __('competitions.messages.successes.destroy', [
            'title' => $model->title

        ]);
    }


    protected function restoreNotificationDescription(Model $model)
    {
        return __('competitions.messages.successes.restore', [
            'title' => $model->title

        ]);
    }
}
