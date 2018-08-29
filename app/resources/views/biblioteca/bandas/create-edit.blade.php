@extends('layouts.app')

@section('content')
<div class="container">

  <h2 class="panel-heading">{{$bandaEdit->nome or 'Novo'}}</h2>

  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger">
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($bandaEdit))
  {!! Form::model($bandaEdit, ['route' => ['bandas.update', $bandaEdit->id ], 'class' => 'form', 'method' => 'put', 'files' => true]) !!}
  @else
  {!! Form::open(['route' => 'bandas.store', 'class' => 'form', 'files' => true]) !!}
  @endif
  <div class="form-group col-md-12">
      {!! Form::file('imagem', null, ['class' => 'form-control', 'placeholder' => 'Imagem:']) !!}
    </div>
  <div class="form-group col-md-12">
    {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
  </div>
  <div class="form-group col-md-6">
    {!! Form::text('genero', null, ['class' => 'form-control', 'placeholder' => 'Genero:']) !!}
  </div>
  <div class="form-group col-md-12">
    {!! Form::textarea('descricao', null, ['class' => 'form-control', 'placeholder' => 'Descrição:']) !!}
  </div>
  <div class="form-group col-md-12">
    <a href="{{route('bandas.index')}}" class="btn btn-success alert alert-success">Voltar</a>
    {!! Form::submit('Enviar', ['class' => 'btn btn-success alert alert-success']) !!}
    {!! Form::close() !!}
  </div>
</div>
@endsection
