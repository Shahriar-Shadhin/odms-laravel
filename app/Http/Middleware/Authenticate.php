<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if($request->expectsJson()){
            if(Auth()->user()->role === 'admin'){
                return route('admin.main');
            }elseif(Auth()-user()->role === 'student'){
                return route('student.main');
            }elseif(Auth()-user()->role === 'teacher'){
                return route('teacher.main');
            }else{
                return route('loginForm');
            }
        }else{
            return route('loginForm');
        }

    }
}
