@extends('layouts.master')

@section('content')
    <h1>Yararlı Linkler</h1>
    <ul>
        @foreach ($links as $link)
            <li><a href="https://{{ $link->url }}">{{ $link->title }}</a></li>
        @endforeach
    </ul>
@endsection
