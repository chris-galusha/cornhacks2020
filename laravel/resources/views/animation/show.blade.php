@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">
    <div class="box">
      <h1><b>Name:</b> {{ $animation->name }}</h1>
      <ul>
        @if ($animation->data)
          @foreach ($animation->data as $key => $value)
            <li><b>{{ $key }}:</b> {{ $value }}</li>
          @endforeach
        @else
          <li><b>No Data</b></li>
        @endif

      </ul>
    </div>
    <div class="buttons">
      <a href="/animations" class='button is-link'>Back</a>
      <a href="/animations/{{ $animation->id }}/edit" class='button is-purple'>Edit</a>
    </div>
  </div>

@endsection('content')
