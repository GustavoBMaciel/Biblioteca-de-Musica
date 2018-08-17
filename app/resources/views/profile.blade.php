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

    <div class="row">
        <div class="col-md-10 ">
            @foreach($users as $user)
            <img src="\imgUser/{{ $user->imagem }}" style="width:150px; height:150px; border-radius:50%; margin-right:25px;">
            <h2>{{ $user->name }}</h2>
            <p>Email: {{$user->email}}</p>
            <a href="{{route('users.edit', $user->id)}}" class="alert alert-success fas fa-pencil-alt">Alterar Dados</a>

            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
            {!! Form::submit("Deletar: $user->name", ['class' => 'alert alert-danger fas fa-trash-alt']) !!}
            {!! Form::close() !!}
            <div></div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection