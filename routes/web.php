<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Livewire\Updates\ShowUpdate;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\TariffController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\SpecializationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('updates.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('updates.index');
    })->name('dashboard');

});


Route::name('users.')->prefix('users')->group(function(){
    Route::get('', [UserController::class, 'index'])
            ->name('index')
            ->middleware(['permission:users.index']);
});

Route::resource('users', UserController::class)->only([
    'index','indexTrainer', 'create', 'edit', 'show'
]);

Route::resource('trainers', TrainerController::class)->only([
    'index', 'create', 'edit', 'show'
]);

Route::resource('updates', UpdateController::class)->only([
    'index', 'create', 'edit', 'show',
]);

Route::resource('categories', CategoryController::class)->only([
    'index', 'create', 'edit'
]);



Route::get('async/categories', [CategoryController::class, 'async'])
        ->name('async.categories');

         
Route::resource('competitions', CompetitionController::class)->only([
    'index', 'create', 'edit', 'show'
]);

Route::get('/competitions/record/{model}', [CompetitionController::class, 'record', 'model'])->name('competitions.record');

Route::get('/competitions/my/{user}', [UserController::class, 'myCompetition', 'user'])->name('competitions.myCompetition');

Route::get('/competitions/conducted/{user}', [UserController::class, 'conductedCompetition', 'user'])->name('competitions.conductedCompetition');

Route::get('async/trainers', [UserController::class, 'async']) ->name('async.trainers');

Route::resource('activities', ActivityController::class)->only([
    'index', 'create', 'edit', 'show'
]);

Route::get('async/activities', [ActivityController::class, 'async'])
        ->name('async.activities');


Route::resource('specializations', SpecializationController::class)->only([
    'index', 'create', 'edit'
]);

Route::get('async/specializations', [SpecializationController::class, 'async'])->name('async.specializations');

Route::resource('shops', ShopController::class)->only([
    'index', 'create', 'edit'
]);

Route::resource('tariffs', TariffController::class)->only([
    'index', 'create', 'edit'
]);

Route::get('/tariffs/my/{user}', [UserController::class, 'myTariffs', 'user'])->name('myTariffs.myTariffs');

Route::get('full-calender', [FullCalenderController::class, 'index'])-> name('calendar');
Route::post('full-calender/action', [FullCalenderController::class, 'action']);

Route::resource('events', EventController::class)->only([
     'create', 'edit', 'show', 'delete'
]);

Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::get('branch', [BranchController::class, 'index'])->name('branches.index');

Route::resource('films', FilmController::class)->only([
    'index','create', 'edit', 'show', 'delete'
]);
Route::get('films/{file_name}/download', [FilmController::class, 'download'])->name('film.download');

Route::get('/events/sign/{model}', [EventController::class, 'sign', 'model'])->name('events.sign');
Route::get('/events/decline/{model}', [EventController::class, 'decline', 'model'])->name('events.decline');
Route::get('/events/my/{user}', [UserController::class, 'myEvents', 'user'])->name('events.myEvents');
Route::get('/events/trainer/{user}', [UserController::class, 'trainerEvents', 'user'])->name('events.trainerEvents');
Route::get('/events/trainer/show/{event}', [EventController::class, 'trainerShow', 'event'])->name('events.trainerShow');
Route::get('/events/delete/{model}', [EventController::class, 'delete', 'model'])->name('events.delete');
Route::get('/events/{event}/users', [EventController::class, 'users'])->name('events.users');
Route::delete('/events/{event}/users/{user}', [EventController::class, 'removeUser'])
    ->name('events.removeUser');

Route::get('file/{file_name}', [FilmController::class, 'getFile'])->name('film.get');


Route::resource('question', QuestionController::class)->only([
    'index', 'create', 'edit', 'show', 'update', 'destroy'
]);

Route::get('/myQuestions', [QuestionController::class, 'myQuestions'])->name('myQuestions');



Route::post('/question', [QuestionController::class, 'store'])->name('question.store');
// Route::get('/question/{question}', [QuestionController::class, 'show'])->name('question.show');

Route::resource('answer', AnswerController::class)->only([
    'index', 'create', 'edit', 'show', 'update', 'destroy'
]);

Route::post('/answer', [AnswerController::class, 'store'])->name('answer.store');

Route::put('/questions/{question}/updateStatus', [QuestionController::class, 'updateStatus'])->name('question.updateStatus');

Route::get('/get-upcoming-events', [UserController::class, 'getUpcomingEvents']);

Route::get('elements', [ElementController::class, 'index'])->name('elements.index');


Route::resource('branches', BranchController::class)->only([
    'index','create', 'edit', 'delete'
]);

Route::get('async/elements', [ElementController::class, 'async'])->name('async.elements');
Route::get('/competitions/participants/{id}', [CompetitionController::class, 'participants'])
    ->name('competitions.participants');




