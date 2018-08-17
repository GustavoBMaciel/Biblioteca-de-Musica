@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row">
      <div class="col-6">
          <div class="panel-heading"></div>
              <table  class="table table-striped">
              <img width="200px" src="{{ url('/imgBanda', $bandaShow->imagem )}}" alt="">
            </table>
      </div>


      <div class="col-6">
          <div class="panel-heading"></div>
          <table  class="table table-striped">
              <p><b>Nome:</b> {{$bandaShow->nome}}</p>
              <p><b>Genero:</b> {{$bandaShow->genero}}</p>
              <p><b>Descrição:</b> {{$bandaShow->descricao}}</p>
          </table>
     </div>
     <div class="form-group col-md-12">
            <a href="{{route('bandas.index')}}" class="btn btn-success alert alert-success">Voltar</a>
    </div>
    </div>

</div>
@endsection
