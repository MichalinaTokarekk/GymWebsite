<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use App\Http\Livewire\Users\Actions\EditUserAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\Users\Filters\UsersRoleFilter;
use App\Http\Livewire\Users\Actions\RestoreUserAction;
use App\Http\Livewire\Users\Filters\EmailVerifiedFilter;
use App\Http\Livewire\Users\Actions\SoftDeleteUserAction;
use App\Http\Livewire\Users\Actions\AssignAdminRoleAction;
use App\Http\Livewire\Users\Actions\AssignDieticianRoleAction;
use App\Http\Livewire\Users\Actions\AssignPhysiotherapistRoleAction;
use App\Http\Livewire\Users\Actions\RemoveAdminRoleAction;
use App\Http\Livewire\Users\Actions\AssignWorkerRoleAction;
use App\Http\Livewire\Users\Actions\RemoveWorkerRoleAction;
use App\Http\Livewire\Users\Actions\AssignTrainerRoleAction;
use App\Http\Livewire\Users\Actions\RemoveDieticianRoleAction;
use App\Http\Livewire\Users\Actions\RemovePhysiotherapistRoleAction;
use App\Http\Livewire\Users\Actions\RemoveTrainerRoleAction;

class UsersTableView extends TableView
{
    use Actions;


    protected $model = User::class;

    public $searchBy = [
        'imie',
        'nazwisko',
        'email',
        'roles.name',
        'created_at',
        'deleted_at',
    ];

    protected $paginate = 10;

    public function repository(): Builder
    {
        return User::query()->withTrashed();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title(__('users.attributes.imie'))->sortBy('imie'),
            Header::title(__('users.attributes.nazwisko'))->sortBy('nazwisko'),
            Header::title(__('users.attributes.email'))->sortBy('email'),
            __('users.attributes.roles'),
            Header::title(__('translation.attributes.created_at'))->sortBy('created_at'),
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
            $model->imie,
            $model->nazwisko,
            $model->email,
            $model->roles->implode('name', ', '),
            $model->created_at,
            $model->deleted_at,
        ];
    }


    protected function filters()
    {
        return [
            new UsersRoleFilter,
            new EmailVerifiedFilter,
        ];
    }


    protected function actionsByRow()
    {
        return [
            new EditUserAction(
                'users.edit',
                __('translation.actions.edit')
            ),
            new SoftDeleteUserAction,
            new RestoreUserAction,
            new AssignAdminRoleAction,
            new RemoveAdminRoleAction,
            new AssignWorkerRoleAction,
            new RemoveWorkerRoleAction,
            new AssignTrainerRoleAction,
            new RemoveTrainerRoleAction,
            new AssignDieticianRoleAction,
            new RemoveDieticianRoleAction,
            new AssignPhysiotherapistRoleAction,
            new RemovePhysiotherapistRoleAction,
            
        ];
    }

    public function softDelete(int $id)
    {
        $user = User::find($id);
        $user->delete();
        $this->notification()->success(
            $title = __('translation.messages.successes.destroy_title'),
            $description = __('users.messages.successes.destroy', [
                'imie' => $user->imie,
                'nazwisko' => $user->nazwisko,
            ])
            );
    }

    public function restore(int $id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        $this->notification()->success(
            $title = __('translation.messages.successes.restore_title'),
            $description = __('users.messages.successes.restore', [
                'imie' => $user->imie,
                'nazwisko' => $user->nazwisko,
            ])
            );
    }

    public function assignAdminRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->assignRole('admin');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.admin_role_assigned',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }
    public function removeAdminRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->removeRole('admin');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.admin_role_removed',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }

    public function assignWorkerRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->assignRole('worker');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.worker_role_assigned',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }
    public function removeWorkerRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->removeRole('worker');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.worker_role_removed',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }

    public function assignTrainerRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->assignRole('trainer');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.trainer_role_assigned',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }
    public function removeTrainerRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->removeRole('trainer');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.trainer_role_removed',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }

    public function assignDieticianRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->assignRole('dietician');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.dietician_role_assigned',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }
    public function removeDieticianRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->removeRole('dietician');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.dietician_role_removed',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }

    public function assignPhysiotherapistRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->assignRole('physiotherapist');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.physiotherapist_role_assigned',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }
    public function removePhysiotherapistRole($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->removeRole('physiotherapist');
            $this->notification()->success(
                $title = __('translation.messages.successes.updated_title'),
                $description = __('users.messages.successes.physiotherapist_role_removed',
                [
                    'imie' => $user->imie,
                    'nazwisko' => $user->nazwisko,
                ]
                ));
        }
    }
}
