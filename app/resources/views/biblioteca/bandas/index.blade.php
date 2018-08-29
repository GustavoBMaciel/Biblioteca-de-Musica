@extends('layouts.app')
@section('content')
<div class="container">


    
      <h2 class="panel-heading">Bandas/Artistas</h2>
      <a href="{{url('/home')}}" class="alert alert-success fas fa-undo  "> Voltar</a>

      @if ( Auth::check() ) 
      @if(Auth::user()->permissao == 'user' || Auth::user()->permissao == 'admin' )
      <a href="{{url('/bandas/create')}}" class="alert alert-success fas fa-plus-square"> Cadastrar</a>
      @endif
      @endif
      <div class="row">
          @foreach ($bandas as $banda)
              <div class="col-md-4">
                  <div class="card mb-4" >
                    <img class="card-img-top" src="{{ url('/imgBanda', $banda->imagem )}}" style="width:348px; height:348px; margin-right:25px;"alt="">
                    <div class="card-body">
                      <h5 class="card-title">{{$banda->nome}}</h5>
                      <p class="card-text">{{$banda->descricao}}</p>
                      <a href="{{route('bandas.show', $banda->id)}}" class=" alert alert-primary fas fa-eye">Detalhes</a>

                      @if ( Auth::check() ) 
                      @if (Auth::user()->permissao == 'admin' || Auth::user()->permissao == 'admin')
                      <a href="{{route('bandas.edit', $banda->id)}}" class="actions edit">
                        <span class="alert alert-success fas fa-pencil-alt"> Editar</span></a>

                        {!! Form::open(['route' => ['bandas.destroy', $banda->id], 'method' => 'DELETE']) !!}
                        {!! Form::submit("Deletar banda: $banda->nome", ['class' => 'alert alert-danger fas fa-trash-alt']) !!}
                        {!! Form::close() !!}
                    @endif
                    @endif

                </div>
              </div>
            </div>
        @endforeach
          </div>
      {!! $bandas->links() !!}




    
  </div>
  @endsection
