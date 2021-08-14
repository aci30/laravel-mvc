@csrf
<div class="mb-3">
    <label class="form-label">Title</label>
    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" 
        value="@if (isset($book)){{ $book->title }}@else{{ old('title') }}@endif" required>
    @error('title')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Text</label>
    <textarea name="text" rows=10 class="form-control @error('text') is-invalid @enderror" 
        required>@if (isset($book)){{ $book->text }}@else{{ old('text') }}@endif</textarea>
    @error('text')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <select name="authorId" class="form-control">
        <option value="">---Select author---</option>
        @foreach($authors as $authorId => $authorName)
            <option @isset($edit) @if ($book->author && $authorId === $book->author->id) selected @endif @endisset value="{{ $authorId }}">
                {{ $authorName }}
            </option>
        @endforeach
    </select>
    @error('authorId')
    <span class="invalid-feedback" role="alert">
        {{ $message }}
    </span>
@enderror
</div>
<button type="submit" class="btn btn-primary">Submit</button>