@extends('templates.main')

@section('content')

<h1> Create new book </h1>
<div class="card p-3 w-50">
    <form method="POST" action="{{ route('admin.books.store') }}">
        @include('admin.books.form')
    </form>
</div>
@endsection