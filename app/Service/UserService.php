<?php

namespace App\Service;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserService 
{
    function __construct(protected User $user){}

    function get(){
        return $this->user->all();
    }

    function findById(int $id){
        return $this->user->findOrFail($id);
    }

    function login(array $data){
        if (!auth("web")->attempt($data)) {
            return response(['error_message' => 'Incorrect Details. Please try again']);
        }
        $user =  auth("web")->user();
        // $token = $user->createToken('api')->accessToken;
        $token = $this->authToken($data['email'],$data['password']);

        return response(['user' => $user, 'token' => $token]);
    }

    function register(array $data){
        $data['password'] = bcrypt($data['password']);

        $user = $this->user->create($data);

        // $token = $user->createToken('api')->accessToken;
        $token = $this->authToken($data['email'],$data['password']);

        return response([ 'user' => $user, 'token' => $token]);
    }

    public function logout()
    {
        auth("web")->logout();
        return response()->json(['message'=>'You are logged out']);
    }

    function authToken(string $email,string $password){

        $request = Request::create('oauth/token', 'POST', [
            'grant_type' => 'password',
            'client_id' => env("CLIENT_ID"),
            'client_secret' => env("CLIENT_SECRET"),
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ]);
        
        $result = app()->handle($request);
        return json_decode($result->getContent(), true); 
    }

    function refreshToken(string $refresh_token){

        $request = Request::create('oauth/token', 'POST', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id' => env("CLIENT_ID"),
            'client_secret' => env("CLIENT_SECRET"),
            'scope' => '',
        ]);
        
        $result = app()->handle($request);
        return json_decode($result->getContent(), true); 
    }

}
