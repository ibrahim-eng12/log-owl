<?php

namespace Ibrah\LaravelLogViewer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeLogViewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedUsers = config('log-viewer.allowed_users', []);

        // If no users specified, allow all authenticated users
        if (empty($allowedUsers)) {
            return $next($request);
        }

        $user = $request->user();

        if (!$user) {
            abort(403, __('log-viewer::log-viewer.unauthorized'));
        }

        // Check if user's email or ID is in the allowed list
        $isAllowed = in_array($user->email, $allowedUsers, true)
            || in_array($user->id, $allowedUsers, true)
            || in_array((string) $user->id, $allowedUsers, true);

        if (!$isAllowed) {
            abort(404);
        }

        return $next($request);
    }
}
