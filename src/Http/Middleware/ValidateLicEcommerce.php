<?php

namespace Tharasky\LicEcommerce\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tharasky\LicEcommerce\Helpers\LicEcommerceHelper;

class ValidateLicEcommerce
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $result = LicEcommerceHelper::ensureLicenseActive();

        if($result!='success'){
            return redirect($result);
        }

        return $next($request);
    }
}
