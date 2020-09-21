@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">
    <div class="box">
    @if ($api_tokens->count() == 0)
      <p>No API Tokens are active.</p>
    @endif

    @if (session()->has('token'))
      <h1>New Token Generated:</h1>
      <div class="box">
        <p>{{ session()->get('token') }}</p>
      </div>
    @endif

      @foreach ($api_tokens as $api_token)
        <div class="token">
          <label class='label'>
            <span class='tan'>{{ $api_token->service->name ?? 'Unassigned' }}:</span> Hashed - {{ $api_token->api_token }}
        </label>
          <div class="token-buttons">
            <a href="/api/tokens/{{ $api_token->id }}/regenerate" class='button is-purple'>Regenerate</a>
            <form class="" action="/api/tokens/{{ $api_token->id }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class='button is-danger'>Delete</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
    <div class="buttons">
      <a href="/api/tokens/generate" class='button is-success'>Create Token</a>
    </div>
  </div>

@endsection('content')
