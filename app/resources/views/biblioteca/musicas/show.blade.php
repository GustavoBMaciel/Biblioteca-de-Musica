@extends('layouts.app')
@section('content')

<div class="container">


<table  class="table table-striped">
<p><b>Nome:</b> {{$musicaShow->nome}}</p>
<p><b>Duração:</b> {{$musicaShow->duracao}}</p>
<p><b>Nome:</b> {{$musicaShow->nome}}</p>
<p><b>Compositor:</b> {{$musicaShow->compositor}}</p>
<p><b>Ordenação:</b> {{$musicaShow->numero}}</p>
</table>
<a href="{{route('musicas.index')}}" class="btn btn-success">Voltar</a>

<hr>
@if( isset ($errors) && count ($errors) > 0 )
<div class="alert alert-danger">
  @foreach( $errors->all() as $error )
  <p>{{$error}} </p>
  @endforeach
</div>
@endif
</div>
@endsection
