@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content center is-yellow-gradient is-rounded">
    <h1>Manage all your LED strips with ease!</h1>
    <div class="">
      <h4>
        Have you ever wanted to manage all your LED strips from one place,
        and connect devices like Amazon Alexa or your own service to remotely control them?
        Cornhacks Lights makes this admirable goal simple and smart.
      </h4>
    </div>
  </div>
@endsection('content')
