<?php

namespace App\Policies;

use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return request()->company->user->is($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $company_user
     * @return mixed
     */
    public function view(User $user, User $company_user)
    {
        return $user->company_id === $company_user->company_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return request()->company->id === $user->company_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $company_user
     * @return mixed
     */
    public function update(User $user, User $company_user)
    {
        return $user->company_id === $company_user->company_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $company_user
     * @return mixed
     */
    public function delete(User $user, User $company_user)
    {
        return $user->company_id === $company_user->company_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param User $company_user
     * @return mixed
     */
    public function restore(User $user, User $company_user)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param User $company_user
     * @return mixed
     */
    public function forceDelete(User $user, User $company_user)
    {
        return false;
    }
}
