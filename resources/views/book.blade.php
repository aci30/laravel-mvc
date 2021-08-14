@extends('templates.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <h2>{{ $book->title }}</h2>
            <hr>
            <p class="lead">
                {{ $book->text }}
            </p>
            <hr>
            <p class="lead text-right">Author:
            @if ($book->author)
                <a href="{{ route('author', $book->author->id) }}">{{ $book->author->name }}</a>
            @else
                Null
            @endif
            </p>
            <hr>
        </div>
    </div>
</div>
@endsection