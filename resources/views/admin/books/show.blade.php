@extends('templates.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="">{{ $book->title }}</h1>
        </div>
    </div>
    @if ($book->author)
    <div class="row">
        <div class="col-12">
            <p class="lead text-right">Author:
            @if ($book->author)
                <a href="{{ route('author', $book->author->id) }}">{{ $book->author->name }}</a>
            @else
                Null
            @endif
            </p>
        </div>
    </div>
    @endif
        </div>
        <div class="card p-3">
            <p>
                {{ $book->text }}
            </p>
        </div>
@endsection