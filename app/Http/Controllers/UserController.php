<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function list(): Response
    {
        return Inertia::render('User', [
            'data' =>  User::paginate(15)
        ]);
    }
}
