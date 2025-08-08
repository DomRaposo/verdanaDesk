<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;


use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;


    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json($this->userService->getAllUsers());
    }

    public function store(\App\Http\Requests\User\StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return response()->json(['message'=> 'Create with success' , 'user' => $user], 201);
    }
    public function show($id)
    {
        $users = User::All();
        return response()->json($this->userService->getUser($id));
    }

    public function update(Request $request,$id)
    {
        $user = $this->userService->updateUser($id, $request->all());
        return response()->json($user);
    }
    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return response()->json(['message'=> 'Deleted']);
    }
}
