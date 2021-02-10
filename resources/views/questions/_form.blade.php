@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" id="question-title" value="{{ old('title', $question->title) }}" class="form-control">
    @error('title')
    <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="question-body">Explain your question</label>
    <textarea name="body" id="question-body" cols="30" rows="10" class="form-control">{{ old('body',$question->body) }}</textarea>
    @error('body')
    <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-info btn-lg">{{ $buttonText }}</button>
</div>