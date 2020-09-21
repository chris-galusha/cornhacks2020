@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">

    <form class="form" action="/services" method="post">
      @csrf

      <div class="field">

        <div class="control">
          <label class='label'>
            Name:
            <input type="text" class='input is-rounded' name="name" value="{{ old('name') }}" placeholder="Name..." required>
          </label>
        </div>
      </div>

      <div class="buttons">
        <a href="/services" class='button is-link'>Back</a>
        <button type="submit" class='button is-success'>Create</button>
      </div>

    </form>

  </div>

@endsection('content')
