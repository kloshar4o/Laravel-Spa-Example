<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Models\User\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function index()
    {
        $users = User::paginate(10);

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function store(UserCreateRequest $request, User $user)
    {
        $attributes = $request->all();
        $user->fill($attributes);
        return response(tap($user)->save());
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $user->load('company');
        return response($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        $attributes = $request->toArray();

        $password = $attributes['password'] ?? null;

        if ($password)
            $attributes['password'] = bcrypt($password);

        $user = tap($user)->update($attributes);
        $user->load('company');
        return response($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return UserCollection
     * @throws Exception
     */
    public function destroy(User $user)
    {

        $user->delete();
        $users = User::paginate(10);
        return new UserCollection($users);
    }
}
