<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{

    public function index()
    {
        return RoleResource::collection(Role::paginate());
    }

    public function store(Request $request)
    {
        $role = Role::create($request->only('name'));

        $role->permissions()->attach($request->input('permissions'));

        return response(new RoleResource($role->load('permissions')), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new RoleResource(Role::with('permissions')->find($id));
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        $role->update($request->only('name'));

        $role->permissions()->sync($request->input('permissions'));

        return response(new RoleResource($role->load('permissions')), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
