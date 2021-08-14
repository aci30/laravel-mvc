@csrf
<div class="mb-3">
    <label class="form-label">Name</label>
    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
        value="@if (isset($author)){{ $author->name }}@else{{ old('name') }}@endif">
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Books</label>
    <select name="bookIds[]" multiple class="form-control">
        @foreach($ownedBooks as $ownedBookId => $ownedBookTitle)
        <option selected value="{{ $ownedBookId }}">
            {{ $ownedBookTitle }}
        </option>
        @endforeach
        @foreach($anonBooks as $anonBookId => $anonBookTitle)
        <option value="{{ $anonBookId }}">
            {{ $anonBookTitle }}
        </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-primary">Submit</button>