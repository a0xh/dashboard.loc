<div>
    <div class="d-flex mb-3 pb-3 border-bottom flex-wrap">

        @isset ($comment->user->media)
            <img class="avatar rounded" src="{{ Storage::url($comment->user->media) }}">
        @else
            <img class="avatar rounded" src="{{ asset('assets/img/avatar/user-1.svg') }}">
        @endisset

        <div class="flex-fill ms-3 text-truncate">
            <p class="mb-0">
                <span>{{ $comment->user->first_name ?? null }} {{ $comment->user->last_name ?? null }}</span>
                <small class="msg-time text-muted">{{ $comment->created_at ?? null }}</small>
            </p>

            @isset ($comment->content)
                <span class="text-muted">{{ Str::limit($comment->content, 110) }}</span>
            @endisset
        </div>
                    
        <div class="d-flex align-items-center">
            <span class="mb-2 me-3">

                <div class="btn-group" role="group" aria-label="btn-group">
                    <a class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#replay-{{ $comment->id ?? null }}" title="{{ __('Ответить') }}">
                        <i class="icofont-reply text-info"></i>
                    </a>

                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#comment-{{ $comment->id ?? null }}" title="{{ __('Отредактировать') }}"><i class="icofont-edit text-success"></i></button>
                    
                    @if (Route::has('admin.comment.delete'))
                        <form onsubmit="if (confirm('{{ __('Вы действительно хотите удалить данную запись из таблицы?') }}')) {return true} else {return false}" action="{{ route('admin.comment.delete', $comment ?? null) }}" method="post">

                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-outline-secondary" title="{{ __('Удалить') }}">
                                <i class="icofont-ui-delete text-danger"></i>
                            </button>
                        </form>
                    @endif
                </div>

            </span>
        </div>

    </div>
</div>

<div class="collapsed">
    <div id="replay-{{ $comment->id ?? null }}" class="collapse mt-4 mb-4">
        @includeIf('comment.partials._create', ['comment' => $comment])
    </div>
</div>


@isset ($comment->comments)
    @includeIf('comment.partials._edit', ['comment' => $comment])
@endisset

@isset ($comment->comments)
    @foreach ($comment->comments as $comment)
        @includeIf('comment.partials._parent', ['comment' => $comment])
    @endforeach
@endisset
