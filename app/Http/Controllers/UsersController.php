<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        return 1;
    }
    public function create()
    {
        return view('users.create');
    }

    public function store(User $user)
    {

    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


}
