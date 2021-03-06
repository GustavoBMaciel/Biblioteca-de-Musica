<?php

namespace App\Http\Middleware;

use Closure;

class Users
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
        $loggedUser = \Auth::user();

        if( $loggedUser == null )
        {
          $request->session()->flash('warning', 'Record not added!');
  
          return redirect()->route('home')->with(['message' => 'Voce não tem permissão para esta Função!']);;
        }

        elseif ($loggedUser->permissao == null) {
  
          $request->session()->flash('warning', 'Record not added!');
  
          return redirect()->route('home')->with(['message' => 'Voce não tem permissão para esta Função!']);;
        }
          return $next($request);
    }
}
