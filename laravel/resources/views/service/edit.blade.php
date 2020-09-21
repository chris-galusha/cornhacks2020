@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">

    <form class="form" action="/services/{{ $service->id }}" method="post">
      @csrf
      @method('PATCH')

      <div class="field">

        <div class="control">
          <label class='label'>
            Name:
            <input type="text" class='input is-rounded' name="name" value="{{ old('name') ?? $service->name }}" placeholder="Name..." required>
          </label>
        </div>

      </div>

      <div class="buttons">
        <a href="/services" class='button is-link'>Back</a>
        <button type="submit" class='button is-purple'>Update</button>
      </div>

    </form>

    <form class="form" action="/services/{{ $service->id }}" method="post">
      @csrf
      @method('DELETE')
      <div class="buttons">
        <button type="submit" class='button is-danger'>Delete</button>
      </div>
    </form>

  </div>

@endsection('content')
