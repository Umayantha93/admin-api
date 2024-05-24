<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserControler extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')
            + ['password' => Hash::make(1234)]
        );

        return response($user, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        return User::find($id);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy(string $id)
    {
        return User::destroy($id);
    }
}
