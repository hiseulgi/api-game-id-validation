@extends('layout.master')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box">
        <h1 class="page-title text-center">Game List</h1>
      </div>
    </div>
  </div>
  <!-- end page title -->

  <div class="row">
    @foreach($gamelists as $game)

    <div class="col-md-6 col-lg-3">
      <div class="card h-auto d-inline-block">
        <img src="{{$game->icon_url}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title"><a href="{{ route('gamedetail.index', $game->game_code) }}" class="text-dark stretched-link text-center">{{$game->game_name}}</a></h5>
        </div> <!-- end card-body -->
      </div> <!-- end card -->
    </div> <!-- end col-->
    @endforeach

  </div>
  <!-- end row -->
  @endsection