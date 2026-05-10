<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $segment = $request->segment(1);
        $supported = ['en', 'id'];

        if (in_array($segment, $supported)) {
            app()->setLocale($segment);
            config(['app.locale' => $segment]);
            $request->session()->put('locale', $segment);
            \Illuminate\Support\Facades\URL::defaults(['locale' => $segment]);
        } else {
            $locale = $request->session()->get('locale', config('app.locale', 'en'));
            if (!in_array($locale, $supported)) {
                $locale = 'en';
            }
            app()->setLocale($locale);
            config(['app.locale' => $locale]);
            \Illuminate\Support\Facades\URL::defaults(['locale' => $locale]);
        }

        return $next($request);
    }
}
