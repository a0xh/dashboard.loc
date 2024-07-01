<li class="card mb-2">
    <div class="card-body p-lg-4 p-3">
        <div class="d-flex mb-3 pb-3 border-bottom flex-wrap">

            @isset ($comment->user->media)
                <img src="{{ Storage::url($comment->user->media) }}" class="avatar rounded">
            @else
                <img src="{{ asset('assets/img/user.png') }}" class="avatar rounded">
            @endisset

            <div class="flex-fill ms-3 text-truncate">
                <h6 class="mb-0">
                    <span>{{ $comment->user->first_name ?? null }} {{ $comment->user->last_name ?? null }}</span>
                </h6>

                <span class="text-muted">{{ $comment->created_at ?? null }}</span>
            </div>

            <div class="d-flex align-items-center">
                <span class="mb-2 me-3">
                    <div class="btn-group" role="group" aria-label="btn-group">

                        <a class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#replay-{{ $comment->id ?? null }}" title="{{ __('Ответить') }}">
                            <i class="icofont-reply text-info"></i>
                        </a>

                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#comment-{{ $comment->id ?? null }}" title="{{ __('Отредактировать') }}">
                            <i class="icofont-edit text-success"></i>
                        </button>
                        
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

        <div class="timeline-item-post">

            @isset ($comment->products)
                @foreach ($comment->products as $product)
                    <h6>{{ $product->title ?? null }}</h6>
                @endforeach
            @endisset

            @isset ($comment->posts)
                @foreach ($comment->posts as $post)
                    <h6>{{ $post->title ?? null }}</h6>
                @endforeach
            @endisset

            <p>{{ $comment->content ?? null }}</p>

            <div class="collapsed">
                <div id="replay-{{ $comment->id ?? null }}" class="collapse mt-4 mb-4">
                    @includeIf('comment.partials._create')
                </div>
            </div>

            @isset ($comment->childrenComments)
                @foreach ($comment->childrenComments as $childrenComment)
                    @includeIf('comment.partials._parent', [
                        'comment' => $childrenComment
                    ])
                @endforeach
            @endisset

        </div>
    </div>
</li>