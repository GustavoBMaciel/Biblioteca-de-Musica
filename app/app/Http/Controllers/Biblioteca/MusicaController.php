<?php

namespace App\Http\Controllers\Biblioteca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Albun;
use App\Models\Banda;
use App\Models\Musica;
use App\Http\Controllers\Auth;
use App\Models\Musicasalbun;
use App\Http\Requests\MusicaFormRequest;

class MusicaController extends Controller
{
    private $musica;
    private $totalPage = 5;
  
    public function __construct(musica $musica)
    {
      /*$this->middleware('auth');*/
  
      $this->musica = $musica;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Musicas';

        $musicas = $this->musica->paginate($this->totalPage);
        return view ('biblioteca.musicas.index', compact('musicas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Nova Musica';

        return view('biblioteca.musicas.create-edit',compact('title') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MusicaFormRequest $request)
    {
        $dataForm = $request->all();
    
        $insert = $this->musica->create($dataForm);
        if ($insert)
        {
          return redirect()->route('musicas.index');
        }
        else {
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
        $musicaShow = $this->musica->find($id);

        $title = "Visualizando Musicas: {$musicaShow->nome}";
    
        return view('biblioteca.musicas.show', compact('title', 'musicaShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $musicaEdit = $this->musica->find($id);

        $title = "Editar Musica: {$musicaEdit->nome}";
    
        return view('biblioteca.musicas.create-edit', compact('title', 'musicaEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MusicaFormRequest $request, $id)
    {
        $dataForm = $request->all();

        $musicaEditado = $this->musica->find($id);
    
        $update = $musicaEditado->update($dataForm);
    
        if ( $update )
        return redirect()->route('musicas.index');
        else
        return redirect()->route('musicas.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adicionaDestroy = Musicasalbun::select('idMusica')->where('idMusica', '=', $id);

        $deleteAdiciona = $adicionaDestroy->delete();

        $musicaDestroy = $this->musica->find($id);

        $delete = $musicaDestroy->delete();
    
        if ( $delete && $deleteAdiciona )
        return redirect()->route('musicas.index');
        else
        return redirect()->route('musicas.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
}
