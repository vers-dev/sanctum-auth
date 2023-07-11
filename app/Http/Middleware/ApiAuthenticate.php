<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiAuthenticate
{

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ApiException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $bearer = $request->bearerToken();
        if ($token = DB::table('personal_access_tokens')->where('token',hash('sha256',$bearer))->first())
        {
            if ($user = User::find($token->tokenable_id))
            {
                Auth::login($user);
                return $next($request);
            }
        }

        throw new ApiException('Access denied', 401);
    }
}
