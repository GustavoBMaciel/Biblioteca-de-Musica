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

use App\Http\Controllers\Auth;
use App\Http\Requests\AlbunFormRequest;


class AlbunController extends Controller
{
    private $albun;
    private $totalPage = 20;
  
    public function __construct(Albun $albun)
    {
      /*$this->middleware('auth');*/
  
      $this->albun = $albun;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Albuns';

        $idBandas = DB::table('bandas')->join('albuns','albuns.idBanda', '=', 'bandas.id')
                                              ->select('bandas.nome')->pluck('nome');

        $albuns = $this->albun->paginate($this->totalPage);
        return view ('biblioteca.albuns.index', compact('albuns', 'title', 'idBandas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Albun';

        $idBanda = Banda::select('id','nome')->get()->all();
        $idMusica = Musica::select('id','nome')->get()->all();
    
        return view('biblioteca.albuns.create-edit',compact('title', 'idBanda', 'idMusica'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbunFormRequest $request)
    {
        $dataForm = $request->all();

        $imageName = $request->id . '.' .
        $request->file('capa')->getClientOriginalName();
    
        $image = $request->file('capa')->move(
          base_path() . '\public\capas', $imageName);

        $insert = $this->albun->create([
          'nome' => $dataForm['nome'],
          'capa' => $imageName,
          'idBanda' => $dataForm['idBanda'],
          'ano' => $dataForm['ano']]);
      
          if ($insert)
          {
           $ide = Albun::select('id')->take(1);
 
              Musicasalbun::insert(['idAlbum' => $insert->id,
              'idMusica' => $dataForm['idMusica']]);

            return redirect()->route('albuns.index');
          }
          else
          {
            return redirect()->back();
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
        $albunShow = $this->albun->find($id);

        $cont = 1;

        $title = "Detalhes: {$albunShow->nome}";

        $idMusicasalbuns = DB::table('musicas')->join('musicasalbuns','musicasalbuns.idMusica', '=', 'musicas.id')
                                              ->join('albuns','musicasalbuns.idAlbum', '=', 'albuns.id')
                                              ->select('musicas.nome')->where('musicasalbuns.idAlbum', '=', $albunShow->id)->orderBy('musicas.numero')->pluck('nome');
    
        return view('biblioteca.albuns.show', compact('title', 'albunShow','idMusicasalbuns', 'cont'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $albunEdit = $this->albun->find($id);

        $idBanda = Banda::select('id','nome')->get()->all();
    
        $idUsers = User::select('id')->pluck('id')->all();
    
        $idMusica = Musica::select('id','nome', 'compositor')->get();
    
        $title = "Editar albun: {$albunEdit->nome}";
    
        return view('biblioteca.albuns.create-edit', compact('title', 'albunEdit', 'idUsers', 'idMusica', 'idBanda'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbunFormRequest $request, $id)
    {
        $dataForm = $request->all();

        //*dd($dataForm );

        $imageName = $request->id . '.' .
        $request->file('capa')->getClientOriginalName();
    
        $image = $request->file('capa')->move(
          base_path() . '\public\capas', $imageName);

        $affectedRows = Albun::where('id', $id)->update([
        'nome' => $dataForm['nome'],
        'capa' => $imageName,
        'idbanda' => $dataForm['idBanda'],
        'ano' => $dataForm['ano']]);
  
        if ($affectedRows)
        {
          /*
         $ide = Albun::select('id')->take(1);

         Musicasalbun::update(['idAlbum' => $insert->id,
         'idMusica' => $dataForm['idMusica']]);
        */
          return redirect()->route('albuns.index');
        }
        else
        {
          return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $albunDestroy = $this->albun->find($id);

        $musicasDestroy = Musicasalbun::select('idAlbum')->where('idAlbum', '=', $id)->delete();

        $delete = $albunDestroy->delete();

  
        if ( $delete )
        return redirect()->route('albuns.index');
        else
        return redirect()->route('albuns.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
}