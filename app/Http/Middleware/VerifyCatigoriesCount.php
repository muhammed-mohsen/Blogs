<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCatigoriesCount
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

        if(Category::all()->count() === 0)
        {
            session()->flash('error', 'you need to add any Ctegory to add any Posts');
            return redirect(route('categories.create'));

        }
        return $next($request);
    }
}
