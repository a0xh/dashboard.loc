<div class="card border-0 mb-1">

    <div class="form-check form-switch position-absolute top-0 end-0 py-3 px-3 d-none d-md-block">
        <div class="btn-group" role="group" aria-label="btn-group">
            @if (Route::has('admin.product.edit'))
                <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-outline-secondary">
                    <i class="icofont-edit text-success"></i>
                </a>
            @endif
            
            @if (Route::has('admin.product.delete'))
                <form onsubmit="if (confirm('{{ __('Вы действительно хотите удалить данную запись из таблицы?') }}')) {return true} else {return false}" action="{{ route('admin.product.delete', $product) }}" method="post">

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

        @isset ($product->media)
            <img class="w120 rounded img-fluid" src="{{ Storage::url($product->media) }}">
        @else
            <img class="w120 rounded img-fluid" src="{{ asset('assets/img/no-data.png') }}">
        @endisset

        <div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">

            <h6 class="mb-3 fw-bold">{{ $product->title ?? null }}
                <span class="text-muted small fw-light d-block">
                    {{ $product->user->first_name ?? null }} {{ $product->user->last_name ?? null }}
                </span>
            </h6>

            <div class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Категория') }}</div>
                    @isset ($product->category)
                        <strong>{{ $product->category->title }}</strong>
                    @else
                        <span class="badge bg-danger">{{ __('✖') }}</span>
                    @endisset
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Статус') }}</div>
                    <strong>
                        @if ($product->status->value)
                            <span class="badge bg-success">
                                {{ __('Опубликовано') }}
                            </span>
                        @else
                            <span class="badge bg-danger">
                                {{ __('Не опубликована') }}
                            </span>
                        @endif
                    </strong>
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Теги') }}</div>
                    
                    @isset ($product->tags)
                        @foreach ($product->tags as $tag)
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
                    <div class="text-muted small">{{ __('Цена') }}</div>
                    <strong>{{ $product->price ?? null }}</strong>
                </div>

                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                    <div class="text-muted small">{{ __('Просмотры') }}</div>
                    <strong>
                        <i class="icofont-eye-open text-info"></i>
                        <span class="text-muted">({{ $product->views ?? 0 }})</span>
                    </strong>
                </div>

            </div>
        </div>

    </div>

</div>