<div class="row align-items-center">
    <div class="border-0 mb-4">
        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">

            <h3 class="fw-bold mb-0">@yield('title')</h3>

            @isset ($button)
                <div class="col-auto d-flex w-sm-100">
                    {{ $button }}
                </div>
            @endisset

        </div>
    </div>
</div>