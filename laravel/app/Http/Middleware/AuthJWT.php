<?php
namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Exception;
class AuthJWT
{
    /**
    Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            //$user = JWTAuth::toUser($request->input('token'));
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        }
        catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['error'=>'Invalid token.']);
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['error'=>'Expired token.']);
            }
            else {
                return response()->json(['error'=>'Authentication error.']);
            }
        }
        return $next($request);
    }
}
