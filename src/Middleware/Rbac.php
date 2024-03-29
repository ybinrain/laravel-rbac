<?php

namespace Ybinrain\Rbac\Middleware;

use Closure;

class Rbac
{
    public function handle($request, Closure $next, $level, $permission)
    {
        if( !in_array($level, ['is', 'can'])) {
            abort(500, 'Invalid RBAC operator specified.');
        }
        if('is' == $level) {
            if($request->user()->hasRole($permission)) {
                return $next($request);
            }
        } else {
            if($request->user()->canDo($permission)) {
                return $next($request);
            }
        }
        abort(403);
    }
}
