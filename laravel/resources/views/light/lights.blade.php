@extends('layouts/app')

@section('title', 'Cornhacks')

@section('content')
  @include('snippets/banner')
  @include('snippets/navbar')
  <div class="content">
    <div class="table-container">
      <table class='table is-bordered is-striped is-hoverable is-fullwidth'>
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th>IP Address</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th>IP Address</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($lights as $light)
            <tr>
              <td><a href="/lights/{{ $light->id }}">{{ $light->name }}</a></td>
              <td><a href="/lights/{{ $light->id }}">{{ $light->location }}</a></td>
              <td><a href="/lights/{{ $light->id }}">{{ $light->ip_address }}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="buttons">
        <a href="/lights/create" class='button is-success'>Add New Light</a>
      </div>
    </div>
  </div>
@endsection('content')
