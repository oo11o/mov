@extends('.index')

@section('content')
    <h1>{{ $article->h1}}</h1>
    <p>{{ $article->intro }}</p>
    <p>{{ $article->content }}</p>
@endsection
