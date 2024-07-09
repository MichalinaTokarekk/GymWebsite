<?php

namespace App\Http\Livewire\Competitions;

use App\Models\User;
use App\Models\Trainer;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Competition;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompetitionForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public Competition $competition;
    public Bool $editMode;
    public $image;


    public $imageUrl;
    public $categoriesIds;

    public $imageExists;


    public function rules()
    {
        return [
            'competition.title' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'competition.description' => [
                'required',
                'min: 10',
            ],
            'competition.date' => [
                'date',
                'required',
            ],
            'competition.trainer_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'image' => [
              'nullable',
              'image',
              'max:1024',
            ],
        
            
        ];
    }

    public function validationAttributes()
    {
        return[

         
            'title' => Str::lower(__('competitions.attributes.title')),
            'description' => Str::lower(__('competitions.attributes.description')),
            'date' => Str::lower(__('competitions.attributes.date')),
            'categoriesIds' => Str::lower(__('competitions.attributes.categoriesIds')),
            'trainer' => Str::lower(__('competitions.attributes.trainer')),
            'image' => Str::lower(__('competitions.attributes.image')),
        ];
    }


    public $trainersForSelect;
    public function mount(Competition $competition, Bool $editMode)
    {
        $this->competition = $competition;
        $this->categoriesIds = $this->competition->categories->toArray();
        $this->imageChange();
        $this->editMode = $editMode;
        $this->trainersForSelect = $this->getTrainersForSelect(); // Ensure this line is here
    }
    



    public function getTrainersForSelect()
{
    $role = Role::where('name', 'trainer')->first();

    if (!$role) {
        return [];
    }

    $trainers = $role->users;

    $formattedTrainers = $trainers->map(function ($trainer) {
        return [
            'id' => $trainer->id,
            'label' => $trainer->imie . ' ' . $trainer->nazwisko,
        ];
    })->toArray();

    // dd($formattedTrainers); 

    return $formattedTrainers;
}

    



    public function render()
    {        
        return view('livewire.competitions.competition-form');
    }


    



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->competition);
        } else {
            $this->authorize('create', Competition::class);
        }
    
        $this->validate();

        $competition = $this->competition;
        $categoriesIds = $this->categoriesIds;
        $image = $this->image;
        DB::transaction(function() use ($competition, $categoriesIds, $image) {
            $competition->save();
            if ($image !== null) {
                $competition->image = $competition->id
                    . '.' 
                    . $this->image->getClientOriginalExtension();
                $competition->save();

            }
            $competition->categories()->sync($categoriesIds);
            
        });

        if ($this->image !== null) {
            $this->image->storeAs(
                '',
                $this->competition->image,
                'public'
            );
        }

        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('competitions.messages.successes.updated', ['title' => $this->competition->title])
                : __('competitions.messages.successes.stored', ['title' => $this->competition->title]),

        );

        $this->editMode = true;
        $this->imageChange();

    }

    public function deleteImageConfirm()
    {
        $this->dialog()->confirm([
            'title' => __('competitions.dialogs.image_delete.title'),
            'description' => __('competitions.dialogs.image_delete.description', [
                'title' => $this->competition->title
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'deleteImage',
            ],
            'reject' => [
                'label' => __('translation.no'),
            ]
        ]);
    }


    public function deleteImage()
    {
        if (Storage::disk('public')->delete($this->competition->image)) {
            $this->competition->image = null;
            $this->competition->save();
            $this->imageChange();
             $this->notification()->success(
                 $title =  __('translation.messages.successes.destroy_title'),
                 $description = __('competitions.messages.successes.image_deleted', [
                    'title' => $this->competition->title
                    ])
                );

                     return;
             }

             $this->notification()->error(
                $title =  __('translation.messages.errors.destroy_title'),
              
               $description = __('trainers.messages.errors.image_deleted', [
                   'title' => $this->competition->title]),
                    );


    }
    protected function imageChange()
    {
        $this->imageExists = $this->competition->imageExists();
        $this->imageUrl = $this->competition->imageUrl();
    }

    
}
