<?php

namespace App\Policies;

use App\Models\Company\CompanyAddress;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyAddressPolicy
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
     * @param CompanyAddress $companyAddress
     * @return mixed
     */
    public function view(User $user, CompanyAddress $companyAddress)
    {

        return $companyAddress->user->is($user);
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
     * @param CompanyAddress $companyAddress
     * @return mixed
     */
    public function update(User $user, CompanyAddress $companyAddress)
    {
        return $companyAddress->user->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param CompanyAddress $companyAddress
     * @return mixed
     */
    public function delete(User $user, CompanyAddress $companyAddress){

        return $companyAddress->user->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param CompanyAddress $companyAddress
     * @return mixed
     */
    public function restore(User $user, CompanyAddress $companyAddress)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param CompanyAddress $companyAddress
     * @return mixed
     */
    public function forceDelete(User $user, CompanyAddress $companyAddress)
    {
        return false;
    }
}
