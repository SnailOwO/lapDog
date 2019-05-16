<?php

namespace App\Http\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class WebsocketVertifyToken extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        try {
            if (empty($guards)) {
                $guards = [null];
            }

            foreach ($guards as $guard) {
                if ($this->auth->guard($guard)->check()) {
                    return $this->auth->shouldUse($guard);
                }
            }
            throw new AuthenticationException(
                'Unauthenticated.', $guards, $this->redirectTo($request)
            );
        } catch (AuthenticationException $e) {
            \Log::info('WebsocketVertifyToken ', [$e->getMessage()]);
        }
    }
}
