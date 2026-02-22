<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $idUser = session('user.id');
        $notes = User::find($idUser)
            ->notes()
            ->orderBy('created_at', 'desc')
            ->where('deleted_at', NULL)
            ->get()
            ->toArray();

        return view('home', array('notes' => $notes));
    }

    public function newNote()
    {
        return view('note_frm');
    }

    public function newNoteSubmit(Request $request)
    {
        $request->validate([
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:6|max:3000'
        ], [
            'text_title.required' => 'O Título é obrigatório',
            'text_title.min' => 'O Título deve ter no mínimo :min caracteres',
            'text_title.max' => 'O Título deve ter no máximo :max caracteres',
            'text_note.required' => 'A Nota é obrigatória',
            'text_note.min' => 'A Nota deve ter no mínimo :min caracteres',
            'text_note.max' => 'A Nota deve ter no máximo :max caracteres'
        ]);

        $title = $request->input('text_title');
        $note = $request->input('text_note');

        $idUser = session('user.id');

        Note::insert([
            'title' => $title,
            'text' => $note,
            'user_id' => $idUser,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/');
    }

    public function editNote($id)
    {
        $idDecrypt = Operations::decryptId($id);

        $note = Note::where('id', $idDecrypt)
            ->where('deleted_at', NULL)
            ->first();

        if (!$note) {
            return redirect('/');
        }

        return view('note_edit_frm', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request)
    {
        if (!$request->input('id')) {
            return redirect('/');
        }

        $idNote = Operations::decryptId($request->input('id'));

        $request->validate([
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:6|max:3000'
        ], [
            'text_title.required' => 'O Título é obrigatório',
            'text_title.min' => 'O Título deve ter no mínimo :min caracteres',
            'text_title.max' => 'O Título deve ter no máximo :max caracteres',
            'text_note.required' => 'A Nota é obrigatória',
            'text_note.min' => 'A Nota deve ter no mínimo :min caracteres',
            'text_note.max' => 'A Nota deve ter no máximo :max caracteres'
        ]);

        $title = $request->input('text_title');
        $text = $request->input('text_note');
        $idUser = session('user.id');

        $note = Note::where('id', $idNote)
            ->where('user_id', $idUser)
            ->where('deleted_at', NULL)
            ->first();

        if (!$note) {
            return redirect('/');
        }

        Note::where('id', $idNote)
            ->update([
                'title' => $title,
                'text' => $text
            ]);

        return redirect('/');
    }

    public function deleteNote($id)
    {
        $idNote = Operations::decryptId($id);

        $note = Note::find($idNote);

        if (!$note || $note->user_id != session('user.id')) {
            return redirect('/');
        }

        $note->delete();
        // $note->forceDelete();

        return redirect('/');
    }
}
