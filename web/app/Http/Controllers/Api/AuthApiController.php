<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderImage;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use function PHPUnit\Framework\isEmpty;

class AuthApiController extends Controller
{
    /**
     * register new user and adding access token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(['message' => 'Empty credits'], 400);
        }

        $fields = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string', // add confirmed to password
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        if (!isEmpty(User::where('email', $fields['email'])->first())) {
            return response()->json(['message' => 'User already exists'], 400);
        }

        $user = User::create([
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'image' => $image_path
        ]);

        $token = $user->createToken('token')->plainTextToken;
        #$user->remember_token = $token;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 200);
    }

    /**
     * login into system by creating access token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(['message' => 'Empty credits'], 400);
        }

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)){
            return response()->json(['message' => 'Bad credits'], 401);
        }

        if (count(DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->get()) > 0) {
            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();
            return response()->json(
                ['message' => 'Already logged in',
                    'user'=>$user,
                    'token' => $user->createToken('token')->plainTextToken],200);
//                        DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->value('id') . '|' . DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->value('token')], 200);
        }

        $token = $user->createToken('token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    /**
     * Logout
     *
     * @return string[]
     */
    public function logout(){
        auth()->user()->tokens()->delete();
        return ['message' => 'Logged out'];
    }
}
