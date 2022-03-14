<?php

namespace App\Http\Controllers;

use App\Models\LessonUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
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
        return response()->json(User::with('courses')->get());
    }

    public function migrate()
    {
        Artisan::call('migrate:fresh --seed');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'string',
            'password' => 'required|string',
        ]);
        return response()->json(User::create($request->all()));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'email' => 'string',
            'first_name' => 'string',
            'last_name' => 'string',
            'phone' => 'string',
            'password' => 'string',
        ]);
        $user->update($request->all());
        $user->save();
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['Пользователь удалён']);
    }

    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
