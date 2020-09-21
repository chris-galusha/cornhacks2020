@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">

    <form class="form" action="/animations" method="post" enctype="multipart/form-data">
      @csrf

      <div class="field">
        <div class="control">
          <label class='label'>
            Name:
            <input type="text" class='input is-rounded' name="name" value="{{ old('name') }}" placeholder="Name..." required>
          </label>
        </div>
      </div>

      <div class="file has-name is-boxed is-info">
        <label class="file-label">
          <input class="file-input" type="file" name="animation">
          <span class="file-cta">
            <span class="file-icon">
              <i class="fas fa-upload"></i>
            </span>
            <span class="file-label">
              Choose a file…
            </span>
          </span>
          <span class="file-name">
            File Name...
          </span>
        </label>
      </div>

      <div class="buttons">
        <a href="/animations" class='button is-link'>Back</a>
        <button type="submit" class='button is-success'>Create</button>
      </div>

    </form>

  </div>

@endsection('content')
