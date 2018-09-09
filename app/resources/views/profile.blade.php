@extends('layouts.app')

@section('content')
<div class="container">

        @if (\Session::has('errors'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('errors') !!}</li>
        </ul>
    </div>
    @endif

    <h2 class="panel-heading">Usuarios</h2>
    <a href="{{url('/home')}}" class="alert alert-success fas fa-undo  "> Voltar</a>
    <a href="{{url('/register')}}" class="alert alert-success fas fa-plus-square"> Cadastrar</a>

    <div class="row">
            @foreach($users as $user)
            <div class="col-md-4">
                         <img src="\imgUser/{{ $user->imagem }}" style="width:150px; height:150px; border-radius:50%; margin-right:25px;">
                         <h2>{{ $user->name }}</h2>
                         <p>Email: {{$user->email}}</p>
                         <p>Permissao: {{$user->permissao}}</p>
                         <a href="{{route('users.edit', $user->id)}}" class="alert alert-success fas fa-pencil-alt">Alterar Dados</a>

                         {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                         {!! Form::submit("Deletar: $user->name", ['class' => 'alert alert-danger fas fa-trash-alt']) !!}
                         {!! Form::close() !!}
            </div>
            @endforeach
               
    </div>
    {!! $users->links() !!}
</div>
@endsection