<?php

namespace App\Http\Livewire\Shops;

use App\Models\Shop;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShopForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public Shop $shop;
    public Bool $editMode;
    public $image;

    public $imageUrl;
    public $imageExists;


    public function rules()
    {
        return [
            'shop.title' => [
                'required',
                'string',
                'min:1',
                'max:100',
            ],
            'shop.description' => [
                'required',
                'min: 10',
            ],
            'shop.link' => [
                'string',
                'required',
                'url', 
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

         
            'title' => Str::lower(__('shops.attributes.title')),
            'link' => Str::lower(__('shops.attributes.link')),
            'description' => Str::lower(__('shops.attributes.description')),
            'image' => Str::lower(__('shops.attributes.image')),
    
            


        ];
    }

    public function mount(Shop $shop, Bool $editMode)
    {
        $this->shop = $shop;
        $this->imageChange();
        $this->editMode = $editMode;

    }

    public function render()
    {
        return view('livewire.shops.shop-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->shop);
        } else {
            $this->authorize('create', Shop::class);
        }
    
        $this->validate();

        $shop = $this->shop;
        $image = $this->image;
        DB::transaction(function() use ($shop, $image) {
            $shop->save();
            if ($image !== null) {
                $shop->image = $shop->id
                    . '.' 
                    . $this->image->getClientOriginalExtension();
                $shop->save();

            }
            
        });

        if ($this->image !== null) {
            $this->image->storeAs(
                '',
                $this->shop->image,
                'public'
            );
        }

        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('shops.messages.successes.updated', ['title' => $this->shop->title])
                : __('shops.messages.successes.stored', ['title' => $this->shop->title]),

        );

        $this->editMode = true;
        $this->imageChange();

    }

    public function deleteImageConfirm()
    {
        $this->dialog()->confirm([
            'title' => __('shops.dialogs.image_delete.title'),
            'description' => __('shops.dialogs.image_delete.description', [
                'title' => $this->shop->title
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
        if (Storage::disk('public')->delete($this->shop->image)) {
            $this->shop->image = null;
            $this->shop->save();
            $this->imageChange();
             $this->notification()->success(
                 $title =  __('translation.messages.successes.destroy_title'),
                 $description = __('shops.messages.successes.image_deleted', [
                    'title' => $this->shop->title
                    ])
                );

                     return;
             }

             $this->notification()->error(
                $title =  __('translation.messages.errors.destroy_title'),
              
               $description = __('shops.messages.errors.image_deleted', [
                   'title' => $this->shop->title]),
                    );


    }
    protected function imageChange()
    {
        $this->imageExists = $this->shop->imageExists();
        $this->imageUrl = $this->shop->imageUrl();
    }

    
}
