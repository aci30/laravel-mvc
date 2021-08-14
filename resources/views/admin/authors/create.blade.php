@extends('templates.main')

@section('content')

<h1> Create new author </h1>
<div class="card p-3 w-50">
    <form method="POST" action=" {{ route('admin.authors.store') }}">
        @include('admin.authors.form')
    </form>
</div>
@endsection