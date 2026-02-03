<?php

namespace Ibrah\LaravelLogViewer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = array_keys(config('log-viewer.available_locales', ['en' => 'English', 'ar' => 'Arabic']));

        // Priority: Session > Config > App Locale
        $locale = session('log-viewer-locale', config('log-viewer.locale', app()->getLocale()));

        // Validate the locale is available
        if (in_array($locale, $availableLocales)) {
            app()->setLocale($locale);
        } else {
            // Fallback to first available locale or 'en'
            app()->setLocale($availableLocales[0] ?? 'en');
        }

        return $next($request);
    }
}
