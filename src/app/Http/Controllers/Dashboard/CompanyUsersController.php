<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Company\CompanyUserCreateRequest;
use App\Http\Requests\Dashboard\Company\CompanyUserUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Models\Company\Company;
use App\Models\User\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Company $company
     * @return UserCollection
     * @throws AuthorizationException
     */
    public function index(Company $company)
    {
        $users = $company->usersPagination(10);

        return new UserCollection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @param User $user
     * @return Response
     */
    public function show(Company $company, User $user)
    {
        return response($user);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyUserCreateRequest $request
     * @param Company $company
     * @param User $user
     * @return Response
     */
    public function store(CompanyUserCreateRequest $request, Company $company, User $user)
    {

        $attributes = $request->only('email', 'first_name', 'last_name', 'password');
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['company_id'] =  $company->id;
        $user->fill($attributes);
        return response(tap($user)->save());

    }


    /**
     * Update the specified resource in storage.
     *
     * @param CompanyUserUpdateRequest $request
     * @param Company $company
     * @param User $user
     * @return Response
     */
    public function update(CompanyUserUpdateRequest $request, Company $company, User $user)
    {

        $attributes = $request->only('email', 'first_name', 'last_name', 'password');

        $password = $attributes['password'] ?? null;

        if ($password)
            $attributes['password'] = bcrypt($password);

        $attributes['company_id'] =  $company->id;

        $user = tap($user)->update($attributes);
        return response($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @param User $user
     * @return UserCollection
     * @throws Exception
     */
    public function destroy(Company $company, User $user)
    {
        $user->delete();
        $users = $company->usersPagination(10);

        return new UserCollection($users);
    }
}
