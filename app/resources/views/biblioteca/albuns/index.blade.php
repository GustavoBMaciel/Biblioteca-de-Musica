@extends('layouts.app')
@section('content')
<div class="container">

      <h2 class="panel-heading">Albuns</h2>

      <a href="{{url('/home')}}" class="alert alert-success fas fa-undo  "> Voltar</a>
      @if ( Auth::check() ) 
      @if(Auth::user()->permissao == 'user' || Auth::user()->permissao == 'admin' )
      <a href="{{route('albuns.create')}}" class="alert alert-success fas fa-plus-square"> Cadastrar</a>
      @endif
      @endif

      <div class="row">
        @foreach ($albuns as $albun)
        <div class="col-md-4">
          <div class="card mb-4" >
            <img class="card-img-top" src="{{ url('/capas', $albun->capa )}}" style="width:348px; height:348px; margin-right:25px;"alt="">
            <div class="card-body">
              <h5 class="card-title">{{$albun->albuns}}</h5>
              <p class="card-text">{{$albun->banda}}</p>
              <p class="card-text">{{$albun->ano}}</p>
              <a href="{{route('albuns.show', $albun->id)}}" class=" alert alert-primary fas fa-eye">Detalhes</a>

              @if ( Auth::check() ) 
              @if(Auth::user()->permissao == 'user' || Auth::user()->permissao == 'admin' )
              <a href="{{route('albuns.edit', $albun->id)}}" class="alert alert-success fas fa-pencil-alt"> Editar</a>

              <a href="{{route('adicionamusica.show', $albun->id)}}" class="alert alert-success fas fa-plus-square"> Cadastrar Musicas no Album</a>

              {!! Form::open(['route' => ['albuns.destroy', $albun->id], 'method' => 'DELETE']) !!}
              {!! Form::submit("Deletar albun: $albun->albuns", ['class' => 'alert alert-danger fas fa-trash-alt']) !!}
              {!! Form::close() !!}

              @endif
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  @endsection