<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use JWTAuth;
use JWTAuthException;
use App\User;
class ApiAuthController extends Controller
{
    public function __construct()
    {
        $this->user = new User;
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $jwt = '';
        try {
            if (!$jwt = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_credentials',
                ], 401);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ], 500);
        }
        return response()->json([
            'response' => 'success',
            'result' => ['token' => $jwt]
        ]);
    }
    /**
     * authenticates user with token sent as parameter (GET / POST)
     */
    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
    /**
     * get current authenticated user - JWT must be set in HTTP header
     */
    public function getCurrentAuthenticatedUser() {
        $user = JWTAuth::user();
        return response()->json(['result' => $user]);
    }
    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}
