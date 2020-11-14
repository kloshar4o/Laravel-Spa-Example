<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\UpdateProfilePassword;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param UpdateProfileRequest $request
     * @return Response
     */
    public function updateInfo(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $values = $request->only('first_name', 'last_name', 'email');

        return tap($user)->update($values);
    }

    /**
     * Update the user's password.
     *
     * @param UpdateProfilePassword $request
     * @return void
     */
    public function updatePassword(UpdateProfilePassword $request)
    {
        $request->user()->update(
            [
                'password' => bcrypt($request->password),
            ]
        );
    }
}
