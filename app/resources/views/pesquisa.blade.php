@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
<div class="col-4">

  <div class="panel-heading">Resultados de Musicas</div>

  <table  class="table table-striped">
      <tr>
        <th>Nome</th>
      </tr>
      @foreach ($pesquisaMusicas as $musica)
      <tr>
        <td>{{$musica->nome}}</td>
      </tr>
      @endforeach
    </table>
</div>

<div class="col-4">
<div class="panel-heading">Resultados de Albuns</div>

<table  class="table table-striped">
    <tr>
        <th>Imagem</th>
        <th>Nome</th>
    </tr>
    @foreach ($pesquisaAlbuns as $albun)
    <tr>
      <td><img width="100px" src="{{ url('/capas', $albun->capa )}}" alt=""></td>
      <td>{{$albun->nome}}</td>
    </tr>
    @endforeach
  </table>
</div>

<div class=" col-4">
    <div class="panel-heading">Resultados de Bandas</div>
    
    <table  class="table table-striped">
        <tr>
          <th>Imagem</th>
          <th>Nome</th>
        </tr>
        @foreach ($pesquisaBandas as $banda)
        <tr>
          <td><img width="100px" src="{{ url('/imgBanda', $banda->imagem )}}" alt=""></td>
          <td>{{$banda->nome}}</td>
        </tr>
        @endforeach
      </table>
</div>
    </div>
  </div>
@endsection
