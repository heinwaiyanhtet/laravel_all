<div class="mb-3">
    <label class="form-label">{{ $title }}</label>
    <input type="text" class="form-control @error($name) is-invalid @enderror" value="{{ old($name,$default) }}" @if($formId) form="{{ $formId }}" @endif name="{{ $name }}">
    @error($name)
    <p class="text-danger small">{{ $message }}</p>
    @enderror
</div>
