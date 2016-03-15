<?php

namespace nee_portal\Http\Middleware;

use Closure, Auth;
use Illuminate\Contracts\Auth\Guard;
use nee_portal\Models\Admin;

class Permission
{
    protected $permission;

    public function __construct(Guard $permission)
    {
        $this->permission = Auth::admin();
    }

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (!$this->permission->guest()) {
            $id=Auth::admin()->get()->id;
            if($id!='1')
                return back()->with(['message'=>'Access Denied!']);
        }
        return $response;
    }
}
