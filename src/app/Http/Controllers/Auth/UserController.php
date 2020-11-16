<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function current(Request $request)
    {
        return response()->json($request->user());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @return Builder|Model
     */
    protected function create(RegisterRequest $request)
    {
        return User::query()->create(
            [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
            ]
        );
    }
}
