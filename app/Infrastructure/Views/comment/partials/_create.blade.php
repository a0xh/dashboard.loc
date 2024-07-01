@if (Route::has('admin.comment.store'))
    <form method="post" action="{{ route('admin.comment.store') }}">
        @csrf

        <textarea id="text" name="text" class="form-control @error('text') is-invalid @enderror" aria-label="text" autocomplete="text">{{ $comment->user->first_name ?? null }}, </textarea>

        <x-error-field name="text" />

        <input type="hidden" name="comment_id" value="{{ $comment->id ?? null }}">
        
        @isset ($comment->type)
            <input type="hidden" name="type" value="{{ $comment->type }}">
            @switch ($comment->type)
                @case ('product')
                    @isset ($comment->products)
                        @foreach ($comment->products as $post)
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @endforeach
                    @endisset
                    @break
                @case ('post')
                    @isset ($comment->posts)
                        @foreach ($comment->posts as $post)
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                        @endforeach
                    @endisset
                    @break
                @default
            @endswitch
        @endisset

        <input type="hidden" name="status" value="1">

        <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ __('Отправить') }}</button>
    </form>
@endif