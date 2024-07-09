<?php

namespace App\Http\Livewire\Competitions;

use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Competition;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CompetitionSignForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public User $user;
    public Bool $editMode;
    public Competition $model;


    public function rules()
    {
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
        ];
    }

    public function repository():Builder
    {

        $query = Competition::query()
                ->with(['categories', 'user']);
            return $query;
    }

    public function validationAttributes()
    {
        return[
            'imie' => Str::lower(__('users.attributes.imie')),
            'nazwisko' => Str::lower(__('users.attributes.nazwisko')),
            'email' => Str::lower(__('users.attributes.email')),
        ];
    }

    public function mount(User $user, Bool $editMode, Competition $model)
    {
        $this->user = $user;
        $this->editMode = $editMode;
        $this->model = $model;  // to do zapisu
    }

    public function render()
    {
        return view('livewire.competitions.competition-sign-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // public function zapis(Competition $competition)
    // {
    //     //dd($course);
    //     $user = Auth::user();
    //     $user->competitions()->syncWithoutDetaching($competition);
    // }




    public function save() {
        $this->user->competitions()->syncWithoutDetaching($this->model);
        return redirect()->route('competitions.myCompetition',[$this->user]);
    }

}
