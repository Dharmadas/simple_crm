<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\BusinessUnit;
use App\Policies\BusinessUnitPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        BusinessUnit::class => BusinessUnitPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('business_units', 'App\Policies\BusinessUnitPolicy');

        Gate::define('role_access', function($user, $permission){

            //$user_permissions = eval("return " . $user->role->permissions . ";");
            $user_permissions = explode(",", $user->role->permissions);

            if(in_array($permission, $user_permissions)){
                return true;
            }else{
                return false;
            }

        });
    }
}
