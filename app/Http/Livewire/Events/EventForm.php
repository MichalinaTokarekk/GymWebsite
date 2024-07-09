<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use App\Models\Activity;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventForm extends Component
{   
    use Actions;
    use AuthorizesRequests;
    
    public Event $event;
    public Bool $editMode;

    public function rules()
    {
        return [
            // 'event.title' => [
            //     'required',
            //     'string',
            //     'min:2' . 
            //         ($this->editMode ? (',' . $this->event->id) : '')
            // ],
            'event.description' => [
                'nullable',
                'string',
            ],
            'event.date_start' => [
                'required',
                'date',

            ],
            'event.time_start' => [
                'required',
                'date_format:"H:i"',

            ],
            'event.date_end' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $startDate= $this->event->date_start;
                    $endDate = $value;
                    if (strtotime($endDate) < strtotime($startDate)) {
                        $fail(__('validation.after_or_equal', ['attribute' => __('events.attributes.date_end'), 'date' => __('events.attributes.date_start')]));
                    }
                },
                
            ],
            'event.time_end' => [
                'required',
                'date_format:"H:i"',
                function ($attribute, $value, $fail) {
                    $startDateTime = $this->event->date_start . ' ' . $this->event->time_start;
                    $endDateTime = $this->event->date_end . ' ' . $value;
    
                    if($this->event->date_start === $this->event->date_end)
                        if($value <= $this->event->time_start)
                            $fail(__('validation.after_or_equal_time', ['attribute' => __('events.attributes.time_end'), 'time' => __('events.attributes.time_start')]));
                },

            ],
            'event.trainer_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'event.activity_id' => [
                'required',
                'integer',
                'exists:activities,id'
            ],
            'event.max_participants' =>[
                'required',
                'integer',
                'gt:0', //Wieksze o 5 - minimum max 5 osob na zajeciach
                function ($attribute, $value, $fail) {
                    if($value < $this->event->current_participants)
                        $fail(__('validation.min.numeric', ['attribute' => __('events.attributes.max_participants'), 'min' => __('events.attributes.current_participants'), 'count' => $this->event->current_participants]));
                },
            ],
        ];
    }

    public function validationAttributes()
    {
        return [
            // 'title' => Str::lower(__('events.attributes.title')),
            'description' => Str::lower(__('events.attributes.description')),
            'date_start' => Str::lower(__('events.attributes.date_start')),
            'time_start' => Str::lower(__('events.attributes.time_start')),
            'date_end' => Str::lower(__('events.attributes.date_end')),
            'time_end' => Str::lower(__('events.attributes.time_end')),
            'trainer' => Str::lower(__('events.attributes.trainer')),
            'activity' => Str::lower(__('events.attributes.title')),
            'max_participants' => Str::lower(__('events.attributes.max_participants'))
        ];
    }

    public $trainersForSelect;
    public function mount(Event $event, Bool $editMode)
    {
        $this->event = $event;
        if($editMode){
            $this->event->date_start = substr($event->start,0,10);
            $this->event->time_start = substr($event->start,11,5);
            $this->event->date_end = substr($event->end,0,10);
            $this->event->time_end = substr($event->end,11,5);
        }
        $this->editMode = $editMode;
        $this->trainersForSelect = $this->getTrainersForSelect();

    }

    
    public function getTrainersForSelect()
    {
        $role = Role::where('name', 'trainer')->first();

        if (!$role) {
            return [];
        }
        $trainers = $role->users;
        $formattedTrainers = $trainers->map(function ($trainer) {
            return [
                'id' => $trainer->id,
                'label' => $trainer->imie . ' ' . $trainer->nazwisko,
            ];
        })->toArray();
        return $formattedTrainers;
    }


    public function render()
    {
        return view('livewire.events.event-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function save()
    {
        if ($this->editMode){
            $this->authorize('update', $this->event);
        } else {
            $this->authorize('create', Event::class);
        }
        $this->validate();
        $activity = Activity::find($this->event->activity_id);
        if($activity)
            $this->event->title =  $activity->name;
        else
            $this->event->title = "NO_NAME";
        $date_start = $this->event->date_start.' '.$this->event->time_start;
        $date_end = $this->event->date_end.' '.$this->event->time_end;
        unset(
            $this->event->date_start,
            $this->event->time_start,
            $this->event->date_end,
            $this->event->time_end,
        );
        $this->event->start =  $date_start;
        $this->event->end =  $date_end;
        $this->event->save();


        $this->notification()->success(
            $title = $this->editMode
            ? __('translation.messages.successes.updated_title')
            : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
            ? __('activities.messages.successes.updated', ['name' => $this->event->name])
            : __('activities.messages.successes.stored', ['name' => $this->event->name])

        );
        return  redirect()->route('calendar');
    }
}

