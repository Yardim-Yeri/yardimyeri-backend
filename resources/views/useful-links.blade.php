@extends('layouts.master')

@section('content')
    <h1>Yararlı Linkler</h1>
    <div class="row align-item-center justify-content-center mt-4 pt-4">
        <ol class="list-group list-group-numbered">
            @foreach ($links as $link)

            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class="ms-2 me-auto">
                <div class="fw-bold"><a href="https://{{ $link->url }}">{{ $link->title }}</a></div>
                {{ $link->description }}
              </div>
            </li>
            @endforeach
          </ol>
    </div>
@endsection
