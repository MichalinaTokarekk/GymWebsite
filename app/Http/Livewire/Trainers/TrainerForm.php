<?php

namespace App\Http\Livewire\Trainers;
use App\Models\User;
use App\Models\Trainer;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TrainerForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;

    public User $trainer;
    public Bool $editMode;
    public $image;

    public $imageUrl;
    public $imageExists;
    public $specializationsIds;

    public function rules()
    {
        // $this->user->makeVisible('password');
        return [
            'trainer.imie' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'trainer.nazwisko' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'trainer.email' => [
                'required',
                'string',
                'min:5',
                'max:100',
            ],
            // 'user.password' => [
            //     'required',
            //     'string',
            //     'min:3',
            //     'max:100',
            // ],
            // 'user.activities' => [
            //     'array',
            // ],
            'trainer.opis' => [
                'nullable',
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

         
            'imie' => Str::lower(__('users.attributes.imie')),
            'nazwisko' => Str::lower(__('users.attributes.nazwisko')),
            'email' => Str::lower(__('users.attributes.email')),
            // 'password' => Str::lower(__('users.attributes.password')),
            'opis' => Str::lower(__('users.attributes.opis')),
            'specializationsIds' => Str::lower(__('specializations.attributes.specializationsIds')),
            'image' => Str::lower(__('users.attributes.image')),
            // 'places' => Str::lower(__('users.attributes.activities')),
            //zajecia z relacją


        ];
    }

    public function mount(User $trainer, Bool $editMode)
    {
        $this->trainer = $trainer;
        // $this->user->load(['activities']);
        $this->specializationsIds = $this->trainer->specializations->toArray();
        $this->imageChange();
        $this->editMode = $editMode;

    }

    public function render()
    {
        return view('livewire.trainers.trainer-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->trainer);
        } else {
            $this->authorize('create', User::class);

        
        }
        sleep(1);

        $this->validate();

        $trainer=$this->trainer;
        $specializationsIds = $this->specializationsIds;
        $image=$this->image;
        $this->trainer->password= Hash::make($this->trainer->password);

        DB::transaction(function() use ($trainer,$specializationsIds,$image)
        {
           
            if($image!==null)
            {
                $trainer->image=$trainer->id
                .'.'
                . $this->image->getClientOriginalExtension();
                
                $trainer->save();
            }
            else {
                $trainer->save();
                $trainer->specializations()->sync($specializationsIds);
            }
            
        });
        
       
        if($this->image !==null)
        {
            $this->image->storeAs(
                "",
                $this->trainer->image,
                'public'
            );
                }

        
     
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $opis = $this->editMode
                ? __('users.messages.successes.updated', ['imie' => $this->trainer->imie,'nazwisko' => $this->trainer->nazwisko ])
                : __('users.messages.successes.stored', ['imie' => $this->trainer->imie, 'nazwisko' => $this->trainer->nazwisko]),


        );
        $this->editMode = true;
        // $this->user->makeHidden('password');
        $this->imageChange();

    }

    public function deleteImageConfirm()
    {
        $this->dialog()->confirm([
            'title' => __('users.dialogs.image_delete.title'),
            'description' => __('users.dialogs.image_delete.description', [
                'imie' => $this->trainer->imie,
                'nazwisko' => $this->trainer->nazwisko
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
        if (Storage::disk('public')->delete($this->trainer->image)) {
            $this->trainer->image = null;
            $this->trainer->save();
            $this->imageChange();
             $this->notification()->success(
                 $title =  __('translation.messages.successes.destroy_title', [
                    'imie' => $this->trainer->imie,
                    'nazwisko' => $this->trainer->nazwisko,

                    ]),
                 $opis = __('users.messages.successes.image_deleted', [
                    'imie' => $this->trainer->imie,
                    'nazwisko' => $this->trainer->nazwisko,

                    ])
                );

                     return;
             }

             $this->notification()->error(
                $title =  __('translation.messages.errors.destroy_title'),
              
               $opis = __('users.messages.errors.image_deleted', [
                   'imie' => $this->trainer->imie]),
                    );


    }
    protected function imageChange()
    {
        $this->imageExists = $this->trainer->imageExists();
        $this->imageUrl = $this->trainer->imageUrl();
    }

    
}
