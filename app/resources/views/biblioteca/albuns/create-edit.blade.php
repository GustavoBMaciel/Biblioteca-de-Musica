@extends('layouts.app')

@section('content')
<div class="container">

  <div class="panel-heading">{{$albunEdit->nome or 'Novo'}}</div>


  @if( isset ($errors) && count ($errors) > 0 )
  <div class="alert alert-danger">
    @foreach( $errors->all() as $error )
    <p>{{$error}} </p>
    @endforeach
  </div>
  @endif

  @if(isset ($albunEdit))
  {!! Form::model($albunEdit, ['route' => ['albuns.update', $albunEdit->id ], 'class' => 'form', 'method' => 'put', 'files' => true]) !!}
  @else
  {!! Form::open(['route' => 'albuns.store', 'class' => 'form', 'files' => true]) !!}
  @endif
  <div class="form-group col-md-12">
    {!! Form::file('capa', null, ['class' => 'form-control', 'placeholder' => 'Capa:']) !!}
  </div>
  <div class="form-group col-md-12">
    <select name="idBanda" class="form-control">
      <option value="">Escolha a Banda</option>
      @foreach ($idBanda as $banda)
      <option value="{{$banda->id}}">{{$banda->nome}}</option>
      @endforeach
    </select>
</div>
  <div class="form-group col-md-12">
    {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
  </div>
  <div class="form-group col-md-12">
    {!! Form::text('ano', null, ['class' => 'form-control', 'placeholder' => 'Ano:']) !!}
  </div>
  <div class="form-group col-md-12">
    <select name="idMusica" class="form-control">
      <option value="">Escolha a Musica</option>
      @foreach ($idMusica as $musica)
      <option value="{{$musica->id}}">{{$musica->nome}}</option>
      @endforeach
    </select>
</div>
  <div class="form-group col-md-12">
    <a href="{{route('albuns.index')}}" class="btn btn-success alert alert-success">Voltar</a>
    {!! Form::submit('Enviar', ['class' => 'btn btn-success alert alert-success']) !!}
    {!! Form::close() !!}
  </div>
</div>
@endsection
