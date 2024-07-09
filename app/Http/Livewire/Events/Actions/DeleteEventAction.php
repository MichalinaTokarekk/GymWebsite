<?php

namespace App\Http\Livewire\Events\Actions;

use App\Models\Event;
use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;
use LaravelViews\Actions\Confirmable;

class DeleteEventAction extends Action
{
    use Confirmable;
    public $title = '';
    public $icon = 'trash';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('translation.actions.destroy');
    }

    public function getConfirmationMessage($model)
    {
        return 'Czy na pewno chcesz usunąć wydarzenie '.$model->title.' ???';
    }

    public function handle($model, View $view)
    {
        Event::find($model->id)->delete();
        return redirect()->route('calendar');
    }

    public function renderIf($model, View $view)
    {
        return true;
    }

   

}
