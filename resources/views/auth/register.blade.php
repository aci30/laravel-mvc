@extends('templates.main')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="container w-50 mx-auto">
        @csrf
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="name" type="text" required value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" required value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" required class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm password</label>
            <input name="password_confirmation" type="password" required class="form-control">
        </div>
        <div class="mb-3 form-check">
            <input name="remember" type="checkbox" class="form-check-input">
            <label class="form-check-label">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection