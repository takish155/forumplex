<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
        $sessionLocale = session()->get("locale");

        echo $request->fullUrl;

        if (!in_array($locale, ["en", "ja"])) {
            return redirect("/en" . $request->url);
        };


        if ($locale !== $sessionLocale) {
            session()->put("locale", $locale);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
