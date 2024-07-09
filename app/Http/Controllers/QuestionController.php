<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Status;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        // $question = Question::all();
        $questions = Question::orderBy('status_id', 'asc')->get();
        $groupedQuestions = $questions->groupBy('status.name'); 
        return view('question.index', ['groupedQuestions' => $groupedQuestions]);
    }
    

    public function create()
    {
        return view('question.create');
    }

    public function store(Request $request)
    {

        // Sprawdź, czy użytkownik jest zalogowany
        if (auth()->check()) {
            // Zapis nowego pytania do bazy danych
            $question = new Question();
            $question->head = $request->input('head');
            $question->questionContent = $request->input('questionContent');
            $question->user_id = auth()->user()->id; // Przypisz zalogowanego użytkownika do pytania
            $question->status_id = Status::where('name', 'OCZEKIWANE')->first()->id; // Zakładam, że masz model Status
            $question->save();

            return redirect()->route('question.index')->with('success', 'Pytanie zostało dodane.');
        } else {
            // Obsługa sytuacji, gdy użytkownik nie jest zalogowany
            return redirect()->route('login')->with('error', 'Musisz być zalogowany, aby dodać pytanie.');
        }
    }

    // Dodaj metody do wyświetlania pojedynczego pytania oraz do edycji i aktualizacji
    public function show(Question $question)
    {
        $statuses = Status::all();
        return view('question.show', ['question' => $question, 'statuses' => $statuses]);
    }

    public function edit(Question $question)
    {
        $statuses = Status::all();
        return view('question.edit', ['question' => $question, 'statuses' => $statuses]);
    }

    public function update(Request $request, Question $question)
    {
        // Walidacja danych z $request
        // Aktualizacja pytania w bazie danych
        $question->head = $request->input('head');
        $question->questionContent = $request->input('questionContent');
        $question->save();

        return redirect()->route('question.index')->with('success', 'Pytanie zostało zaktualizowane.');
    }

    // Dodaj metodę do usuwania pytania
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('question.index')->with('success', 'Pytanie zostało usunięte.');
    }

    public function myQuestions()
    {

        $questions = Question::orderBy('status_id', 'asc')->get();
        $groupedQuestions = $questions->groupBy('status.name'); 
        $myQuestions = Question::where('user_id', auth()->user()->id)->get();

        return view('question.index', ['question' => $myQuestions, 'groupedQuestions' => $groupedQuestions]);
    }

    public function updateStatus(Request $request, Question $question)
    {
        // Przetworzenie danych z formularza i aktualizacja statusu pytania
        $newStatusId = $request->input('status_id');
        $question->status_id = $newStatusId;
        $question->save();
    
        return redirect()->route('question.show', $question)->with('success', 'Status pytania został zaktualizowany.');
    }
    

    

}
