<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DB;


class UserLogined
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $active_time = DB::table('admin')->where('id', Session::get('adminID'))->first();
        $now = ['active_time' => Carbon::now()->timestamp];

//dd(Carbon::now()->timestamp - (intval($active_time)));
        if ((Carbon::now()->timestamp - $active_time->active_time) > 12) {

            return redirect('/');
        } else {

            DB::table('admin')->where('id', Session::get('adminID'))->update($now);

            return $next($request);

        }
    }
}
