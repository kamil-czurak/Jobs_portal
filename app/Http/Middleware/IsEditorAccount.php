<?php namespace app\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class IsEditorAccount {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->user()->roles()->first()->name =='user')
        {
            session()->flash('error_msg','This resource is restricted to Administrators!');
            return redirect()->route('praca.index');
        }
        return $next($request);
    }

}