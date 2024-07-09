<?php

namespace App\Http\Livewire\Specializations;

use WireUi\Traits\Actions;
use App\Models\Specialization;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;


use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Specializations\Actions\EditSpecializationAction;
use App\Http\Livewire\Specializations\Actions\RestoreSpecializationAction;
use App\Http\Livewire\Specializations\Actions\SoftDeleteSpecializationAction;

class SpecializationsTableView extends TableView
{
    use Actions;
    /**
     * Sets a model class to get the initial data
     */
    protected $model = User::class;


    
    public $searchBy = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function repository():Builder
    {
        return Specialization::query()->withTrashed();
    }
    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('specializations.attributes.name'))->sortBy('name'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
            Header::title(__('translation.attributes.updated_at'))->sortBy('updated_at'),
            Header::title(__('translation.attributes.deleted_at'))->sortBy('deleted_at'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->name,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at,
        ];
    }

    // protected function filters(){
    //     return [
    //         new SoftDeleteFilter,
    //     ];
    // }

    protected function actionsByRow()
    {
        return [
            new EditSpecializationAction('specializations.edit', __('translation.actions.edit')),
            new SoftDeleteSpecializationAction(),
            new RestoreSpecializationAction(),
        ];
    }

    public function softDelete(int $id)
    {
        $specialization = Specialization::find($id);
        $specialization->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroy_title'),
            $description = __('specializations.messages.successes.destroy', [
                'name' => $specialization->name,
            ])
        );
    }

    public function restore(int $id)
    {
        $specialization = Specialization::withTrashed()->find($id);
        $specialization->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restore_title'),
            $description = __('specializations.messages.successes.restore', [
                'name' => $specialization->name,
            ]),
        );
    }
}
