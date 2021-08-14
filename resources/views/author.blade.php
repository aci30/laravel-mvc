@extends('templates.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="float-start">{{ $author->name }}</h1>
        </div>
        <div class="card p-3">
            @if ($author->hasBooks())
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($author->books as $book)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $book->id }}</td>
                            <td><a href="{{ route('book', $book->id) }}">{{ $book->title }}</a></td>
                            <td>{{ $book->getDescription(50) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                No books yet
            @endif
        </div>
    </div>
@endsection