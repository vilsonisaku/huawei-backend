<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    function __construct(protected UserService $userService){}


    function getAll(){
        return $this->userService->get();
    }

    function find(int $id){
        return $this->userService->findById($id);
    }

    function register(RegisterRequest $request){

        return $this->userService->register($request->all());
    }

    function login(LoginRequest $request){

        return $this->userService->login($request->all(["email","password"]));
    }

    function checkToken(){
        return $this->userService->checkToken();
    }
}
