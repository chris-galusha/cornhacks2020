@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">

    <form class="form" action="/lights" method="post">
      @csrf

      <div class="field">

        <div class="control">
          <label class='label'>
            Name:
            <input type="text" class='input is-rounded' name="name" value="{{ old('name') }}" placeholder="Name..." required>
          </label>
        </div>

      </div>

      <div class="field">
        <div class="control">
          <label class='label'>
            Location:
            <input type="text" class='input is-rounded' name="location" value="{{ old('location') }}" placeholder="Location..." required>
          </label>
        </div>
      </div>

      <div class="field">
        <div class="control">
          <label class='label'>
            IP Address:
            <input type="text" class='input is-rounded' name="ip_address" value="{{ old('ip_address') }}" placeholder="IP Address..." required>
          </label>
        </div>
      </div>

      <div class="buttons">
        <a href="/lights" class='button is-link'>Back</a>
        <button type="submit" class='button is-success'>Create</button>
      </div>

    </form>

  </div>

@endsection('content')
