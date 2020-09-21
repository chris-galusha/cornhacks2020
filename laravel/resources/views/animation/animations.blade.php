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
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($animations as $animation)
            <tr>
              <td><a href="/animations/{{ $animation->id }}">{{ $animation->name }}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="buttons">
        <a href="/animations/create" class='button is-success'>Add New Animation</a>
      </div>
    </div>
  </div>
@endsection('content')
