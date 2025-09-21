<?php

namespace AaqibShahzad\ScaleKit\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $tenantId = $request->header(config('scalekit.tenant.tenant_header')) 
                    ?? $request->route('tenant')
                    ?? null;

        if ($tenantId) {
            app()->instance('scalekit.tenant', $tenantId);
        }

        return $next($request);
    }
}