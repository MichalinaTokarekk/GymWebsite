<?php

namespace App\Http\Livewire\Competitions;

use App\Models\User;
use WireUi\Traits\Actions;
use App\Models\Competition;
use LaravelViews\Views\GridView;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Traits\CompetitionSign;
use App\Http\Livewire\Actions\CompetitionSignAction;
use App\Http\Livewire\Users\Actions\SaveUserCompetition;
use App\Http\Livewire\Competitions\Actions\SaveCompetition;
use App\Http\Livewire\Competitions\Filters\InputCategoryFilter;
use App\Http\Livewire\Competitions\Actions\EditCompetitionAction;
use App\Http\Livewire\Competitions\Actions\RestoreCompetitionAction;
use App\Http\Livewire\Competitions\Actions\SoftDeleteCompetitionAction;

class CompetitionsGridView extends GridView 
{
    use Actions;
    use SoftDelete;
    use Restore;
    use CompetitionSign;


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

        $query = Competition::query()
                ->with(['categories', 'user']);
            if (request()->user() !== null && request()->user()->can('manage', Competition::class)){
                $query->withTrashed();
            }
            $query->orderBy('date', 'desc'); 
            return $query;
    }


    public function zapis(Competition $competition)
    {
        //dd($course);
        $user = Auth::user();
        $user->competitions()->syncWithoutDetaching($competition);
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
        
       if (request()->user() !== null && request()->user()->can('manage', Competition::class)) {
        return [
            new EditCompetitionAction('competitions.edit', __('translation.actions.edit')),
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
