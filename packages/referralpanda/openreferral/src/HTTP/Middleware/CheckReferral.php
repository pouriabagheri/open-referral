<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 28.10.2019
 * Time: 22:59
 */

namespace ReferralPanda\OpenReferral\Http\middleware;

use Closure;
use ReferralPanda\OpenReferral\Models\Referral;

class CheckReferral
{
    public function handle($request, Closure $next)
    {
        if ($request->hasCookie('referral')) {
            return $next($request);
        }
        if (($ref = $request->query('ref')) && Referral::referralExists($ref)) {
            return redirect($request->fullUrl())->withCookie(cookie()->forever('referral', $ref));
        }
        return $next($request);
    }
}