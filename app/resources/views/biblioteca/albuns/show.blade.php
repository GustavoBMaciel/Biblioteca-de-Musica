@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row">
      <div class="col-6">
          <div class="panel-heading"></div>
              <table  class="table table-striped">
              <img width="200px" src="{{ url('/capas', $albunShow->capa )}}" alt="">
            </table>
      </div>

      <div class="col-6">
        <div class="panel-heading"></div>
        <table  class="table table-striped">
              <p><b>Nome:</b> {{$albunShow->nome}}</p>
              <p><b>Ano:</b> {{$albunShow->ano}}</p>
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

</div>
<div class="form-group col-md-12">
        <a href="{{route('albuns.index')}}" class="btn btn-success alert alert-success">Voltar</a>
</div>
@endsection
