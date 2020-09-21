@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">
    <div class="box">
      <h1><b>Name:</b> {{ $service->name }}</h1>
      <ul>
        <li><b>API Token:</b> {{ $service->api_token->api_token ?? 'No Token'}}</li>
      </ul>
    </div>
    <div class="buttons">
      <a href="/services" class='button is-link'>Back</a>
      <a href="/services/{{ $service->id }}/edit" class='button is-purple'>Edit</a>
    </div>
  </div>

@endsection('content')
