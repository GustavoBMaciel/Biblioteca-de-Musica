<?php

namespace App\Http\Controllers\Biblioteca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Albun;
use App\Models\Banda;
use App\Models\Musica;
use App\Models\Musicasalbun;
use App\User;
use DB;

class AdicionaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request != '')
        {
        $dataForm = $request->all();
  
        if ($dataForm)
        {
         $ide = Albun::select('id')->take(1);
  
            Musicasalbun::insert(['idAlbum' => $dataForm['idAlbum'],
            'idMusica' => $dataForm['idMusica']]);

        }
          
        return redirect()->back()->with('sucesso', 'Musica Incluida com Sucesso!!');
    }
    else
    {
        return redirect()->back()->with('erro', 'Não há musicas para incluir!!');
    }
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $albunAdiciona = Albun::select('id','nome','ano','capa')->where('id', '=', $id)->get();

        $musicas = Musica::select('id','nome', 'compositor')->get();
        $idMusica = Musica::select('id')->get();


        $cont = 1;

        $title = "Detalhes do Album";

        $idMusicasalbuns = DB::table('musicas')->join('musicasalbuns','musicasalbuns.idMusica', '=', 'musicas.id')
                                              ->join('albuns','musicasalbuns.idAlbum', '=', 'albuns.id')
                                              ->select('musicas.nome', 'musicas.id')->where('musicasalbuns.idAlbum', '=', $id)->get()->all();
    
        return view('biblioteca.albuns.adicionamusica', compact('title', 'albunAdiciona','idMusicasalbuns', 'idMusica', 'musicas', 'cont' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $albunAdicionaid = Albun::select('id')->pluck('id')->all();
        $id = array_get($albunAdicionaid, 'id');
        $albunAdicionanome= Albun::select('nome')->pluck('nome')->all();
        $nome = array_get($albunAdicionanome, 'nome');
        $albunAdicionaano = Albun::select('ano')->pluck('ano')->all();
        $ano = array_get($albunAdicionaano, 'ano');
        $albunAdicionacapa = Albun::select('capa')->pluck('capa')->all();
        $capa = array_get($albunAdicionacapa, 'capa');

        $idBanda = Banda::select('id','nome')->get()->all();
    
        $idUsers = User::select('id')->pluck('id')->all();
    
        $idMusica = Musica::select('id','nome', 'compositor')->get();

        $title = "Adicionando musicas ao Album";
    
        return view('biblioteca.albuns.adicionamusica', compact('title', 'id', 'idUsers', 'idMusica', 'idBanda', 'nome', 'ano', 'capa' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $albunAdiciona = Albun::select('id','nome','ano','capa')->where('id','=', $id)->get()->all();

        $title = "Adicionando musicas ao Album: {$albunAdiciona->nome}";
  
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if($id != "")
        {
        $adicionaDestroy = Musicasalbun::select('idMusica')->where('idMusica', '=', $id);

        $delete = $adicionaDestroy->delete();

        return redirect()->back()->with('sucesso', 'Musica Deletada com Sucesso!!');
        }
        else
        {
            return redirect()->back()->with('erro', 'Não há musicas para deletar!!');
        }
          
    }
}
