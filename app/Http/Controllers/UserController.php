<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Registering the New User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $validateUser = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:12|min:8',
        ]);

        /*
        |   Creating user with Hashing the password and store in database.
        */

        $validateUser['password'] = Hash::make($validateUser['password']);
        $user = User::create($validateUser);
        return response()->json([
            'message' => "user created successfully",
            'user' => $user,
        ], 201);

        /*
        |   Creating user without the Hashing the password
        */
        // $user = User::create($validateUser);
        // return response()->json([
        //     'message' => "user created successfully",
        //     'user' => $user,
        // ], 201);
    }

    /**
     * User Login
     * --------------------------------
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request) {
        $validateUser = $request->validate([
            'email' =>'required|email',
            'password' => 'required|max:12|min:8',
        ]);
        $user = User::where('email', $validateUser['email'])->first();

        if ($user && Hash::check($validateUser['password'], $user->password)) {
            $bearerToken = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'access_token' => $bearerToken,
                'token_type' => 'Bearer',
            ]);
        }
        return response()->json([
            'message' => 'Invalid Credentials',
        ], 401);

        /*
        |    Login the user with email and password and then generating the token for the user.
        */

        // if ($user && $password) {
        //     $bearerToken = $user->createToken('auth-token')->plainTextToken;
        //     return response()->json([
        //         'access_token' => $bearerToken,
        //         'token_type' => 'Bearer',
        //     ]);
        // }
        // return response()->json([
        //     'message' => 'Invalid Credentials',
        // ], 401);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
