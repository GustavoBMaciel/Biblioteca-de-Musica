@extends('layouts.app')
@section('content')
<div class="container">

      <h2 class="panel-heading">Musicas</h2>

      <a href="{{url('/home')}}" class="alert alert-success fas fa-undo "> Voltar</a>
      @if ( Auth::check() ) 
      @if(Auth::user()->permissao == 'user' || Auth::user()->permissao == 'admin' )
      <a href="{{url('/musicas/create')}}" class="alert alert-success fas fa-plus-square"> Cadastrar</a>
      @endif
      @endif

      <table  class="table table-striped">
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Duração</th>
          <th>Compositor</th>
          <th>Ordenação</th>
          <th width="300px">Ações</th>
        </tr>
        @foreach ($musicas as $musica)
        <tr>
          <td>{{$musica->id}}</td>
          <td>{{$musica->nome}}</td>
          <td>{{$musica->duracao}}</td>
          <td>{{$musica->compositor}}</td>
          <td>{{$musica->numero}}</td>
          <td>
              <a href="{{route('musicas.show', $musica->id)}}" class="alert alert-primary fas fa-eye"> Detalhes
                </a>

                @if ( Auth::check() ) 
                @if(Auth::user()->permissao == 'user' || Auth::user()->permissao == 'admin' )
            <a href="{{route('musicas.edit', $musica->id)}}" class="alert alert-success fas fa-pencil-alt"> Editar
            </a>

            {!! Form::open(['route' => ['musicas.destroy', $musica->id], 'method' => 'DELETE']) !!}
             <button type="submit" class="alert alert-danger fas fa-trash-alt"> Deletar Musica: {{$musica->nome}}</button>
            {!! Form::close() !!}
              @endif
              @endif
          </td>
        </tr>
        @endforeach
      </table>

      <hr>

      {!! $musicas->links() !!}
    </div>
  @endsection
