<?php

namespace App\Http\Middleware;
use App\GoogleAdUser;
use Closure;
class GoogleAdCheck
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
        $user_ip = $request->ip();
        $gadUser = GoogleAdUser::with('dealer')->where('user_ip',$user_ip)->first();

        if($request->exists('googlead'))
        {

            $url = explode('/',url()->current());

            if(in_array('inventory',$url) || in_array('car',$url) ){
             $dealer=$url[4];
            }

            if(empty($gadUser))
            {
                $gd = new GoogleAdUser();
                $gd->user_ip = $user_ip;
                $gd->dealer_slug = $dealer;
                $gd->save();
                $gd->dealer= $gd->dealer;
                $gadUser = $gd;
            }else{
                $gd = GoogleAdUser::with('dealer')->where('user_ip',$user_ip)->first();
                $gd->user_ip = $user_ip;
                $gd->dealer_slug = $dealer;
                $gd->save();
                $gd->dealer= $gd->dealer;
                $gadUser = $gd;
            }
        }

        if(!empty($gadUser))
        {
            session([$user_ip => $gadUser]);
        }

        return $next($request);
    }
}
