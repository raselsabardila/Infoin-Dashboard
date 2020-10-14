<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Visitor;
use App\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->status == 0) {
            Visitor::create([
                "ip" => $request->ip(),
                "user_id" => Auth::id()
            ]);

            $user = User::where("id",Auth::id())->first();
            $user->update([
                "status" => 1
            ]);
        }
        
        if(Auth::user()->role_id == 1){
            return redirect()->route("user.dashboard");
        } else if(Auth::user()->role_id == 2){
            return redirect()->route("eo.dashboard");
        } else{
            return redirect()->route("admin.dashboard");
        }
        return redirect("/");
    }
}
