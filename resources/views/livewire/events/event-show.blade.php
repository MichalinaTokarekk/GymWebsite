<x-lv-layout>
   <x-slot name='header'>
        <h2 class="text-x1 font-semibold leading-tight text-center text-5xl" style="color:rgb(119, 57, 39); font-family:cursive">
            {{__('translation.navigation.events')}}
        </h2>
    </x-slot>
    <div class="py-12" style="background-image: url('/storage/tlo.png');" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg" w-full id="table-view-wrapper" style="padding:2cm;  background-color: #ded6dc">
                <div class="grid justify-items-stretch pt-2 pr-2 w-full">
                    <div class="card card-border card-compact lg:card-normal w-full">
                        <x-button primary
                            label="{{ __('translation.back') }}"
                            href="javascript:history.go(-1)"
                            class="justify-self-start pt-2 ml-3 bg-blue-600" 
                            style="background-color: rgb(39, 67, 119)"/>
                        <div class="grid justify-items-stretch pt-2 pr-2">
                            {{-- Przycisk edycji --}}
                            {{-- @can('update', Auth::user(), App\Models\Event::class) --}}
                            @can('update', $model)
                                @if ($user && $user->id === auth()->id() || auth()->user()->hasRole('admin')) 
                                    <x-button primary
                                        label="{{ __('events.actions.edit') }}"
                                        href="{{ route('events.edit',[$model->id]) }}"
                                        class="justify-self-end mb-2"
                                        style="background-color: rgb(119, 57, 39)"
                                    />
                                @endif
                            @endcan
    
                            @can('delete', $model)
                                @if ($user && $user->id === auth()->id() || auth()->user()->hasRole('admin'))
                                    <x-button primary
                                        label="Usuń wydarzenie"
                                        class="justify-self-end mb-2"
                                        style="background-color: rgb(208, 125, 16)"
                                        {{-- wire:click="deleteEventAction" --}}
                                        wire:click.prevent="executeAction('delete-event-action', {{$model->id}})"
                                    />
                                @endif
                         
                             
                            @endcan
                            @can('manage', App\Models\Event::class)
                                <x-button primary
                                    label="Lista użytkowników"
                                    href="{{ route('events.users', $model->id) }}"
                                    class="justify-self-end bg-red-600"
                                />
                            @endcan

                            <div class="card-body mt-4 ">
                                {{-- Tytuł --}}
                                <h2 class="card-title font-bold text-2xl pb-3 text-blue-600 text-center ">
                                    {{ $model->title}}
                                </h2>
                                <br/>
                                {{-- Opis --}}
                                <p class="text-black text-center font-semibold text-2xl">
                                    {{ $model->description}}
                                </p>
                                <br/>
                                {{-- Liczba uczestników --}}
                                <p class="text-black text-center font-semibold text-2xl">
                                    Uczestnicy: {{ $model->current_participants}}/{{ $model->max_participants}}
                                </p>
                                <br/>
                                {{-- Status zajęć --}}
                                <p class="text-black text-center font-semibold text-2xl">
                                    Status:
                                    @if( $model->status === 0)
                                        Zarejestrowane
                                    @endif
                                    @if( $model->status === 1)
                                        W trakcie
                                    @endif
                                    @if( $model->status === 2)
                                        Zakończone
                                    @endif
                                </p>
                                <br/>
                        </div>
                        <div class="card-body mt-4 ">
                            {{-- Jeśli zajęcia trwają w ten sam dzień --}}
                            @if(substr($model->start,0,10) === substr($model->end,0,10))
                                <p class="text-black text-center font-semibold text-2xl">
                                   {{ substr($model->start,8,2)}}-{{ substr($model->start,5,2)}}-{{ substr($model->start,0,4)}}
                                </p>
                                <p class="text-black text-center font-semibold text-2xl">
                                    Start:  {{ substr($model->start,11,5)}}
                                    <br/>
                                    Koniec: {{ substr($model->end,11,5)}}
                                </p>
                            {{-- Jeśli zajęcia są w 2ch dniach  --}}
                            @else
                                {{-- Data/czas start --}}
                                <p class="text-black text-center font-semibold text-2xl">
                                    Start: {{ substr($model->start,8,2)}}-{{ substr($model->start,5,2)}}-{{ substr($model->start,0,4)}} {{ substr($model->start,11,5)}}
                                </p>
                                {{-- Data/czas koniec --}}
                                <p class="text-black text-center font-semibold text-2xl">
                                    Koniec: {{ substr($model->end,8,2)}}-{{ substr($model->end,5,2)}}-{{ substr($model->end,0,4)}} {{ substr($model->end,11,5)}}
                                </p>
                            @endif
                            <br/>
                            {{-- Trener --}}
                            <p class="text-black text-center font-semibold text-2xl">
                                {{__('Trener prowadzacy:')}} {{$user->imie}} {{$user->nazwisko}}
                            </p>
                            <br/>
                        </div>
                      
                        <div class="grid justify-items-stretch pt-2 pr-2">
                            {{-- Przycisk zapisania się na zajęcia --}}
                       
                            @if($model->status === 0)
                                @if( Auth::user())
                                    @cannot('canAttaching', $model)
                                        <x-button primary 
                                            label="Wypisz się" 
                                            {{-- href="{{ route('events.decline',$model) }}"   --}}
                                            class="justify-self-center bg-red-600"
                                            style="color: black; font-weight: bold;"
                                            wire:click.prevent="executeAction('sign-off-from-event-detail-action', {{$model->id}})"
                                            
                                        />
                                        
                                    @else
                                        <p style="font-weight: bold; color: red; text-align: center;">Aby zapisać się na zajęcia musisz mieć wykupiony karnet na zajęcia grupowe!</p>
                                        @if($model->current_participants < $model->max_participants &&
                                            Auth::check() && Auth::user()->hasTariff('Karnet na zajęcia grupowe') 
                                            && Auth::user()->isTariffActive('Karnet na zajęcia grupowe')
                                            && Auth::user()->isOnlyUser())
                                                <x-button primary
                                                    label="{{ __('events.actions.sign') }}"
                                                    href="{{ route('events.sign',[$model]) }}"
                                                    class="justify-self-center bg-green-600"
                                                />
                                        @endif
                                    @endcannot
                                @else
                                    @auth
                                        <x-button primary 
                                            label="{{ __('events.actions.sign') }}"
                                            href="{{ route('login') }}"
                                            class="justify-self-center bg-green-600"
                                        />
                                    @endauth
                                @endif
                            @endif
        
                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-lv-layout>