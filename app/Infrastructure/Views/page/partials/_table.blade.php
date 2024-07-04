<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('#') }}</th>
            <th scope="col">{{ __('Название') }}</th>
            <th scope="col">{{ __('Маршрут') }}</th>
            <th scope="col">{{ __('Пользователь') }}</th>
            <th scope="col">{{ __('Статус') }}</th>
            <th scope="col">{{ __('Дата') }}</th>
            <th scope="col">{{ __('Действия') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
            <tr>
                <th scope="row">
                    <span class="badge bg-primary">
                        @isset($loop->iteration)
                            @if ($loop->iteration <= 9)
                                0{{ $loop->iteration }}
                            @else
                                {{ $loop->iteration }}
                            @endif
                        @endisset
                    </span>
                </th>
                
                <td>{{ $page->title ?? null }}</td>
                <td>{{ $page->slug ?? null }}</td>
                <td>{{ $page->user->first_name ?? null }} {{ $page->user->last_name ?? null }}</td>

                <td>
                    @isset ($page->status)
                        @if ($page->status)
                            <span class="badge bg-success">
                                {{ __('Опубликовано') }}
                            </span>
                        @else
                            <span class="badge bg-danger">
                                {{ __('Не опубликовано') }}
                            </span>
                        @endif
                    @endisset
                </td>

                <td>{{ $page->created_at ?? null }}</td>

                <td>
                    <div class="btn-group" role="group" aria-label="btn-group">
                        @if (Route::has('admin.page.edit'))
                            <a href="{{ route('admin.page.edit', $page) }}" class="btn btn-outline-secondary">
                                <i class="icofont-edit text-success"></i>
                            </a>
                        @endif
                        
                        @if (Route::has('admin.page.delete'))
                            <form onsubmit="if(confirm('{{ __('Вы действительно хотите удалить данную запись из таблицы?') }}')){return true}else{return false}" action="{{ route('admin.page.delete', $page) }}" method="post">
                                
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