<?php

namespace App\Service;

use App\Http\Requests\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class RoleService 
{
    function __construct(protected Role $role){

    }

    function getUserRole(){
        return $this->role->whereName("user")->first();
    }

}