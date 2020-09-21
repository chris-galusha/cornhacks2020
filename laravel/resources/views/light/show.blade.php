@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">
    <div class="box">
      <h1><b>Name:</b> {{ $light->name }}</h1>
      <ul>
        <li><b>Location:</b> {{ $light->location }}</li>
        <li><b>IP Address:</b> {{ $light->ip_address }}</li>
      </ul>
    </div>
    <div class="buttons">
      <a href="/lights" class='button is-link'>Back</a>
      <a href="/lights/{{ $light->id }}/edit" class='button is-purple'>Edit</a>
      <a href="/lights/{{ $light->id }}/animate" class='button is-primary'>Animate</a>
    </div>
  </div>

@endsection('content')
