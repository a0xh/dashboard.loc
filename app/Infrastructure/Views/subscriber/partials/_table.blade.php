<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('#ID') }}</th>
            <th scope="col">{{ __('Эл. почта') }}</th>
            <th scope="col">{{ __('Статус') }}</th>
            <th scope="col">{{ __('IP-адрес') }}</th>
            <th scope="col">{{ __('Действия') }}</th>
            <th scope="col">{{ __('Дата') }}</th>
            <th scope="col">{{ __('Удаление') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subscribers as $subscriber)
            <tr>
                <th scope="row">
                    <span class="badge bg-primary">
                        @isset($subscriber->id)
                            @if ($subscriber->id <= 9)
                                0{{ $subscriber->id }}
                            @else
                                {{ $subscriber->id }}
                            @endif
                        @endisset
                    </span>
                </th>
                <td><a href="mailto:{{ $subscriber->email }}" class="btn-link">{{ $subscriber->email ?? null }}</a></td>
                <td>
                    @isset ($subscriber->status)
                        @if ($subscriber->status)
                            <span class="badge bg-success">
                                {{ __('Активный') }}
                            </span>
                        @else
                            <span class="badge bg-danger">
                                {{ __('Заблокированный') }}
                            </span>
                        @endif
                    @endisset
                </td>
                <td>{!! $subscriber->ip ?? 'Отсутствует' !!}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="subscribers">
                        @if (Route::has('admin.subscribers.update'))
                            <form action="{{ route('admin.subscribers.update', $subscriber) }}" method="post">

                                @method('PUT')
                                @csrf

                                <input type="hidden" name="status" value="on">

                                <button type="submit" class="btn btn-outline-secondary" title="Активировать">
                                    <i class="icofont-check-circled text-success"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.subscribers.update', $subscriber) }}" method="post">

                                @method('PUT')
                                @csrf

                                <input type="hidden" name="status" value="off">

                                <button type="submit" class="btn btn-outline-secondary" title="Заблокировать">
                                    <i class="icofont-close-circled text-danger"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
                <td>{{ $subscriber->created_at ?? null }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="subscribers">
                        @if (Route::has('admin.subscribers.destroy'))
                            <form onsubmit="if(confirm('Вы действительно хотите удалить данную запись из таблицы?')){return true}else{return false}" action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="post">

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