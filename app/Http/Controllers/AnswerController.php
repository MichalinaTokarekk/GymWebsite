<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function index()
    {
        $answer = Answer::all();
        return view('answer.index', ['answer' => $answer]);
    }
    

    public function create()
    {
        return view('answer.create');
    }

    public function store(Request $request)
{
    // Sprawdź, czy użytkownik jest zalogowany
    if (auth()->check()) {
        // Odbierz dane z formularza
        $comment = $request->input('comment');
        $questionId = $request->input('question_id');
        
        // Zapisz nową odpowiedź do bazy danych
        $answer = new Answer();
        $answer->comment = $comment;
        $answer->user_id = auth()->user()->id;
        $answer->question_id = $questionId;
        $answer->save();

        // Przekieruj użytkownika z powrotem na stronę pytania po dodaniu odpowiedzi
        return redirect()->route('question.show', ['question' => $questionId])->with('success', 'Odpowiedź została dodana.');
    } else {
        // Obsługa sytuacji, gdy użytkownik nie jest zalogowany
        return redirect()->route('login')->with('error', 'Musisz być zalogowany, aby dodać odpowiedź.');
    }
}

    // Dodaj metody do wyświetlania pojedynczego pytania oraz do edycji i aktualizacji
    public function show(Answer $answer)
    {
        return view('question.show', ['question' => $answer]);
    }

    public function edit(Answer $answer)
    {
        return view('questions.edit', ['question' => $answer]);
    }

    public function update(Request $request, Answer $answer)
    {
        // Walidacja danych z $request
        // Aktualizacja pytania w bazie danych
        $answer->head = $request->input('head');
        $answer->questionContent = $request->input('questionContent');
        $answer->save();

        return redirect()->route('answer.index')->with('success', 'Odpowiedź została zaktualizowana.');
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect()->route('answer.index')->with('success', 'Odpowiedź została usunięta.');
    }
}
