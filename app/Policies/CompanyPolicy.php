<?php

namespace App\Policies;

use App\Models\Company\Company;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function view(User $user, Company $company)
    {

        return $company->user->is($user);
    }


    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {

        return request()->company->user->is($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function update(User $user, Company $company)
    {
        return $company->user->is($user);
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        return $company->user->is($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function forceDelete(User $user, Company $company)
    {
        return false;
    }

}
