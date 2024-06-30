<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('#') }}</th>
            <th scope="col">{{ __('Название') }}</th>
            <th scope="col">{{ __('Ярлык') }}</th>
            <th scope="col">{{ __('Тип') }}</th>
            <th scope="col">{{ __('Пользователь') }}</th>
            <th scope="col">{{ __('Статус') }}</th>
            <th scope="col">{{ __('Дата') }}</th>
            <th scope="col">{{ __('Действия') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
            <tr>
                <th scope="row">
                    <span class="badge bg-primary">
                        @isset($tag->id)
                            @if ($tag->id <= 9)
                                0{{ $tag->id }}
                            @else
                                {{ $tag->id }}
                            @endif
                        @endisset
                    </span>
                </th>

                <td>
                    <span class="fw-bold ms-1">
                        {{ $tag->title ?? null }}
                    </span>
                </td>

                <td>{{ $tag->slug ?? null }}</td>

                <td>
                    @isset ($tag->type)
                        @switch($tag->type)
                            @case('product')
                                {{ __('Товар') }}
                                @break
                            @case('post')
                                {{ __('Пост') }}
                                @break
                            @default
                                <span class="badge bg-warning">✖</span>
                        @endswitch
                    @else
                        <span class="badge bg-warning">✖</span>
                    @endisset
                </td>

                <td>{{ $tag->user->first_name ?? null }} {{ $tag->user->last_name ?? null }}</td>

                <td>
                    @if ($tag->status->value)
                        <span class="badge bg-success">
                            {{ __('Опубликовано') }}
                        </span>
                    @else
                        <span class="badge bg-danger">
                            {{ __('Не опубликовано') }}
                        </span>
                    @endif
                </td>

                <td>{{ $tag->created_at ?? null }}</td>

                <td>
                    <div class="btn-group" role="group" aria-label="btn-group">
                        @if (Route::has('admin.tag.edit'))
                            <a href="{{ route('admin.tag.edit', $tag) }}" class="btn btn-outline-secondary">
                                <i class="icofont-edit text-success"></i>
                            </a>
                        @endif
                        
                        @if (Route::has('admin.tag.delete'))
                            <form onsubmit="if (confirm('Вы действительно хотите удалить данную запись из таблицы?')) {return true} else {return false}" action="{{ route('admin.tag.delete', $tag) }}" method="post">
                                
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
        @endforeach
    </tbody>
</table>