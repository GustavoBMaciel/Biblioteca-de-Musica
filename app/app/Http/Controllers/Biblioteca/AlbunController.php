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
use App\Http\Requests\Albun2FormRequest;


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

        $albuns = DB::table('albuns')->join('bandas','bandas.id', '=', 'albuns.idBanda')
        ->select('albuns.id as id', 'albuns.capa as capa', 'albuns.nome as albuns', 'albuns.ano as ano', 'bandas.nome as banda')
        ->get();

        //*dd($albuns);
        return view ('biblioteca.albuns.index', compact('albuns', 'title'));
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
    
        return view('biblioteca.albuns.create-edit',compact('title', 'idBanda'));
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
    public function update(Albun2FormRequest $request, $id)
    {
        $dataForm = $request->all();

        $albunEditado = $this->albun->find($id);

        if (!isset ($dataForm['capa']))
        {
          $affectedRows = Albun::where('id', $id)->update([
            'nome' => $dataForm['nome'],
            'capa' => $albunEditado->capa,
            'idbanda' => $dataForm['idBanda'],
            'ano' => $dataForm['ano']]);

            return redirect()->route('albuns.index');
          }
          else
          {
              $imageName = $request->id . '.' .
              $request->file('capa')->getClientOriginalName();
          
              $image = $request->file('capa')->move(
                base_path() . '\public\capas', $imageName);

              $affectedRows = Albun::where('id', $id)->update([
              'nome' => $dataForm['nome'],
              'capa' => $imageName,
              'idbanda' => $dataForm['idBanda'],
              'ano' => $dataForm['ano']]);
          }
        if ($affectedRows)
        {
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
