<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChatAUTH
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $service_id = $request->route()->parameter('service_id');
        $service = \App\Models\Service::find($service_id);

        $user = Auth::user();

        $bid = \App\Models\Bid::where('service_id', $service_id)->where('status', 'accepted')->first();
        $worker_id = $bid->worker_id;

        if ($user->role === 'worker' && $user->id !== $worker_id) {
            return redirect()->route('dashboard');
        }

        if ($user->role === 'client' && $user->id !== $service->user_id) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
