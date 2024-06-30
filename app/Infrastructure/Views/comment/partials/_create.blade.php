<form method="post" action="{{ route('admin.comments.store') }}">

    @csrf

    <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" aria-label="content" autocomplete="content">{{ $comment->user->name ?? null }}, </textarea>

    @error('content')
        <span role="alert" class="invalid-feedback">{{ $message }}</span>
    @enderror

    <input type="hidden" name="type" value="{{ $comment->type ?? null }}">
    <input type="hidden" name="comment_id" value="{{ $comment->id ?? null }}">

    @switch($comment->type)
        @case('post')
            <input type="hidden" name="post_id" value="{{ $comment->post_id ?? null }}">
            @break
        @case('product')
            <input type="hidden" name="product_id" value="{{ $comment->product_id ?? null }}">
            @break
    @endswitch

    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ __('Отправить') }}</button>

</form>