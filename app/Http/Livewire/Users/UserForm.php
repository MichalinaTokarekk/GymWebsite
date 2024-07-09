<?php

namespace App\Http\Livewire\Users;
use App\Models\User;
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

class UserForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public User $user;
    public Bool $editMode;
    public $image;


    public $imageUrl;
    public $imageExists;
    public $specializationsIds;

    public function rules()
    {
        // $this->user->makeVisible('password');
        return [
            'user.imie' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'user.nazwisko' => [
                'required',
                'string',
                'min:3',
                'max:100',
            ],
            'user.email' => [
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
            'user.opis' => [
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

    public function mount(User $user, Bool $editMode)
    {
        $this->user = $user;
        // $this->user->load(['activities']);
        $this->specializationsIds = $this->user->specializations->toArray();
        $this->imageChange();
        $this->editMode = $editMode;

    }

    public function render()
    {
        return view('livewire.users.user-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->user);
        } else {
            $this->authorize('create', User::class);

        
        }
        sleep(1);

        $this->validate();

        $user=$this->user;
        $specializationsIds = $this->specializationsIds;
        $image=$this->image;
        $this->user->password= Hash::make($this->user->password);

        DB::transaction(function() use ($user,$specializationsIds,$image)
        {
           
            if($image!==null)
            {
                $user->image=$user->id
                .'.'
                . $this->image->getClientOriginalExtension();
                
                $user->save();
            }
            else {
                $user->save();
                $user->specializations()->sync($specializationsIds);
            }
            
        });
        
       
        if($this->image !==null)
        {
            $this->image->storeAs(
                "",
                $this->user->image,
                'public'
            );
                }

        
     
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $opis = $this->editMode
                ? __('users.messages.successes.updated', ['imie' => $this->user->imie,'nazwisko' => $this->user->nazwisko ])
                : __('users.messages.successes.stored', ['imie' => $this->user->imie, 'nazwisko' => $this->user->nazwisko]),


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
                'imie' => $this->user->imie,
                'nazwisko' => $this->user->nazwisko
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
        if (Storage::disk('public')->delete($this->user->image)) {
            $this->user->image = null;
            $this->user->save();
            $this->imageChange();
             $this->notification()->success(
                 $title =  __('translation.messages.successes.destroy_title', [
                    'imie' => $this->user->imie,
                    'nazwisko' => $this->user->nazwisko,

                    ]),
                 $opis = __('users.messages.successes.image_deleted', [
                    'imie' => $this->user->imie,
                    'nazwisko' => $this->user->nazwisko,

                    ])
                );

                     return;
             }

             $this->notification()->error(
                $title =  __('translation.messages.errors.destroy_title'),
              
               $opis = __('users.messages.errors.image_deleted', [
                   'imie' => $this->user->imie]),
                    );


    }
    protected function imageChange()
    {
        $this->imageExists = $this->user->imageExists();
        $this->imageUrl = $this->user->imageUrl();
    }

    
}
