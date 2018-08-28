@extends('layouts.appHome')

@section('content')


<div class="container">
  
    @if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
    @endif

    <form class="navbar-form navbar-left" role="search" action="{!! url('/pesquisar') !!}" method="post" style="margin-left: 25%;margin-bottom: 3%;">

        <div class="form-group">
          {!! csrf_field() !!}
          <input type="text" name="texto" class="form-control" placeholder="Pesquisar" style="width: 600px;">

        </div>
    </form>
        
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">


    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">Sobre</h4>
              <p class="text-muted">Desenvolvido por Gustavo Barros Maciel. Essa aplicação foi feita com a dedicação total. Espero que gostem!!</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contato</h4>
              <ul class="list-unstyled">
                <li><a href="https://www.facebook.com/Gustavo.Maciel.DF" target="_blank" class="text-white">Facebook</a></li>
                <li><a href="https://www.linkedin.com/in/gustavo-barros-maciel" target="_blank" class="text-white">Linkedin</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>Bibi Musica</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Bibi Musicas</h1>
          <p class="lead text-muted">Site completo para acompanhar seu artista/banda preferido(a).</p>
          <p>
            <a href="{{ url('/bandas') }}" class="btn btn-secondary my-2">Artista/Bandas</a>
            <a href="{{ url('/musicas') }}" class="btn btn-secondary my-2">Musicas</a>
            <a href="{{ url('/albuns') }}" class="btn btn-secondary my-2">Albuns</a>

            @if ( Auth::check() ) 
            @if ( Auth::user()->permissao == 'admin') 
            <a href="{{ url('/users') }}" class="btn btn-secondary my-2">Usuarios</a>
            @endif
            @endif
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">


    </main>


</div>
@endsection
