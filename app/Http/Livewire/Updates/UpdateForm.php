<?php

namespace App\Http\Livewire\Updates;
use App\Models\Update;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UpdateForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public Update $update;
    public Bool $editMode;
    public $image;


    public $imageUrl;
    public $imageExists;


    public function rules()
    {
        return [
            'update.title' => [
                'required',
                'string',
                'min:3',
                'max:300',
            ],
            'update.description' => [
                'required',
                'min: 300',
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
            'title' => Str::lower(__('updates.attributes.nazwa')),
            'description' => Str::lower(__('updates.attributes.opis')),
            'image' => Str::lower(__('updates.attributes.image')),
        ];
    }

    public function mount(Update $update, Bool $editMode)
    {
        $this->update = $update;
        $this->imageChange();
        $this->editMode = $editMode;

    }

    public function render()
    {
        return view('livewire.updates.form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->update);
        } else {
            $this->authorize('create', Update::class);

        
        }
        sleep(1);

        $this->validate();

        $update=$this->update;

        $image=$this->image;

        
        DB::transaction(function() use ($update,$image)
        {
           
            if($image!==null)
            {
                $update->image=$update->id
                .'.'
                . $this->image->getClientOriginalExtension();
                
                $update->save();
            }
            else {
                $update->save();
            }
            
        });
        
       
        if($this->image !==null)
        {
            $this->image->storeAs(
                "",
                $this->update->image,
                'public'
            );
                }

        
     
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $opis = $this->editMode
                ? __('updates.messages.successes.updated', ['title' => $this->update->title ])
                : __('updates.messages.successes.stored', ['title' => $this->update->title])


        );
        $this->editMode = true;
        $this->imageChange();

    }

    public function deleteImageConfirm()
    {
        $this->dialog()->confirm([
            'title' => __('updates.dialogs.image_delete.title', [
                'nazwa' => $this->update->title
            ]),
            'description' => __('updates.dialogs.image_delete.description', [
                'nazwa' => $this->update->title
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
        if (Storage::disk('public')->delete($this->update->image)) {
            $this->update->image = null;
            $this->update->save();
            $this->imageChange();
             $this->notification()->success(
                 $title =  __('translation.messages.successes.destroy_title', [
                    'nazwa' => $this->update->title,
                    ]),
                 $opis = __('Updates.messages.successes.image_deleted', [
                    'nazwa' => $this->update->title,

                    ])
                );

                     return;
             }

             $this->notification()->error(
                $title =  __('translation.messages.errors.destroy_title'),
              
               $opis = __('Updates.messages.errors.image_deleted', [
                   'nazwa' => $this->update->title]),
                    );


    }
    protected function imageChange()
    {
        $this->imageExists = $this->update->imageExists();
        $this->imageUrl = $this->update->imageUrl();
    }

    
}
