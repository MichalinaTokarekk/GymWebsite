<?php

namespace App\Http\Livewire\Shops;

use App\Http\Livewire\Shops\Actions\EditShopAction;
use App\Http\Livewire\Shops\Actions\RestoreShopAction;
use App\Http\Livewire\Shops\Actions\SoftDeleteShopAction;
use WireUi\Traits\Actions;
use LaravelViews\Views\GridView;
use App\Http\Livewire\Traits\Restore;
use Illuminate\Database\Eloquent\Model;
use App\Http\Livewire\Traits\SoftDelete;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Builder;

class ShopsGridView extends GridView
{
    use Actions;
    use SoftDelete;
    use Restore;


    protected $model = Shop::class;

    protected $paginate = 20;
    public $maxCols = 1;

    public $cardComponent = 'livewire.shops.grid-view-item';


    public $searchBy = [
        'title',
        'link',
        'description',
    ];

    public function repository():Builder
    {

        $query = Shop::query();
            if (request()->user() !== null && request()->user()->can('manage', Shop::class)){
                $query->withTrashed();
            }
            return $query;
        }
   
    public function card($model)
    {
        return [
            'image' => $model->imageUrl(),
            'title' => $model->title,
            'link' => $model->link,
            'description' => $model->description,
            
        ];
    
    }
    public function getPaginatedQueryProperty()
    {
        return $this->query->paginate($this->paginate);
    }



    protected function actionsByRow()
    {
       if (request()->user() !== null && request()->user()->can('manage', Shop::class)) {
        return [
           new EditShopAction('shops.edit', __('translation.actions.edit')
        ),
            new SoftDeleteShopAction(),
            new RestoreShopAction(),
         

        ];
       } else {
        return [];
       }
    }

    protected function softDeleteNotificationDescription(Model $model)
    {
        return __('shops.messages.successes.destroy', [
            'title' => $model->title

        ]);
    }


    protected function restoreNotificationDescription(Model $model)
    {
        return __('shops.messages.successes.restore', [
            'title' => $model->title

        ]);
    }
    
}
