@extends('_layouts.app')

@section('pretitle', 'Petunjuk')

@section('title', 'Petunjuk Penggunaan')

@section('content')

  <div class="card">
    <div class="card-body">
      {!! $help->content_parsed !!}
    </div>
  </div>

@endsection