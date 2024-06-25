<div class="card mb-3">
    <div class="card-body text-center p-5">
        @if (File::exists('assets/img/no-data.png'))
            <img src="{{ asset('assets/img/no-data.png') }}" class="img-fluid mx-size">
        @endif

        <div class="mt-4 mb-2">
            <span class="text-muted text-uppercase">
                {{ __('Тут пока нет данных для отображения!') }}
            </span>
        </div>

        {{ $button }}
    </div>
</div>