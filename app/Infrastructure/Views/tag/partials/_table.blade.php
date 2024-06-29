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
                        {{ $tag->title }}
                    </span>
                </td>
                <td>{{ $tag->slug }}</td>
                <td>
                    @isset ($tag->type)
                        @if ($tag->type !== 'product')
                            {{ __('Пост') }}
                        @endif
                    @else
                        <span class="badge bg-warning">✖</span>
                    @endisset
                </td>
                <td>{{ $tag->user->first()->name }}</td>
                <td>
                    @if ($tag->status)
                        <span class="badge bg-success">
                            {{ __('Опубликовано') }}
                        </span>
                    @else
                        <span class="badge bg-danger">
                            {{ __('Черновик') }}
                        </span>
                    @endif
                </td>
                <td>{{ $tag->created_at }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="tags">
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-outline-secondary">
                            <i class="icofont-edit text-success"></i>
                        </a>
                        
                        <form onsubmit="if (confirm('Вы действительно хотите удалить данную запись из таблицы?')) {return true} else {return false}" action="{{ route('admin.tags.destroy', $tag) }}" method="post">
                            
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="icofont-ui-delete text-danger"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>