<form method="post" action="{{ route('status.store') }}">
    @include('shared._errors')
    @csrf

    <div class="mb-3">
        <label for="content">Content:</label>
        <textarea name="content" class="form-control"  rows="3" placeholder="talk about new things, max 140 words">{{old('content')}}</textarea>
    </div>
    <div CLASS="text-end">
        <button type="submit" class="btn btn-primary">Post</button>
    </div>
</form>
