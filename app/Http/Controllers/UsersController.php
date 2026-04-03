<?php

namespace App\Http\Controllers;

use App\Enums\PaginationEnum;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Services\ImageService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(PaginationEnum::PAGE_SIZE->value);

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection($users),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(UserCreateRequest $request, ImageService $imageService)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        if ($request->hasFile('avatar')) {
            $imageService->upload($request, 'users/' . $user->id);
        }

        $request->session()->flash('user_created', [
            'message' => 'User created successfully',
            'class' => 'alert-success'
        ]);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $user->load('userTask');

        return Inertia::render('Users/View', [
            'user' => new UserResource($user),
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Create', [
            'user' => new UserResource($user),
            'edit' => true
        ]);
    }

    public function update(UserUpdateRequest $request, User $user, ImageService $imageService)
    {
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $imageService->upload($request, 'users/' . $user->id);
            $validated['avatar'] = $avatarPath;
        }

        $user->update($validated);

        $request->session()->flash('user_updated', [
            'message' => 'User updated successfully',
            'class' => 'alert-success'
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(string $id)
    {
        //
    }

    public function profile()
    {
        $user = auth()->user();

        return Inertia::render('Profile/Profile', [
            'user' => new UserResource($user)
        ]);
    }


    public function logout()
    {
        \Auth::logout();
    }
}
