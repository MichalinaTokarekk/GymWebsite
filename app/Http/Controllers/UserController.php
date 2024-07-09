<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Trainer;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\UpcomingEventNotification;

class UserController extends Controller
{
    

    public function indexTrainer()
    {
        $this->authorize('viewAny', Trainer::class);
        return view(
            'trainers.index'
        );
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view(
            'users.index',
            [
                'users' => User::withTrashed()->get()
            ]
            );
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view(
            'users.form'
        );
    }

   
    public function edit(User $user)
    {

        $this->authorize('update', $user);
        return view(
            'users.form',
            [
                'user' => $user
            ]
        );
    }

         
    public function show(User $user)
    {
       
        // $this->authorize('show', $user);
        return view(
            'users.show',
            [
                'user' => $user
            ]
        );
    }

    public function myCompetition(User $user)
    {
        //$this->authorize('show', $user);
        return view(
            'users.userCompetition',
            [
                'user' => $user
            ]
        );
    }

    public function conductedCompetition(User $user)
    {
        //$this->authorize('show', $user);
        return view(
            'users.trainerCompetition',
            [
                'user' => $user
            ]
        );
    }

    public function myEvents(User $user)
    {
        // $this->authorize('myEvents', $user);
        return view(
            'users.userEvents',
            [
                'user' => $user
            ]
        );
    }
    public function trainerEvents(User $user)
    {
        // $this->authorize('myEvents', $user);
        return view(
            'trainers.trainerEvents',
            [
                'user' => $user
            ]
        );
    }

    public function myTariffs(User $user)
    {
        // $this->authorize('myTariffs', $user);
        return view(
            'users.userTariffs',
            [
                'user' => $user
            ]
        );
    }


    public function getUpcomingEvents(Request $request)
    {
        $user = auth()->user();
        $cacheKey = 'upcoming_events_' . auth()->id();
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

            
        

        // return response()->json($upcomingEvents);

        
        Log::info('Przed wysłaniem e-maila');

        foreach ($upcomingEvents as $event) {
            $cacheKey = 'upcoming_events_' . auth()->id() . '_event_' . $event->id;
            if (!Cache::get($cacheKey)) {
                if (count($upcomingEvents) > 0) {
                    $emailData = [
                        'upcomingEvents' => $upcomingEvents,
                        'userName' => $user->name,
                    ];
            
                    Mail::send('emails.upcoming-events', $emailData, function ($message) use ($user) {
                        $message->to($user->email)
                            ->subject('Nadchodzące wydarzenia');
                    });

                    Cache::put($cacheKey, true, now()->addDays(1));
                }
            }
        }

        

        Log::info('Po wysłaniu e-maila');

        return response()->json($upcomingEvents);

    }
    


    

    public function async(Request $request)
    {
        // $this->authorize('viewAny', User::class);
        return User::query()
            ->select('id', 'imie', 'nazwisko')
            ->orderBy('nazwisko')
            ->when(
                $request->search,
                fn (Builder $query) 
                    => $query->where('nazwisko', 'like', "%{$request->search}%")
            )->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn(
                    'id',
                    $request->input('selected', []),
                ),
                fn (Builder $query) => $query->limit(30)
            )->whereHas('roles', function($q){$q->where('name','trainer');})
            ->get();
    }


   
  

}
