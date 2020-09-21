@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">
    <h1>Select an Animation</h1>
    <form class="form" action="/lights/{{ $light->id }}/animate/update" method="post">
      @csrf
      <input type="hidden" name="light" value="{{ $light->name }}">
      <div class="field">
        <div class="select">
          <select class="" name="animation">
            @foreach ($animations as $animation)
              <option value="{{ $animation->name }}">{{ $animation->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="buttons">
        <a href="/lights" class='button is-link'>Back</a>
        <button type="submit" class='button is-primary'>Animate</button>
      </div>
    </form>
  </div>
@endsection('content')
