<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NoteResource;
use App\Http\Resources\NoteResources;
use App\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function index()
    {
        return (new NoteResources(Note::all()))->response();
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'string|required',
        ]);

        $note = Note::create($request->all() + ['user_id' => (integer)Auth::id()]);

        return (new NoteResource($note))->additional(['message' => 'created note id ' . $note->id]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'title' => 'max:255',
            'description' => 'string',
            'note_id' => 'exists:notes,id',
        ]);


        $note = Note::find([$request->note_id])->first();
        $note->update($request->except('note_id'));

        return (new NoteResource($note))->additional(['message' => 'note id ' . $note->id]);
    }



}
