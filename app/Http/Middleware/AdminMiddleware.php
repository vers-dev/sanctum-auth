<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return RedirectResponse|Response|mixed
     * @throws ApiException
     */
    public function handle(Request $request, Closure $next): mixed
    {

        if($request->user()->tokenCan('admin')){
            return $next($request);
        }

        throw new ApiException('Permission denied', 403);
    }
}
