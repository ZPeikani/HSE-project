<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request; use Symfony\Component\HttpFoundation\Response;
class EnsureUserHasRole { public function handle(Request $request, Closure $next, string ...$roles):Response { abort_unless($request->user()?->is_active && $request->user()->hasRole($roles),403,'شما به این بخش دسترسی ندارید.'); return $next($request); } }
