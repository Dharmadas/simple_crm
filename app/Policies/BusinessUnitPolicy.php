<?php

namespace App\Policies;

use App\User;
use App\BusinessUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessUnitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the businessUnit.
     *
     * @param  \App\User  $user
     * @param  \App\BusinessUnit  $businessUnit
     * @return mixed
     */
    public function view(User $user, BusinessUnit $businessUnit)
    {
        if($user->id == 1){
            return true;
        }else{
            abort(404, 'Something went wrong');
        }
    }

    /**
     * Determine whether the user can create businessUnits.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the businessUnit.
     *
     * @param  \App\User  $user
     * @param  \App\BusinessUnit  $businessUnit
     * @return mixed
     */
    public function update(User $user, BusinessUnit $businessUnit)
    {
        //
    }

    /**
     * Determine whether the user can delete the businessUnit.
     *
     * @param  \App\User  $user
     * @param  \App\BusinessUnit  $businessUnit
     * @return mixed
     */
    public function delete(User $user, BusinessUnit $businessUnit)
    {
        //
    }
}
