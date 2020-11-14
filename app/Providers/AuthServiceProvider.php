<?php

namespace App\Providers;

use App\Models\Company\Company;
use App\Models\Company\CompanyAddress;
use App\Models\User\User;
use App\Policies\CompanyAddressPolicy;
use App\Policies\CompanyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

    }
}
