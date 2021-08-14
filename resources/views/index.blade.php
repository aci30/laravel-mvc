@extends('templates.main')

@section('content')
<div class="container">
   <div class="row">
      <div class="col-md-8">
         <div class="card">
            <h3 class="card-header">Books</h3>
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Title</th>
                     <th scope="col">Text</th>
                     <th scope="col">Author</th>
                  </tr>
               </thead>
               <tbody>
               @foreach($books as $book)
                  <tr>
                     <th scope="row">{{ $book->id }}</th>
                     <td><a href="{{ route('book', $book->id) }}" >{{ $book->title }}</a></td>
                     <td>{{ $book->getDescription(30) }}</td>
                     @if ($book->author)
                     <td><a href="{{ route('author', $book->author->id) }}">{{ $book->author->name }}</a></td>
                     @else
                     <td>Null</td>
                     @endif
                  </tr>
               @endforeach
               </tbody>
            </table>
            {{ $books->links() }}
        </div>
      </div>
      <div class="col-md-4">
         <div class="card">
            <h3 class="card-header">Authors</h3>
            @foreach($authors as $author)
               <h5 class="m-2"><a href="{{ route('author', $author->id) }}">{{ $author->name }}</a></h5>
            @endforeach
         </div>
      </div>
   </div>
</div>
@endsection