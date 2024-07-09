<?php

namespace App\Http\Livewire\Films;

use App\Models\Film;
use Livewire\Component;
use App\Rules\VideoFile;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FilmForm extends Component
{
    use Actions;
    use AuthorizesRequests;
    use WithFileUploads;


    public Film $film;
    public Bool $editMode;
    public $video;

    public $videoExists;
    public $videoUrl;


    public function rules()
    {
        return [
            'film.title' => [
                'required',
                'string',
                'min:1',
                'max:100',
            ],
            'film.description' => [
                'required',
                'min: 10',
            ],
            
            'film.video' => [
                'nullable',
                // new VideoFile,
                'max: 1000000000'
            ],
            
    
        ];
    }

    public function validationAttributes()
    {
        return[

         
            'title' => Str::lower(__('shops.attributes.title')),
            'description' => Str::lower(__('shops.attributes.description')),
            'video' => Str::lower(__('shops.attributes.video')),
    
            


        ];
    }

    public function mount(Film $film, Bool $editMode)
    {
        $this->film = $film;
        $this->editMode = $editMode;
        $this->videoChange();
    }

    public function render()
    {
        return view('livewire.films.film-form');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->videoChange();
    }


    public function save()
    {
        if ($this->editMode) {
            $this->authorize('update', $this->film);
        } else {
            $this->authorize('create', Film::class);
        }
    
        $this->validate();
    
        $film = $this->film;
        $video = $this->video; // Pobranie przesłanego pliku wideo
    
        DB::transaction(function () use ($film, $video) {
            $film->save();
    
            if ($video !== null) {
                $videoFileName = $film->id . '.' . $video->getClientOriginalExtension(); // Nazwa pliku wideo
                $video->storeAs('', $videoFileName, 'public'); // Zapis pliku wideo w katalogu public/storage
                $film->video = $videoFileName; // Przypisanie nazwy pliku do modelu Film
                $film->save();
            }
        });
    
        $this->notification()->success(
            $title = $this->editMode
                ? __('translation.messages.successes.updated_title')
                : __('translation.messages.successes.stored_title'),
            $description = $this->editMode
                ? __('films.messages.successes.updated', ['title' => $this->film->title])
                : __('films.messages.successes.stored', ['title' => $this->film->title])
        );
    
        $this->editMode = true;
    
    }



    public function deleteVideoConfirm()
    {
        $this->dialog()->confirm([
            'title' => __('films.dialogs.film_delete.title'),
            'description' => __('films.dialogs.film_delete.description', [
                'title' => $this->film->title
            ]),
            'icon' => 'question',
            'iconColor' => 'text-red-500',
            'accept' => [
                'label' => __('translation.yes'),
                'method' => 'deleteVideo',
            ],
            'reject' => [
                'label' => __('translation.no'),
            ]
        ]);
    }

    public function deleteVideo()
    {
        if (Storage::disk('public')->delete($this->film->video)) {
            $this->film->video = null;
            $this->film->save();
            $this->videoChange(); // Update this line to call the correct method
            $this->notification()->success(
                $title = __('translation.messages.successes.destroy_title'),
                $description = __('films.messages.successes.film_deleted', [
                    'title' => $this->film->title
                ])
            );
    
            return;
        }
    
        $this->notification()->error(
            $title = __('translation.messages.errors.destroy_title'),
            $description = __('films.messages.errors.image_deleted', [
                'title' => $this->film->title
            ])
        );
    }

    protected function videoChange()
    {
        $this->videoExists = $this->film->videoExists();
        $this->videoUrl = $this->film->videoUrl();

    }

}
