@extends('layouts.app')

@section('content')
<div class="container">

    @if (\Session::has('sucesso'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('sucesso') !!}</li>
        </ul>
    </div>
    @endif

    @if (\Session::has('erro'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('erro') !!}</li>
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-6">
            <div class="panel-heading"></div>
                <table  class="table table-striped">
                    @foreach ($albunAdiciona as $adiciona)
                <img width="350px" src="{{ url('/capas', $adiciona->capa )}}" alt="">
              </table>
        </div>
  
        <div class="col-6">
          <div class="panel-heading"></div>
          <table  class="table table-striped">
                <p><b>Nome:</b> {{$adiciona->nome}}</p>
                <p><b>Ano:</b> {{$adiciona->ano}}</p>
                @endforeach
                <tr>
                    <th>Sequencia</th>
                    <th>Musicas</th>
                    <th>Ações</th>
                </tr>
                      @foreach ($idMusicasalbuns as $idMusicasalbun)
                              <tr>
                                <td>{{$cont++}}</td>
                                <td>{{$idMusicasalbun->nome}}</td>
                                <td>
                                {!! Form::open(['route' => ['adicionamusica.destroy', $idMusicasalbun->id], 'method' => 'DELETE']) !!}
                                <button type="submit" class="alert alert-danger fas fa-trash-alt"> Retirar Musica do Albun</button>
                                {!! Form::close() !!}
                                </td>

                              </tr>
                      @endforeach
          </table>


  {!! Form::open(['route' => 'adicionamusica.store', 'class' => 'form']) !!}
  <div class="form-group col-md-12">
    <label for=""><strong>Selecione a Musica a ser Incluida/Deletada</strong></label>
    <select name="idMusica" class="form-control">
      <option value="">Escolha a Musica</option>
      @foreach ($musicas as $musica)
      <option value="{{$musica->id}}">{{$musica->nome}}</option>
      @endforeach
    </select>
</div>
<div>
    <select name="idAlbum" class="form-control" hidden>
    @foreach ($albunAdiciona as $adiciona)
    <option value="{{$adiciona->id}}"></option>
    @endforeach
  </select>
</div>

<div class="form-group col-md-12">
    <a href="{{route('albuns.index')}}" class="btn btn-success alert alert-success ">Voltar</a>
    {!! Form::submit('Adicionar Musica no Album', ['class' => 'btn btn-success alert alert-success ']) !!}
    {!! Form::close() !!}
  </div>
</div>
</div>
</div>
@endsection
