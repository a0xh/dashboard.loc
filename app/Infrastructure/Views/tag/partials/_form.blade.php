<div class="row clearfix g-3">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    <div class="col-md-12">
                        <label for="title" class="form-label">{{ __('Заголовок') }}</label>

                        <input id="title" type="text" name="title" value="{{ $tag->title ?? old('title') }}" class="form-control @error('title') is-invalid @enderror" autocomplete="title" autofocus>

                        <x-error-field name="title" />
                    </div>

                    <div class="col-md-12">
                        <label for="slug" class="form-label">{{ __('Ярлык') }}</label>

                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ url('tag') . '/' }}</span>
                            <input id="slug" type="text" name="slug" value="{{ $tag->slug ?? old('slug') }}" class="form-control @error('slug') is-invalid @enderror" autocomplete="slug">
                        </div>

                        <x-error-field name="slug" />
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">{{ __('Описание') }}</label>

                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" aria-label="description" autocomplete="description">{{ $tag->description ?? old('description') }}</textarea>

                        <x-error-field name="description" />
                    </div>

                    <div class="col-md-12">
                        <label for="keywords" class="form-label">{{ __('Ключевые слова') }}</label>

                        <input id="keywords" type="text" name="keywords" value="{{ $tag->keywords ?? old('keywords') }}" class="form-control @error('keywords') is-invalid @enderror" autocomplete="keywords">

                        <x-error-field name="keywords" />
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="sticky-lg-top">
            <div class="card">

                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-12">
                            <label for="media" class="form-label">{{ __('Картинка') }}</label>

                            @isset ($tag->media)
                                <input id="media" type="file" name="media" class="dropify" data-default-file="{{ Storage::url($tag->media) }}" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @else
                                <input id="media" type="file" name="media" class="dropify" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @endisset

                            @error('media')
                                <span role="alert" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">{{ __('Статус') }}</label>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">

                                        @isset ($tag->status->value)
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked($tag->status->value == true)>
                                        @else
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked(old('status') == false)>
                                        @endisset

                                        <label for="status" class="form-check-label">{{ __('Опубликовано') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @isset ($tag->status->value)
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked($tag->status->value == false)>
                                        @else
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked(old('status') == false)>
                                        @endisset
                                        
                                        <label for="status" class="form-check-label">{{ __('Не опубликовано') }}</label>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="type" value="{{ $type ?? $tag->type }}">

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ __('Сохранить') }}</button>

                </div>

            </div>
        </div>
    </div>
</div>