{{--@extends('article.index')--}}

{{--@section('content')--}}
    @foreach($movies as $movie)
        <li>{{ $movie->title }} ({{ $movie->year }})</li>
    @endforeach
{{--@endsection--}}
