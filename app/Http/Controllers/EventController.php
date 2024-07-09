<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Tariff;
use App\Models\TariffUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelViews\Views\View;

class EventController extends Controller
{
    public function create()
    {
        $this->authorize('create', Event::class);
        return view(
            'events.form'
        );
    }

   
    public function edit(Event $event)
    {
        
        $this->authorize('update', $event);
        return view(
            'events.form',
            [
                'event' => $event
            ]
        );
    }

    public function show(Event $event)
    {
        // date_default_timezone_set('Europe/warsaw');
        // dd(date_default_timezone_get());      
        $currentDate = Carbon::now('Europe/warsaw');
        if($currentDate < $event->start){
            $event->update(['status' => 0]);
        }elseif($currentDate >= $event->start && $currentDate <= $event->end){
            $event->update(['status' => 1]);
        }elseif($currentDate > $event->end){
            $event->update(['status' => 2]);
        };

        return view(
            'events.show',
            [
                'event' => $event,
                'user' => User::find($event->trainer_id), //kto prowadzi zajecia trener 

            ],
            
            
        );
    }

    public function trainerShow(Event $event)
    {
        // date_default_timezone_set('Europe/warsaw');
        // dd(date_default_timezone_get());      
        $currentDate = Carbon::now('Europe/warsaw');
        if($currentDate < $event->start){
            $event->update(['status' => 0]);
        }elseif($currentDate >= $event->start && $currentDate <= $event->end){
            $event->update(['status' => 1]);
        }elseif($currentDate > $event->end){
            $event->update(['status' => 2]);
        };
        return view(
            'events.show',
            [
                'event' => $event,
                'user' => User::find($event->trainer_id), //kto prowadzi zajecia trener 
                'tariff' => Tariff::find($event->tariff_id),

            ],
            
            
        );
    }

    public function sign(Event $model)
    { 
        $this->authorize('sign', $model);
        $user = Auth::user();

        //Zapiosanie uzytkownika oraz zwiekszenie wartosci "current_participants" o 1
        if($model->current_participants < $model->max_participants){
            $currentParticipantsValue = $model->current_participants + 1;
            $model->update(['current_participants' => $currentParticipantsValue]); //Aktualizacja kolumny 'current_participants'
            $user->events()->syncWithoutDetaching($model);
            return redirect()->route('events.myEvents', $user);
        }
    }

    // public function delete(Event $model)
    // {
    //     // dd($model);
    //     $this->authorize('delete', Auth::user(), Event::class);
    //     Event::find($model->id)->delete();
    //     return redirect()->route('calendar');
    // }

    public function users(Event $event)
    {
        // $this->authorize('manage', Event::class);
        // $users = $event->users()->get();

        // return view('events.users', [
        //     'event' => $event,
        //     'users' => $users
        // ]);
        return view('events.event-users',
        [
            'event' => $event
        ]);
    }

    // public function removeUser(Event $event, User $user)
    // {
    //     dd($user,$event);
    //     $this->authorize('manage', Event::class);
    //     $event->users()->detach($user);

    //     $currentParticipantsValue = $event->current_participants - 1;
    //     $event->update(['current_participants' => $currentParticipantsValue]); //Aktualizacja kolumny 'current_participants'

    //     return redirect()->back()->with('success', 'Użytkownik został wypisany z zajęcia.');
    // }
    


    public function getUpcomingEvents(Request $request)
        {
            $currentDate = now(); // Aktualna data i godzina
            $tomorrow = $currentDate->addDay()->startOfDay(); // Początek jutra
            $dayAfterTomorrow = $tomorrow->copy()->addDay(); // Początek po jutrze
        
            $user = auth()->user();
            $upcomingEvents = Event::where('start', '>=', $tomorrow)
                ->where('end', '<', $dayAfterTomorrow)
                ->whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        
            // Zwróć nadchodzące wydarzenia w formie JSON
            return response()->json($upcomingEvents);
        }
    }
