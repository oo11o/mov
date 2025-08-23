@extends('article.index')

@section('content')
    <section id="intro">
        <h1>{{ $article->h1 }}</h1>
        <p>
            {{ $article->intro }}
        </p>
    </section>

    <section id="similar">
        @foreach($article->movies as $movie)
            <li>{{ $movie->title }} ({{ $movie->year }})</li>
        @endforeach
    </section>
@endsection

