@extends('layouts.app')

@section('content')
<div class="container">

  <h2 class="panel-heading">{{$musicaEdit->id or 'Nova'}}</h2>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger">
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($musicaEdit))
  {!! Form::model($musicaEdit, ['route' => ['musicas.update', $musicaEdit->id ], 'class' => 'form', 'method' => 'put']) !!}
  @else
  {!! Form::open(['route' => 'musicas.store', 'class' => 'form']) !!}
  @endif
  <div class="form-group col-md-6">
    {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
  </div>
  <div class="form-group col-md-12">
    {!! Form::text('duracao', null, ['class' => 'form-control', 'placeholder' => 'Duração:']) !!}
  </div>
  <div class="form-group col-md-6">
    {!! Form::text('compositor', null, ['class' => 'form-control', 'placeholder' => 'Compositor:']) !!}
  </div>
  <div class="form-group col-md-6">
    {!! Form::selectRange('numero', 1, 100, ['class' => 'form-control', 'placeholder' => 'Ordenação:']) !!}
  </div>

  <div class="form-group col-md-12">
    <a href="{{route('musicas.index')}}" class="btn btn-success alert alert-success">Voltar</a>
    {!! Form::submit('Enviar', ['class' => 'btn btn-success alert alert-success']) !!}
    {!! Form::close() !!}
  </div>
</div>
@endsection
