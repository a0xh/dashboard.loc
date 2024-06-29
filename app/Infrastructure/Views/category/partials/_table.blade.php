<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('#') }}</th>
            <th scope="col">{{ __('Название') }}</th>
            <th scope="col">{{ __('Ярлык') }}</th>
            <th scope="col">{{ __('Родитель') }}</th>
            <th scope="col">{{ __('Пользователь') }}</th>
            <th scope="col">{{ __('Статус') }}</th>
            <th scope="col">{{ __('Дата') }}</th>
            <th scope="col">{{ __('Действия') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <th scope="row">
                    <span class="badge bg-primary">
                        @isset($category->id)
                            @if ($category->id <= 9)
                                0{{ $category->id }}
                            @else
                                {{ $category->id }}
                            @endif
                        @endisset
                    </span>
                </th>
                
                <td>
                    <span class="fw-bold ms-1">
                        {{ $category->title ?? null }}
                    </span>
                </td>

                <td>{{ $category->slug ?? null }}</td>

                <td>
                    @isset ($category->category_id)
                        <span class="fw-bold ms-1">
                            {{ $category->title ?? null }}
                        </span>
                    @else
                        <span class="badge bg-warning">✖</span>
                    @endisset
                </td>

                <td>{{ $category->user->first_name ?? null }} {{ $category->user->last_name ?? null }}</td>

                <td>
                    @if ($category->status)
                        <span class="badge bg-success">
                            {{ __('Опубликовано') }}
                        </span>
                    @else
                        <span class="badge bg-danger">
                            {{ __('Не опубликовано') }}
                        </span>
                    @endif
                </td>

                <td>{{ $category->created_at ?? null }}</td>

                <td>
                    <div class="btn-group" role="group" aria-label="categories">
                        @if (Route::has('admin.category.edit'))
                            <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-outline-secondary">
                                <i class="icofont-edit text-success"></i>
                            </a>
                        @endif
                        
                        @if (Route::has('admin.category.delete'))
                            <form onsubmit="if (confirm('Вы действительно хотите удалить данную запись из таблицы?')) {return true} else {return false}" action="{{ route('admin.category.delete', $category) }}" method="post">

                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="icofont-ui-delete text-danger"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            
            @foreach ($category->childrenCategories as $childCategory)
                @include('category.partials._parent', [
                    'childCategory' => $childCategory
                ])
            @endforeach
        @endforeach
    </tbody>
</table>