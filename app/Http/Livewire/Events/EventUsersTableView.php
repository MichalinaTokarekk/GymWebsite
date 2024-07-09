<?php

namespace App\Http\Livewire\Events;

use App\Models\User;
use WireUi\Traits\Actions;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Livewire\Events\Actions\SignOffUserFromEventAction;


class EventUsersTableView extends TableView
{
    use Actions;
    protected $model = User::class;
    public $event;
    public $searchBy = [
        'imie',
        'nazwisko',
        'email',
    ];

    protected $paginate = 20;

    public function repository(): Builder
    {
        $eventId= $this->event->id;
        $userIds=User::whereHas('events', function ($query) use ($eventId) {
            $query->where('events.id', $eventId);
        })->pluck('id')
            ->toArray();
        $query = User::query()->whereIn('id', $userIds);
        return $query;
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
        ];
    }


    protected function filters()
    {
        return [

        ];
    }


    protected function actionsByRow()
    {
        return [
            new SignOffUserFromEventAction,
        ];
    }

    public function removeUser(User $user)
    {
        $event = $this->event;
        $event->users()->detach($user);

        $currentParticipantsValue = $event->current_participants - 1;
        $event->update(['current_participants' => $currentParticipantsValue]); //Aktualizacja kolumny 'current_participants'

        return redirect()->back()->with('success', 'Użytkownik został wypisany z zajęcia.');
    }

}
