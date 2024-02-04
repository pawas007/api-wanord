<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(User::query()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $this->authorize('createOrUpdate', User::class);
        $user = new User();
        $user->fill($request->validated());
        $user->save();
        return response()->json(['message' => 'created', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {

        $this->authorize('createOrUpdate', User::class);
        $user->update($request->validated());
        return response()->json(['message' => 'updated', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', User::class);
        $user->delete();
        return response()->json(['message' => 'deleted']);
    }
}
