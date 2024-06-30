<div class="row clearfix g-3">
    <div class="col-lg-8">
        <div class="card mb-3">

            <div class="card-body">
                <div class="row g-3 align-items-center">

                    <div class="col-md-12">
                        <input id="title" type="text" name="title" value="{{ $post->title ?? old('title') }}" placeholder="Введите заголовок..." class="form-control @error('title') is-invalid @enderror" autocomplete="title" autofocus>

                        <x-error-field name="title" />
                    </div>

                    <div class="col-md-12">
                        <textarea id="editor" name="content" class="form-control @error('content') is-invalid @enderror" aria-label="With textarea" autocomplete="content">{{ $post->content ?? old('content') }}</textarea>

                        <x-error-field name="content" />
                    </div>

                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    <div class="col-md-12">
                        <label for="slug" class="form-label">{{ __('Ярлык') }}</label>

                        <div class="input-group">
                            <span class="input-group-text">{{ url('blog') . '/' }}</span>

                            <input id="slug" type="text" name="slug" value="{{ $post->slug ?? old('slug') }}" class="form-control @error('slug') is-invalid @enderror" autocomplete="slug">
                        </div>

                        <x-error-field name="slug" />
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">{{ __('Описание') }}</label>

                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" aria-label="description" autocomplete="description">{{ $post->description ?? old('description') }}</textarea>

                        <x-error-field name="description" />
                    </div>

                    <div class="col-md-12">
                        <label for="keywords" class="form-label">{{ __('Ключевые слова') }}</label>

                        <input id="keywords" type="text" name="keywords" value="{{ $post->keywords ?? old('keywords') }}" class="form-control @error('keywords') is-invalid @enderror" autocomplete="keywords">

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
                            <label for="media" class="form-label">{{ __('Изображение') }}</label>

                            @isset ($post->media)
                                <input id="media" type="file" name="media" class="dropify" data-default-file="{{ Storage::url($post->media) }}" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @else
                                <input id="media" type="file" name="media" class="dropify" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @endisset
                        </div>

                        <div class="col-md-12">
                            <label for="category_id" class="form-label">{{ __('Категория') }}</label>

                            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" size="3" aria-label="category_id">
                                @isset ($categories)
                                    @foreach ($categories as $category)
                                        @isset ($post->category_id)
                                            <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>{{ $category->title }}</option>
                                        @else
                                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->title }}</option>
                                        @endisset
                                    @endforeach
                                @endisset
                            </select>

                            <x-error-field name="category_id" />
                        </div>

                        <div class="col-md-12">
                            <label for="tag_id" class="form-label">{{ __('Теги') }}</label>

                            @isset ($tags)
                                @foreach ($tags as $tag)
                                    <div class="form-check">
                                        @isset ($post)
                                            <input id="tag_id" type="checkbox" name="tag_id[]" value="{{ $tag->id }}" class="form-check-input" value="{{ $tag->id }}" @checked($tag->id == isset($post->tags->where('id', $tag->id)->first()->id))>
                                        @else
                                            <input id="tag_id" type="checkbox" name="tag_id[]" value="{{ $tag->id }}" class="form-check-input" value="{{ $tag->id }}" @checked(old('tag_id') == $tag->id)>
                                        @endisset
                                        <label class="form-check-label" for="sizechek1">
                                        {{ $tag->title }}
                                        </label>
                                    </div>
                                @endforeach
                            @endisset

                            <x-error-field name="tag_id" />
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">{{ __('Статус') }}</label>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">

                                        @isset ($post->status->value)
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked($post->status->value == true)>
                                        @else
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked(old('status') == false)>
                                        @endisset

                                        <label for="status" class="form-check-label">{{ __('Опубликовано') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @isset ($post->status->value)
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked($post->status->value == false)>
                                        @else
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked(old('status') == false)>
                                        @endisset
                                        
                                        <label for="status" class="form-check-label">{{ __('Не опубликовано') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ __('Сохранить') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>