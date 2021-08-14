@extends('templates.main')

@section('content')

<h1>Edit author {{ $author->name }}</h1>
<div class="card p-3 w-50">
    <form method="POST" action=" {{ route('admin.authors.update', $author->id) }}">
        @method('PATCH')
        @include('admin.authors.form')
    </form>
</div>
@endsection