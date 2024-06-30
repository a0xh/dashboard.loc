<div class="modal fade" id="comment-{{ $comment->id ?? null }}" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.comments.update', $comment ?? null) }}" class="modal-content" enctype="multipart/form-data">

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
                                @isset ($comment->type)
                                    @switch($comment->type)
                                        @case('post')
                                            <label class="form-label">{{ __('Название поста') }}</label>
                                            <span class="form-control input-group-text">{{ $comment->post->title ?? null }}</span>
                                            @break
                                        @case('product')
                                            <label class="form-label">{{ __('Название товара') }}</label>
                                            <span class="form-control input-group-text">{{ $comment->product->title ?? null }}</span>
                                            @break
                                    @endswitch
                                @endisset
                            </div>

                            <div class="col-md-12">
                                <label for="content" class="form-label">{{ __('Текст комментария') }}</label>

                                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" aria-label="content" autocomplete="content">{{ $comment->content ?? old('content') }}</textarea>

                                @error('content')
                                    <span role="alert" class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="content" class="form-label">{{ __('Автор комментария') }}</label>

                                <span class="form-control input-group-text">{{ $comment->user->name ?? null }}</span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">{{ __('Статус') }}</label>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">

                                            @isset ($category->status)
                                                <input id="status" type="radio" name="status" value="on" class="form-check-input" @checked($comment->status == true)>
                                            @else
                                                <input id="status" type="radio" name="status" value="on" class="form-check-input" @checked(old('status') == true)>
                                            @endisset

                                            <label for="status" class="form-check-label">{{ __('Одобренный') }}</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-check">

                                            @isset ($category->status)
                                                <input id="status" type="radio" name="status" value="off" class="form-check-input" @checked($comment->status == false)>
                                            @else
                                                <input id="status" type="radio" name="status" value="off" class="form-check-input" @checked(old('status') == false)>
                                            @endisset

                                            <label for="status" class="form-check-label">{{ __('Не одобренный') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Закрыть') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Сохранить') }}</button>
                </div>
                
            </form>

        </div>
    </div>
</div>