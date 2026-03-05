<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index(Request $request)
    {
        $users = $this->service->getUsers($request->toArray());
        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        return new UserResource(User::create($request->validated()));
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->refresh();
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json();
    }
}
