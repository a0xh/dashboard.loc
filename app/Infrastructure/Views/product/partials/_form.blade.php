<div class="row clearfix g-3">
    <div class="col-lg-8">
        <div class="card mb-3">

            <div class="card-body">
                <div class="row g-3 align-items-center">
                    {{-- ================ Start Title Product ================ --}}
                    <div class="col-md-12">
                        <input type="text" id="title" name="title" value="{{ $product->title ?? old('title') }}" placeholder="Введите название товара..." class="form-control @error('title') is-invalid @enderror" autocomplete="title" autofocus>

                        <x-error-field name="title" />
                    </div>
                    {{-- ================ Start Title Product ================ --}}

                    {{-- ================ Start Content Product ================ --}}
                    <div class="col-md-12">
                        <textarea id="editor" name="text" class="form-control @error('text') is-invalid @enderror" aria-label="text" autocomplete="text">{{ $product->content ?? old('text') }}</textarea>

                        <x-error-field name="text" />
                    </div>
                    {{-- ================ End Content Product ================ --}}
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    {{-- ================ Start Slug Product ================ --}}
                    <div class="col-md-12">
                        <label for="slug" class="form-label">{{ __('Ярлык') }}</label>

                        <div class="input-group">
                            <span class="input-group-text">{{ url('product') . '/' }}</span>

                            <input id="slug" type="text" name="slug" value="{{ $product->slug ?? old('slug') }}" class="form-control @error('slug') is-invalid @enderror" autocomplete="slug">
                        </div>

                        <x-error-field name="slug" />
                    </div>
                    {{-- ================ End Slug Product ================ --}}

                    {{-- ================ Start Description Product ================ --}}
                    <div class="col-md-12">
                        <label for="description" class="form-label">{{ __('Описание') }}</label>

                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" aria-label="description" autocomplete="description">{{ $product->description ?? old('description') }}</textarea>

                        <x-error-field name="description" />
                    </div>
                    {{-- ================ End Description Product ================ --}}

                    {{-- ================ Start Keywords Product ================ --}}
                    <div class="col-md-12">
                        <label for="keywords" class="form-label">{{ __('Ключевые слова') }}</label>

                        <input id="keywords" type="text" name="keywords" value="{{ $product->keywords ?? old('keywords') }}" class="form-control @error('keywords') is-invalid @enderror" autocomplete="keywords">

                        <x-error-field name="keywords" />
                    </div>
                    {{-- ================ End Keywords Product ================ --}}

                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    {{-- ================ Start Heading Product ================ --}}
                    <div class="col-md-12">
                        <label for="heading" class="form-label">{{ __('Заголовок') }}</label>

                        <input id="heading" type="text" name="data[heading]" value="{{ $product->data->heading ?? old('heading') }}" class="form-control" autocomplete="heading">
                    </div>
                    {{-- ================ End Heading Product ================ --}}

                    {{-- ================ Start Excerpt Product ================ --}}
                    <div class="col-md-12">
                        <label for="excerpt" class="form-label">{{ __('Отрывок') }}</label>

                        <textarea id="excerpt" name="data[excerpt]" class="form-control" aria-label="excerpt" autocomplete="excerpt">{{ $product->data->excerpt ?? old('excerpt') }}</textarea>
                    </div>
                    {{-- ================ End Excerpt Product ================ --}}

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="sticky-lg-top">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 align-items-center">

                        {{-- ================ Start Media Product ================ --}}
                        <div class="col-md-12">
                            <label for="media" class="form-label">{{ __('Изображение') }}</label>

                            @isset ($product->media)
                                <input id="media" type="file" name="media" class="dropify" data-default-file="{{ Storage::url($product->media) }}" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @else
                                <input id="media" type="file" name="media" class="dropify" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @endisset
                        </div>
                        {{-- ================ End Media Product ================ --}}

                        {{-- ================ Start Price Product ================ --}}
                        <div class="col-md-12">
                            <label for="price" class="form-label">{{ __('Цена') }}</label>

                            <input id="price" type="text" name="price" value="{{ $product->price ?? old('price') }}" class="form-control @error('price') is-invalid @enderror" autocomplete="price">

                            <x-error-field name="price" />
                        </div>
                        {{-- ================ End Price Product ================ --}}

                        {{-- ================ Start Category ID Product ================ --}}
                        <div class="col-md-12">
                            <label for="category_id" class="form-label">{{ __('Категория') }}</label>

                            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" size="3" aria-label="category_id">
                                @isset ($categories)
                                    @foreach ($categories as $category)
                                        @isset ($product->category_id)
                                            <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->title }}</option>
                                        @else
                                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->title }}</option>
                                        @endisset
                                    @endforeach
                                @endisset
                            </select>

                            <x-error-field name="category_id" />
                        </div>
                        {{-- ================ End Category ID Product ================ --}}

                        {{-- ================ Start Tag ID Product ================ --}}
                        <div class="col-md-12">
                            <label for="tag_id" class="form-label">{{ __('Теги') }}</label>
                            @isset ($tags)
                                @foreach ($tags as $tag)
                                    <div class="form-check">
                                        @isset ($product)
                                            <input id="tag_id" type="checkbox" name="tag_id[]" value="{{ $tag->id }}" class="form-check-input" value="{{ $tag->id }}" @checked($tag->id == isset($product->tags->where('id', $tag->id)->first()->id))>
                                        @else
                                            <input id="tag_id" type="checkbox" name="tag_id[]" value="{{ $tag->id }}" class="form-check-input" value="{{ $tag->id }}" @checked(old('tag_id') == $tag->id)>
                                        @endisset
                                        <label class="form-check-label" for="tag_id">
                                            {{ $tag->title }}
                                        </label>
                                    </div>
                                @endforeach
                            @endisset

                            <x-error-field name="tag_id" />
                        </div>
                        {{-- ================ End Tag ID Product ================ --}}
                        
                        {{-- ================ Start Status Product ================ --}}
                        <div class="col-md-12">
                            <label class="form-label">{{ __('Статус') }}</label>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">

                                        @isset ($product->status->value)
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked($product->status->value == true)>
                                        @else
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked(old('status') == false)>
                                        @endisset

                                        <label for="status" class="form-check-label">{{ __('Опубликовано') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @isset ($product->status)
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked($product->status->value == false)>
                                        @else
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked(old('status') == false)>
                                        @endisset
                                        
                                        <label for="status" class="form-check-label">{{ __('Не опубликовано') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ================ End Status Post ================ --}}
                        
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ __('Сохранить') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>