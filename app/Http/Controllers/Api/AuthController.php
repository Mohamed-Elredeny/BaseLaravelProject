<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\AuthenticationRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\GeneralTrait;

class AuthController extends Controller
{
    use GeneralTrait;
    public $userAuthentication;

    public function __construct(AuthenticationRepositoryInterface $userAuthentication)
    {
        $this->userAuthentication = $userAuthentication;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'phone' => 'required|min:11|numeric'
        ]);
        if ($validator->fails()) {
            return $this->returnValidationError(422, $validator);
        } else {
            $recordDetails = [
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password
            ];
            $user_login = $this->userAuthentication->login($recordDetails);
            if ($user_login['status']) {
                $this->updateToken($request, $user_login['data']);
                return $this->returnData(['userDetails'], [$user_login['data']], 'User login successfully');
            } else {
                return $this->returnError(200, 'Unable to login');
            }
        }
    }

    public function updateToken(Request $request, $user)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        $user->update([
            'remember_token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:255',
            'phone' => 'required|string|min:9|unique:users',
            'email' => 'required|string|email|min:5|max:255|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->returnValidationError(422, $validator);
        } else {
            $image = $this->uploadImage($request, 'image', 'users');
            $recordDetails = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => hash::make($request->password),
                'image' => $image,
                'status' => 1,
                'points' => 0
            ];
            return $this->userAuthentication->register($recordDetails);
        }

    }

    public function profile(Request $request, $profile)
    {
        $token = $request->header('token');
        $auth_user = $this->userAuthentication->viewProfile($token);
        $wanted_user = User::find($profile);
        if ($wanted_user) {
            if ($profile == $auth_user->id) {
                $auth_user->myProfile = 1;
                return $this->returnData(['userDetails'], [$auth_user], 'userDetails');
            } else {
                $wanted_user->myProfile = 0;
                return $this->returnData(['userDetails'], [$wanted_user], 'userDetails');
            }
        } else {
            return $this->returnError(200, 'There is no user with this id');
        }
    }


}
