<?php

use Illuminate\Database\Seeder;
use App\Note;
class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::create([
           'title'=>"Моя заметка",
           'description'=>"Описание заметки"
        ]);
    }
}
