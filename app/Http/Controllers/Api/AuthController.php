<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Http\Resources\PublicUsersResource;
use App\Models\PublicUsers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseApiController
{
    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();

            $user = PublicUsers::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phonenumber' => $validated['phonenumber'],
                'address' => $validated['address'],
                'gender' => $validated['gender'],
                'password' => bcrypt($validated['password']),
            ]);

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addMonths(3);
            $token->save();

            if (!$tokenResult) {
                return $this->sendError("Server Error. Please try again later.");
            }

            $token = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
            ];

            DB::commit();

            return $this->sendResponse(['user' => new PublicUsersResource($user), 'token' => $token]);
        } catch (\Exception $e) {
            // return $e->getMessage();
            DB::rollBack();
            return $this->sendError("Server Error. Please try again later.");
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validate = $request->validated();
            $user = PublicUsers::where('email', $validate['email'])->first();

            if (!$user) {
                return $this->sendError('User not found!');
            }

            if (!Hash::check($request->password, $user->password)) {
                return $this->sendError('The email or password is incorrect.');
            }

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addMonths(3);
            $token->save();

            if (!$tokenResult) {
                return $this->sendError("Server Error. Please try again later.");
            }

            $token = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
            ];

            $message = 'Login successful';

            return $this->sendResponse(['user' => new PublicUsersResource($user), 'token' => $token], $message);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = auth('api')->user()->token();
            $token->revoke();
            return $this->sendResponse([], "User logged out successfully.");
        } catch (\Exception $e) {
            return $this->sendError("Server Error. Please try again later.");
        }
    }
}
