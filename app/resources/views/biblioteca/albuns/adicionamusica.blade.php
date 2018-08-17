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

    <div class="row">
        <div class="col-6">
            <div class="panel-heading"></div>
                <table  class="table table-striped">
                    @foreach ($albunAdiciona as $adiciona)
                <img width="200px" src="{{ url('/capas', $adiciona->capa )}}" alt="">
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
                </tr>
                      @foreach ($idMusicasalbuns as $idMusicasalbun)
                              <tr>
                                <td>{{$cont++}}</td>
                                <td>{{$idMusicasalbun}}</td>
                              </tr>
                      @endforeach
          </table>


  {!! Form::open(['route' => 'adicionamusica.store', 'class' => 'form']) !!}
  <div class="form-group col-md-12">
    <label for=""><strong>Selecione a Musica a ser Incluida</strong></label>
    <select name="idMusica" class="form-control">
      <option value="">Escolha a Musica</option>
      @foreach ($idMusica as $musica)
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

<div class="col-6">
    <a href="{{route('albuns.index')}}" class="btn btn-success alert alert-success ">Voltar</a>
    {!! Form::submit('Enviar', ['class' => 'btn btn-success alert alert-success ']) !!}
    {!! Form::close() !!}
</div>
<div class="col-6">
    {!! Form::open(['route' => ['adicionamusica.destroy', $musica->id], 'method' => 'DELETE']) !!}
    {!! Form::submit("Deletar musica", ['class' => 'alert alert-danger fas fa-trash-alt']) !!}
    {!! Form::close() !!}
  </div>
</div>
</div>
</div>
@endsection
