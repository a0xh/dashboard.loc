<li class="card mb-2">
    <div class="card-body p-lg-4 p-3">
        <div class="d-flex mb-3 pb-3 border-bottom flex-wrap">

            @isset ($comment->user->avatar)
                <img class="avatar rounded" src="{{ Storage::url($comment->user->avatar) }}">
            @else
                <img class="avatar rounded" src="{{ asset('assets/img/avatar/user-1.svg') }}">
            @endisset

            <div class="flex-fill ms-3 text-truncate">
                <h6 class="mb-0"><span>{{ $comment->user->name ?? null }}</span></h6>
                <span class="text-muted">{{ $comment->created_at ?? null }}</span>
            </div>

            <div class="d-flex align-items-center">
                <span class="mb-2 me-3">
                    <div class="btn-group" role="group" aria-label="comments">

                        <a class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#replay-{{ $comment->id ?? null }}" title="Ответить">
                            <i class="icofont-reply text-info"></i>
                        </a>

                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#comment-{{ $comment->id ?? null }}" title="Отредактировать"><i class="icofont-edit text-success"></i></button>
                        
                        @if (Route::has('admin.comments.destroy'))
                            <form onsubmit="if (confirm('Вы действительно хотите удалить данную запись из таблицы?')) {return true} else {return false}" action="{{ route('admin.comments.destroy', $comment ?? null) }}" method="post">

                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-outline-secondary" title="Удалить"><i class="icofont-ui-delete text-danger"></i></button>
                            </form>
                        @endif

                    </div>
                </span>
            </div>

        </div>

        <div class="timeline-item-post">

            @isset ($comment->type)
                @switch($comment->type)
                    @case('post')
                        <h6>{{ $comment->post->title ?? null }}</h6>
                        @break
                    @case('product')
                        <h6>{{ $comment->product->title ?? null }}</h6>
                        @break
                @endswitch
            @endisset

            <p>{{ $comment->content ?? null }}</p>

            <div class="collapsed">
                <div id="replay-{{ $comment->id ?? null }}" class="collapse mt-4 mb-4">
                    @include('admin.comments.partials._create')
                </div>
            </div>

            @isset ($comment->childrenComments)
                @foreach ($comment->childrenComments as $childrenComment)
                    @include('admin.comments.partials._parent', [
                        'comment' => $childrenComment
                    ])
                @endforeach
            @endisset

        </div>
    </div>
</li>