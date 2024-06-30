<div class="card border-0 mb-1">

    <div class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
        <div class="btn-group" role="group" aria-label="btn-group">

            @if (Route::has('admin.post.edit'))
                <a href="{{ route('admin.post.edit', $post) }}" class="btn btn-outline-secondary">
                    <i class="icofont-edit text-success"></i>
                </a>
            @endif
            
            @if (Route::has('admin.post.delete'))
                <form onsubmit="if (confirm('{{ __('Вы действительно хотите удалить данную запись из таблицы') }}?')) {return true} else {return false}" action="{{ route('admin.post.delete', $post) }}" method="post">

                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="icofont-ui-delete text-danger"></i>
                    </button>
                </form>
            @endif

        </div>
    </div>

    <div class="card-body d-flex align-items-center flex-column flex-md-row">

        @isset ($post->media)
            <img class="w120 rounded img-fluid" src="{{ Storage::url($post->media) }}">
        @else
            <img class="w120 rounded img-fluid" src="{{ asset('assets/img/no-data.png') }}">
        @endisset

        <div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">

            <h6 class="mb-3 fw-bold">{{ $post->title ?? null }}
                <span class="text-muted small fw-light d-block">
                    {{ $post->user->first_name ?? null }} {{ $post->user->last_name ?? null }}
                </span>
            </h6>

            <div class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Категория') }}</div>

                    @isset ($post->category)
                        <strong>{{ $post->category->title }}</strong>
                    @else
                        <strong>{{ __('Отсутствует') }}</strong>
                    @endisset
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">Статус</div>

                    <strong>
                        @if ($post->status->value)
                            <span class="badge bg-success">
                                {{ __('Опубликовано') }}
                            </span>
                        @else
                            <span class="badge bg-danger">
                                {{ __('Черновик') }}
                            </span>
                        @endif
                    </strong>
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">Тег</div>
                    
                    @isset ($post->tags)
                        @foreach ($post->tags as $tag)
                            <strong>{{ $tag->title }}</strong>
                        @endforeach
                    @else
                        <span class="badge bg-danger">✖</span>
                    @endisset
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Комментарии') }}</div>

                    <strong>
                        <i class="icofont-speech-comments text-warning"></i>
                        <span class="text-muted">({{ __('0') }})</span>
                    </strong>
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Дата и время') }}</div>
                    <strong>{{ $post->created_at ?? null }}</strong>
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Просмотры') }}</div>

                    <strong>
                        <i class="icofont-eye-open text-info"></i>
                        <span class="text-muted">({{ $post->views ?? 0 }})</span>
                    </strong>
                </div>

            </div>
        </div>

    </div>

</div>