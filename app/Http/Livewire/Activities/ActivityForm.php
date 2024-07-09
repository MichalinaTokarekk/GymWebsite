<?php

namespace App\Http\Livewire\Activities;

use Livewire\Component;
use App\Models\Activity;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ActivityForm extends Component
{   
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;
    
    public Activity $activity;
    public Bool $editMode;

    public $image;
    public $imageUrl;
    public $imageExists;

    public function rules()
    {
        return [
            'activity.name' => [
                'required',
                'string',
                'min:2' . 
                    ($this->editMode ? (',' . $this->activity->id) : '')
                ],
            'activity.description' => [
                'required',
                'string',
                'min:20' . 
                    ($this->editMode ? (',' . $this->activity->id) : ''),

            ],
            'activity.trainer_id' => [
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
        return [
            'name' => Str::lower(__('activities.attributes.name')),
            'description' => Str::lower(__('activities.attributes.description')),
            'trainer' => Str::lower(__('activities.attributes.trainer')),
            'image' => Str::lower(__('activities.attributes.image')),
        ];
    }

    public function mount(Activity $activity, Bool $editMode)
    {
        $this->activity = $activity;
        $this->imageChange();
        $this->editMode = $editMode;
    }

    public function render()
    {
        return view('livewire.activities.activity-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function save()
    {
        if ($this->editMode){
            $this->authorize('update', $this->activity);
        } else {
            $this->authorize('create', Activity::class);
        }

        $this->validate();

        $activity = $this->activity;
        $image = $this->image;
        DB::transaction(function() use ($activity, $image) {
            $activity->save();
            if ($image !== null) {
                $activity->image = $activity->id
                    . '.' 
                    . $this->image->getClientOriginalExtension();
                $activity->save();
            }
        });

        if ($this->image !== null) {
            $this->image->storeAs(
                '',
                $this->activity->image,
                'public'
            );
        }
        $this->notification()->success(
            $title = $this->editMode
            ? __('translation.messages.successes.updated_title')
            : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
            ? __('activities.messages.successes.updated', ['name' => $this->activity->name])
            : __('activities.messages.successes.stored', ['name' => $this->activity->name])

        );
        $this->editMode = true;
        $this->imageChange();
    }

    public function deleteImageConfirm()
    {
        $this->dialog()->confirm([
            'title' => __('activities.dialogs.image_delete.title'),
            'description' => __('activities.dialogs.image_delete.description', [
                'name' => $this->activity->name
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
        if (Storage::disk('public')->delete($this->activity->image)) {
            $this->activity->image = null;
            $this->activity->save();
            $this->imageChange();
             $this->notification()->success(
                 $title =  __('translation.messages.successes.destroy_title'),
                 $description = __('activities.messages.successes.image_deleted', [
                    'name' => $this->activity->name
                    ])
                );

                     return;
             }

             $this->notification()->error(
                $title =  __('translation.messages.errors.destroy_title'),
              
               $description = __('trainers.messages.errors.image_deleted', [
                   'title' => $this->competactivityition->title]),
                    );


    }
    protected function imageChange()
    {
        $this->imageExists = $this->activity->imageExists();
        $this->imageUrl = $this->activity->imageUrl();
    }

}
