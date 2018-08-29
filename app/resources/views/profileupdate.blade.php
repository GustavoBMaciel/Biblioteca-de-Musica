@extends('layouts.app')

@section('content')
<div class="container">

  <h2 class="panel-heading">{{$usersEdit->name}}</h2>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger">
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($usersEdit))
  {!! Form::model($usersEdit, ['route' => ['users.update', $usersEdit->id ], 'class' => 'form', 'method' => 'put', 'files' => true]) !!}
  @else
  {!! Form::open(['route' => ['users.update', $usersEdit->id], 'enctype' => 'multipart/form-data', 'class' => 'form', 'files' => true]) !!}
  @endif
  <div class="card-body">
        <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Selecione a Imagem</label>
  <div class="col-md-6">
      <input type="file" name="imagem" value="null" placeholder="Selecione a Imagem: ">
  </div>
</div>

  <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Digite o Nome</label>
  <div class="col-md-6">
    {!! Form::text('name', $usersEdit->name, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
  </div>
</div>

  <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Digite o Email</label>
  <div class="col-md-6">
        {!! Form::email('email', $usersEdit->email, ['class' => 'form-control', 'placeholder' => 'Email:']) !!}
  </div>
</div>

<div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Digite a Senha</label>

        <div class="col-md-6">
            <input id="password" type="password" value="{{$usersEdit->password}}" class="form-control{{ $errors->has('password') ? ' invalida' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

  <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirme a Senha</label>

        <div class="col-md-6">
            <input id="password-confirm" value="{{$usersEdit->password}}" type="password" class="form-control" name="password_confirmation" required>
        </div>
  </div>

  <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Selecione uma Permissao</label>
  <div class="col-md-6">
    <select name="permissao" class="form-control">
      <option value="">Escolha a Permissão</option>
      <option value="user">Usuarios</option>
      <option value="admin">Administradores</option>
    </select>
  </div>

  
</div>


</div>
<a href="{{url('/users')}}" class="btn btn-success alert alert-success "> Voltar</a>
{!! Form::submit('Enviar', ['class' => 'btn btn-success alert alert-success']) !!}
{!! Form::close() !!}
</div>
@endsection
