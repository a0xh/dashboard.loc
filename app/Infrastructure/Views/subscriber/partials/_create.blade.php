<div class="modal fade" id="add-subscriber" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">

            <form method="post" action="{{ route('admin.subscribers.store') }}" class="modal-content" enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 id="subscribers" class="modal-title fw-bold">{{ __('Добавление подписчика') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    
                    <div class="deadline-form">
                        <div class="row g-3 mb-3">

                            <div class="col-md-12">
                                <label for="email" class="form-label">{{ __('Эл. почта') }}</label>

                                <input id="email" type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" autofocus>

                                @error('email')
                                    <span role="alert" class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Закрыть') }}</button>
                    <button type="button" class="btn btn-primary">{{ __('Добавить') }}</button>
                </div>
                
            </form>

        </div>
    </div>
</div>