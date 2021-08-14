@extends('templates.main')

@section('content')
<div class="container d-flex p-5 justify-content-center">
   <div class="card m-4" style="width: 18rem;">
      <div class="card-body d-flex flex-column align-items-center">
         <i class="fas fa-book fa-10x"></i>
         <a href="{{ route('admin.books.index') }}" class="btn btn-lg btn-primary mt-3">Books</a>
      </div>
    </div>
    <div class="card m-4" style="width: 18rem;">
      <div class="card-body d-flex flex-column align-items-center">
         <i class="fas fa-user-circle fa-10x"></i>
         <a href="{{ route('admin.authors.index') }}" class="btn btn-lg btn-primary mt-3">Authors</a>
      </div>
    </div>
</div>
@endsection