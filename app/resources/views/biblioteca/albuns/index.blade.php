@extends('layouts.app')
@section('content')
<div class="container">

      <div class="panel-heading">Albuns</div>

      <a href="{{url('/home')}}" class="alert alert-success fas fa-undo  "> Voltar</a>
      @if ( Auth::check() ) 
      @if(Auth::user()->permissao == 'user' || Auth::user()->permissao == 'admin' )
      <a href="{{route('albuns.create')}}" class="alert alert-success fas fa-plus-square"> Cadastrar</a>
      @endif
      @endif

        @foreach ($albuns as $albun)

        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{ url('/capas', $albun->capa )}}" alt="">
            <div class="card-body">
              <h5 class="card-title">{{$albun->nome}}</h5>
              @foreach ($idBandas as $idBanda)
              <p class="card-text">{{$idBanda}}</p>
              @endforeach
              <p class="card-text">{{$albun->ano}}</p>
              <a href="{{route('albuns.show', $albun->id)}}" class=" alert alert-primary fas fa-eye">Detalhes</a>

              @if ( Auth::check() ) 
              @if(Auth::user()->permissao == 'user' || Auth::user()->permissao == 'admin' )
              <a href="{{route('albuns.edit', $albun->id)}}" class="alert alert-success fas fa-pencil-alt"> Editar</a>

              <a href="{{route('adicionamusica.show', $albun->id)}}" class="alert alert-success fas fa-plus-square"> Cadastrar Musicas no Album</a>

              {!! Form::open(['route' => ['albuns.destroy', $albun->id], 'method' => 'DELETE']) !!}
              {!! Form::submit("Deletar albun: $albun->nome", ['class' => 'alert alert-danger fas fa-trash-alt']) !!}
              {!! Form::close() !!}

              @endif
              @endif
            </div>
          </div>

        @endforeach
      </table>

      {!! $albuns->links() !!}


    </div>

    
  </div>
  @endsection