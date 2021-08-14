@extends('templates.main')

@section('content')

<h1>Edit book {{ $book->id }}</h1>
<div class="card p-3 w-50">
    <form method="POST" action="{{ route('admin.books.update', [$book->id]) }}">
        @method('PATCH')
        @include('admin.books.form', ['edit' => true])
    </form>
</div>
@endsection