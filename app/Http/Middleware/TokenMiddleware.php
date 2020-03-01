<?php

namespace App\Http\Middleware;

use Closure;

class TokenMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $auth = $request->header('Authorization');
        if (! $auth) {
            throw new \Exception('Not Header Authorization');
        }

        [$type, $token] = explode(' ', $auth);

        if ('Bearer' !== $type) {
            throw new \Exception('Wrong Authorization');
        }

        $request->request->add([
            'token' => $token,
        ]);

        return $next($request);
    }
}
