<div class="modal fade" id="comment-{{ $comment->id }}" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            @if (Route::has('admin.comment.update'))
                <form method="post" action="{{ route('admin.comment.update', $comment) }}" class="modal-content" enctype="multipart/form-data">

                    @method('PUT')
                    @csrf

                    <div class="modal-header">
                        <h5 id="comment" class="modal-title fw-bold">{{ __('Редактирование комментария') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="deadline-form">
                            <div class="row g-3 mb-3">

                                <div class="col-sm-12">
                                    @isset ($comment->products)
                                        @foreach ($comment->products as $product)
                                            <label class="form-label">{{ __('Название товара') }}</label>
                                            <span class="form-control input-group-text">{{ $product->title ?? null }}</span>
                                        @endforeach
                                    @endisset

                                    @isset ($comment->posts)
                                        @foreach ($comment->posts as $post)
                                            <label class="form-label">{{ __('Название поста') }}</label>
                                            <span class="form-control input-group-text">{{ $post->title ?? null }}</span>
                                        @endforeach
                                    @endisset
                                </div>

                                {{-- ================ Start Content Comment ================ --}}
                                <div class="col-md-12">
                                    <label for="text" class="form-label">{{ __('Текст комментария') }}</label>

                                    <textarea id="text" name="text" class="form-control @error('text') is-invalid @enderror" aria-label="text" autocomplete="text">{{ $comment->content ?? old('text') }}</textarea>

                                    <x-error-field name="text" />
                                </div>
                                {{-- ================ End Content Comment ================ --}}

                                <div class="col-md-6">
                                    <label for="content" class="form-label">{{ __('Автор комментария') }}</label>

                                    <span class="form-control input-group-text">{{ $comment->user->first_name ?? null }} {{ $comment->user->last_name ?? null }}</span>
                                </div>

                                {{-- ================ Start Status Comment ================ --}}
                                <div class="col-sm-6">
                                    <label class="form-label">{{ __('Статус') }}</label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">

                                                @isset ($comment->status->value)
                                                    <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked($comment->status->value == true)>
                                                @else
                                                    <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked(old('status') == true)>
                                                @endisset

                                                <label for="status" class="form-check-label">{{ __('Одобренный') }}</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-check">

                                                @isset ($comment->status->value)
                                                    <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked($comment->status->value == false)>
                                                @else
                                                    <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked(old('status') == false)>
                                                @endisset

                                                <label for="status" class="form-check-label">{{ __('Не одобренный') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ================ End Status Comment ================ --}}

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

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Закрыть') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                    </div>
                    
                </form>
            @endif

        </div>
    </div>
</div>