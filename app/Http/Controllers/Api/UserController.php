<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NoteResources;
use App\Http\Resources\UserDetailsResources;
use App\Note;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function details()
    {
        $user=User::find([Auth::id()]);
        return (new UserDetailsResources($user))->response();
    }

}
