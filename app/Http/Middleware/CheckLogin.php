<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userID = $request->cookie('id');
        if($userID){
            $user = User::where('id','=',$userID)->first();
            if($user){
                $request->attributes->add(['id' => $user->id]);
                return $next($request);
            }
            else{
                return redirect('/login')->with('status','You need login first');
            }
        }else{
            return redirect('/login')->with('status','You need login first');
        }
    }
}
