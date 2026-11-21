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
    public function handle(Request $request, Closure $next): Response
    {
        $now = CarbonImmutable::now(config("store.timezone"));
        $open = CarbonImmutable::parse(config("store.open"), config("store.timezone"));
        $close = CarbonImmutable::parse(config("store.close"), config("store.timezone"));

        if (!$now->between($open, $close)) {
            return response()->json(
                [
                    "status" => "Магазин закрыт"
                ],
                403
            );
        }
        return $next($request);
    }
}
