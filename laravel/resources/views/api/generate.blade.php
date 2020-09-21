@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">
    <div class="box">
      <div class="">
        <h1>Token Generated</h1>
        <h4>Write this token down for use.</h4>
        <div class="box">
          <p>{{ $token }}</p>
        </div>
      </div>
      <form class="form" action="/api/tokens" method="post">
        @csrf
        <div class="select">
          <select class="" name="service_id">
            @foreach ($services as $service)
              <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="buttons">
          <a href="/api/tokens" class='button is-link'>Back</a>
          <button type='submit' class='button is-success'>Assign Token</button>
        </div>
      </form>
    </div>

  </div>

@endsection('content')
