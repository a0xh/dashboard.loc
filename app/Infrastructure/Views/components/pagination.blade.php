@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-end">
            @if ($paginator->onFirstPage())
                <li class="page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span> {{ __('Туда') }}
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev" aria-label="@lang('pagination.previous')">
                        <span aria-hidden="true">&laquo;</span> {{ __('Туда') }}
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item" aria-disabled="true">
                        <a class="page-link">{{ $element }}</a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" style="color: #fff;">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next" aria-label="@lang('pagination.next')">
                        {{ __('Сюда') }} <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="page-link" aria-label="Next">
                        {{ __('Сюда') }} <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
