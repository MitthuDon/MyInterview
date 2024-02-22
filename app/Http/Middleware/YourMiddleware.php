<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class YourMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try{
            // dd('check');
            return $next($request);
        }
        catch(Exception $e){
            dd('check');
            if($e instanceof NotFoundHttpException){
        if(Auth::guard('candidate')->check()){
            return redirect('candidate.index');
        }elseif(Auth::guard('interviewer')->check()){
            return redirect('candidate.index');
        }else{
            return redirect('welcome');
        }
    }
}
    }
}
