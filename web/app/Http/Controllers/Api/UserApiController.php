<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use http\Client\Curl\User;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserApiController extends Controller
{

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function updateUser(Request $request, User $user){
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * @param $id
     * @return JsonResponse
     */

    public function getUserById($id){
        return response()->json(User::find($id));
    }
}
