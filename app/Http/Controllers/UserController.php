<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function showAll()
    {
        return response()->json(User::all());
    }

    public function migrate()
    {
        Artisan::call('migrate:fresh --seed');
        return User::all();
    }
}