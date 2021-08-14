@extends('templates.main')

@section('content')
   <div class="row">
      <div class="col-12">
         <h1 class="float-start">Authors</h1>
         <a href="{{ route('admin.authors.create')}}" class="btn btn-lg ms-3 btn-success" role="button">Create</a> 
      </div>
      <div class="card p-3">
         <table class="table">
            <thead>
               <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Books</th>
                  <th scope="col">Action</th>
               </tr>
            </thead>
            <tbody>
            @foreach($authors as $author)
               <tr>
                  <th scope="row">{{$author->id}}</th>
                  <td><a href="{{ route('admin.authors.show', $author->id) }}" >{{ $author->name }}</a></td>
                  @if ($author->hasBooks())
                  <td>
                     <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                           Books
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach ($author->books as $book)
                           <li><a class="dropdown-item" href="{{ route('admin.books.show', $book->id) }}">{{$book->title}}</a></li>
                        @endforeach
                        </ul>
                     </div>
                  </td>
                  @else
                  <td>No books yet</td>
                  @endif
                  <td> <a href="{{ route('admin.authors.edit', $author->id)}}" class="btn btn-sm btn-primary" role="button">Edit</a> 
                     <button type="button" class=" btn btn-sm btn-danger"
                     onclick="event.preventDefault();
                     document.getElementById('delete-author-form-{{$author->id}}').submit()">
                     DELETE
                     </button> 
                  
                  </td>
                  <form id="delete-author-form-{{ $author->id}}" action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" style="display: none">
                     @csrf
                     @method("DELETE")
                  </form>
               </tr>
            @endforeach
            </tbody>
         </table>
         {{ $authors->links() }}
      </div>
   </div>
@endsection