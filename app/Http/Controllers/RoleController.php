<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleStoreOrUpdateRequest;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreOrUpdateRequest $request): JsonResponse
    {
        Role::create(['name' => $request->name]);
        return response()->json(['message' => 'created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): JsonResponse
    {
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleStoreOrUpdateRequest $request, Role $role): JsonResponse
    {
        $role->name = $request->name;
        $role->save();
        $role->fresh();
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();
        return response()->json(['message' => 'deleted']);
    }
}
