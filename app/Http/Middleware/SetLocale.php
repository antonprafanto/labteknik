<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
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
        $locale = config('app.locale'); // Default 'en'

        // Check Session first
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            Log::info("SetLocale: Found in Session: {$locale} | Session ID: " . Session::getId());
        } 
        // Fallback to Cookie
        elseif ($request->hasCookie('lang')) {
            $locale = $request->cookie('lang');
            Session::put('locale', $locale); // Sync back to session
            Log::info("SetLocale: Found in Cookie: {$locale} | Session ID: " . Session::getId());
        }
        else {
            Log::info("SetLocale: No locale found. Defaulting to {$locale} | Session ID: " . Session::getId());
        }

        if (in_array($locale, ['en', 'id'])) {
            App::setLocale($locale);
            Carbon::setLocale($locale);
            setlocale(LC_TIME, $locale == 'id' ? 'id_ID.utf8' : 'en_US.utf8');
        }

        return $next($request);
    }
}
