<div class="row clearfix g-3">
    <div class="col-lg-8">
        <div class="card mb-3">

            <div class="card-body">
                <div class="row g-3 align-items-center">

                    {{-- ================ Start Title Page ================ --}}
                    <div class="col-md-12">
                        <input type="text" id="title" name="title" value="{{ $page->title ?? old('title') }}" placeholder="Введите заголовок..." class="form-control @error('title') is-invalid @enderror" autocomplete="title" autofocus>

                        <x-error-field name="title" />
                    </div>
                    {{-- ================ End Title Page ================ --}}

                    {{-- ================ Start Content Page ================ --}}
                    <div class="col-md-12">
                        <textarea id="editor" name="text" class="form-control @error('text') is-invalid @enderror" aria-label="text" autocomplete="text">{{ $page->content ?? old('text') }}</textarea>

                        <x-error-field name="editor" />
                    </div>
                    {{-- ================ End Content Page ================ --}}
                </div>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    {{-- ================ Start Slug Page ================ --}}
                    <div class="col-md-12">
                        <label for="slug" class="form-label">{{ __('Ярлык') }}</label>

                        <div class="input-group">
                            <span class="input-group-text">{{ url('/') . '/' }}</span>

                            <input id="slug" type="text" name="slug" value="{{ $page->slug ?? old('slug') }}" class="form-control @error('slug') is-invalid @enderror" autocomplete="slug">
                        </div>

                        <x-error-field name="slug" />
                    </div>
                    {{-- ================ End Slug Page ================ --}}

                    {{-- ================ Start Description Page ================ --}}
                    <div class="col-md-12">
                        <label for="description" class="form-label">{{ __('Описание') }}</label>

                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" aria-label="description" autocomplete="description">{{ $page->description ?? old('description') }}</textarea>
                    </div>
                    {{-- ================ End Description Page ================ --}}

                    {{-- ================ Start Keywords Page ================ --}}
                    <div class="col-md-12">
                        <label for="keywords" class="form-label">{{ __('Ключевые слова') }}</label>

                        <input id="keywords" type="text" name="keywords" value="{{ $page->keywords ?? old('keywords') }}" class="form-control @error('keywords') is-invalid @enderror" autocomplete="keywords">
                    </div>
                    {{-- ================ End Keywords Page ================ --}}

                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    {{-- ================ Start Heading Page ================ --}}
                    <div class="col-md-12">
                        <label for="heading" class="form-label">{{ __('Заголовок') }}</label>

                        <input id="heading" type="text" name="data[heading]" value="{{ $page->data->heading ?? old('heading') }}" class="form-control @error('heading') is-invalid @enderror" autocomplete="heading">

                        <x-error-field name="heading" />
                    </div>
                    {{-- ================ End Heading Page ================ --}}

                    {{-- ================ Start Excerpt Page ================ --}}
                    <div class="col-md-12">
                        <label for="excerpt" class="form-label">{{ __('Отрывок') }}</label>

                        <textarea id="excerpt" name="data[excerpt]" class="form-control @error('excerpt') is-invalid @enderror" aria-label="excerpt" autocomplete="excerpt">{{ $page->data->excerpt ?? old('excerpt') }}</textarea>

                        <x-error-field name="excerpt" />
                    </div>
                    {{-- ================ End Excerpt Page ================ --}}

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="sticky-lg-top">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 align-items-center">

                        {{-- ================ Start Media Page ================ --}}
                        <div class="col-md-12">
                            <label for="file" class="form-label">{{ __('Изображение') }}</label>

                            @isset ($page->media)
                                <input id="file" type="file" name="file" class="dropify" data-default-file="{{ Storage::url($page->media) }}" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @else
                                <input type="file" id="file" name="file" class="dropify" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @endisset
                        </div>
                        {{-- ================ End Media Page ================ --}}
                        
                        {{-- ================ Start Status Page ================ --}}
                        <div class="col-md-12">
                            <label class="form-label">{{ __('Статус') }}</label>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">

                                        @isset ($page->status->value)
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked($page->status->value == true)>
                                        @else
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked(old('status') == false)>
                                        @endisset

                                        <label for="status" class="form-check-label">{{ __('Опубликовано') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @isset ($page->status->value)
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked($page->status->value == false)>
                                        @else
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked(old('status') == false)>
                                        @endisset
                                        
                                        <label for="status" class="form-check-label">{{ __('Не опубликовано') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ================ End Status Page ================ --}}

                    </div>

                    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ __('Сохранить') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>