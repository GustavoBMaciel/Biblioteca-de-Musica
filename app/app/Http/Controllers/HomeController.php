<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albun;
use App\Models\Banda;
use App\Models\Musica;
use App\Models\Musicasalbun;
use App\User;
use Illuminate\Support\Facades\Input;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //* $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }

    public function pesquisa()
    {
      $texto = Input::get('texto');

      $pesquisaAlbuns = Albun::select('nome', 'capa')->where('nome', 'like', '%'.$texto.'%')->paginate(20);

      $pesquisaBandas = Banda::select('nome', 'imagem')->where('nome', 'like', '%'.$texto.'%')->paginate(20);

      $pesquisaMusicas = Musica::select('nome')->where('nome', 'like', '%'.$texto.'%')->paginate(20);



     return view('pesquisa', compact('pesquisaAlbuns', 'pesquisaBandas', 'pesquisaMusicas'));
    }
}
