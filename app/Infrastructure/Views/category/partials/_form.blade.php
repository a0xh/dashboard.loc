<div class="row clearfix g-3">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    <div class="col-md-12">
                        <label for="title" class="form-label">{{ __('Заголовок') }}</label>

                        <input id="title" type="text" name="title" value="{{ $category->title ?? old('title') }}" class="form-control @error('title') is-invalid @enderror" autocomplete="title">

                        @error('title')
                            <span role="alert" class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="slug" class="form-label">{{ __('Ярлык') }}</label>

                        <div class="input-group mb-3">
                            <span class="input-group-text">{{ url('category') . '/' }}</span>
                            <input id="slug" type="text" name="slug" value="{{ $category->slug ?? old('slug') }}" class="form-control @error('slug') is-invalid @enderror" autocomplete="slug">
                        </div>

                        @error('slug')
                            <span role="alert" class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="category_id" class="form-label">{{ __('Родитель') }}</label>

                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" size="3" aria-label="category_id">
                            @isset ($category)
                                <option value="0" @selected($category->category_id == null)>-= Без родителя =-</option>
                            @else
                                <option value="0" @selected(old('category_id') == null)>-= Без родителя =-</option>
                            @endisset
                            @isset ($categories)
                                @foreach ($categories as $value)
                                    @isset ($category)
                                        @if ($value['id'] !== $category->id)
                                            <option value="{{ $value['id'] }}" @selected($value['id'] == $category->category_id )>{{ $value['title'] }}</option>
                                        @endif
                                    @else
                                        <option value="{{ $value['id'] }}" @selected(old('category_id') == $value->category_id && old('category_id') !== null)>{{ $value['title'] }}</option>
                                    @endisset
                                @endforeach
                            @endisset
                        </select>

                        @error('category_id')
                            <span role="alert" class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">{{ __('Описание') }}</label>

                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" aria-label="description" autocomplete="description">{{ $category->description ?? old('description') }}</textarea>

                        @error('description')
                            <span role="alert" class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="keywords" class="form-label">{{ __('Ключевые слова') }}</label>

                        <input id="keywords" type="text" name="keywords" value="{{ $category->keywords ?? old('keywords') }}" class="form-control @error('keywords') is-invalid @enderror" autocomplete="keywords">

                        @error('keywords')
                            <span role="alert" class="invalid-feedback">{{ $message }}</span>
                        @enderror
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

                            @isset ($category->media)
                                <input id="media" type="file" name="media" class="dropify" data-default-file="{{ Storage::url($category->media) }}" data-allowed-file-extensions="jpg jpeg png svg gif">
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

                                        @isset ($category->status)
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked($category->status == true)>
                                        @else
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked(old('status') == false)>
                                        @endisset

                                        <label for="status" class="form-check-label">{{ __('Опубликовано') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @isset ($category->status)
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked($category->status == false)>
                                        @else
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked(old('status') == false)>
                                        @endisset
                                        
                                        <label for="status" class="form-check-label">{{ __('Не опубликовано') }}</label>
                                    </div>
                                </div>

                                @switch(request()->query('type', null))
                                    @case('post')
                                        <input type="hidden" name="type" value="post">
                                        @break
                                    @case('product')
                                        <input type="hidden" name="type" value="product">
                                        @break
                                @endswitch

                            </div>
                        </div>

                        <input type="hidden" name="type" value="{{ $type ?? $category->type }}">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ __('Сохранить') }}</button>

                </div>

            </div>
        </div>
    </div>
</div>