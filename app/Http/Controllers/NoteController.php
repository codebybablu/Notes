<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        // $notes = Note::all();
        $notes = auth()->user()->notes;
        if(!$notes) {
            return view('notes.index', ['message' => 'No notes found']);
        }
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->user_id = auth()->id();
        $note->save();

        return redirect()->route('notes');
    }

    public function show(Note $note, $id)
    {
        $note = Note::find($id);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note ,$id)
    {
        $note = Note::find($id);
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note, $id)
    {
        $note = Note::find($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return redirect()->route('notes');
    }

    public function destroy(Note $note, $id)
    {
        $note = Note::find($id);
        if($note){
            $note->delete();
        }
        return redirect()->route('notes');
    }
}
