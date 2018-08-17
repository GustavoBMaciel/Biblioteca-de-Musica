<?php

namespace App\Http\Controllers\Biblioteca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Albun;
use App\Models\Banda;
use App\Models\Musica;
use Auth;
use App\Http\Requests\BandaFormRequest;

class BandaController extends Controller
{
    private $banda;
    private $totalPage = 20;
  
    public function __construct(banda $banda)
    {
      /*$this->middleware('auth');*/
  
      $this->banda = $banda;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $loggedUser = \Auth::user();

            //*dd($loggedUser);

            $title = 'Bandas/Artistas';

            $bandas = $this->banda->paginate($this->totalPage); 

            return view ('biblioteca.bandas.index', compact('bandas', 'title', 'loggedUser'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo(a) Banda/Artista';

        return view('biblioteca.bandas.create-edit',compact('title') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BandaFormRequest $request)
    {
        $dataForm = $request->all();

        $imageName = $request->id . '.' .
        $request->file('imagem')->getClientOriginalName();
    
        $image = $request->file('imagem')->move(base_path() . '\public\imgBanda', $imageName);

          $insert = $this->banda->create([
            'nome' => $dataForm['nome'],
            'imagem' => $imageName,
            'genero' => $dataForm['genero'],
            'descricao' => $dataForm['descricao']]);
        if ($insert)
        {
          return redirect()->route('bandas.index');
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
        $bandaShow = $this->banda->find($id);

        $title = "Visualizando Banda/Artistas: {$bandaShow->nome}";
    
        return view('biblioteca.bandas.show', compact('title', 'bandaShow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bandaEdit = $this->banda->find($id);

        $title = "Editar Banda/Artista: {$bandaEdit->nome}";
    
        return view('biblioteca.bandas.create-edit', compact('title', 'bandaEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BandaFormRequest $request, $id)
    {
        $this->middleware('users');

        $dataForm = $request->all();

        $bandaEditado = $this->banda->find($id);

        $imageName = $request->id . '.' .
        $request->file('imagem')->getClientOriginalName();
    
        $image = $request->file('imagem')->move(base_path() . '\public\imgBanda', $imageName);

          $update = $bandaEditado->update([
            'nome' => $dataForm['nome'],
            'imagem' => $imageName,
            'genero' => $dataForm['genero'],
            'descricao' => $dataForm['descricao']]);

        if ( $update )
        return redirect()->route('bandas.index');
        else
        return redirect()->route('bandas.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('users');

        $bandaDestroy = $this->banda->find($id);

        $delete = $bandaDestroy->delete();
    
        if ( $delete )
        return redirect()->route('bandas.index');
        else
        return redirect()->route('bandas.show', $id)->with(['errors' => 'Falha ao deletar']);
    }
}
