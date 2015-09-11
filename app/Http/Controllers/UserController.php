<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller {
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|max:255|unique:users',
        //     'password' => 'required|confirmed|min:6',
        //     'user_name' => 'required|max:60|unique:users',
        // ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user_name = $request->input('user_name');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json($user);
    }
}
