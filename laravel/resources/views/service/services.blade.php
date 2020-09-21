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
            <th>API Token (Hashed)</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>API Token (Hashed)</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($services as $service)
            <tr>
              <td><a href="/services/{{ $service->id }}">{{ $service->name }}</a></td>
              <td><a href="/services/{{ $service->id }}">{{ $service->api_token->api_token ?? 'No API Token'}}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="buttons">
        <a href="/services/create" class='button is-success'>Add New Service</a>
      </div>
    </div>
  </div>
@endsection('content')
