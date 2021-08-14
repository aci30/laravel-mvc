@extends('templates.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="float-start">Books</h1>
            <a href="{{ route('admin.books.create')}}" class="btn ms-3 btn-lg btn-success" role="button">Create</a> 
        </div>
        <div class="card p-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Text</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <th scope="row">{{ $book->id }}</th>
                        <td><a href="{{ route('admin.books.show', $book->id) }}" >{{ $book->title }}</a></td>
                        <td>{{ $book->getDescription(20) }}</td>
                        @if ($book->author)
                        <td><a href="{{ route('admin.authors.show', $book->author->id) }}">{{ $book->author->name }}</a></td>
                        @else
                        <td>Null</td>
                        @endif
                        <td><a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-primary" role="button">Edit</a> 
                            <button type="button" class=" btn btn-sm btn-danger"
                            onclick="event.preventDefault();
                            document.getElementById('delete-book-form-{{ $book->id }}').submit()">
                            DELETE
                            </button> 
                    
                        </td>
                        <form id="delete-book-form-{{ $book->id }}" action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display: none">
                            @csrf
                            @method("DELETE")
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>

@endsection