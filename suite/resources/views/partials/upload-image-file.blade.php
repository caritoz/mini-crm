<div class="form-group">
    <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" {{$required}} autocomplete="avatar" autofocus/>
    @error('avatar')
    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>
