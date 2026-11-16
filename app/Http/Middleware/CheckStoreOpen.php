<?php

namespace App\Http\Middleware;

use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStoreOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $now = CarbonImmutable::now();
        $open = CarbonImmutable::parse("8:00");
        $close = CarbonImmutable::parse("17:00");

        if(!$now->between($open, $close)){
            return response()->json(
                [
                    "status" => "Магазин закрыт"
                ],
                400
            );
        }
        return $next($request);
    }
}
