<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('#ID') }}</th>
            <th scope="col">{{ __('Товар') }}</th>
            <th scope="col">{{ __('Пользователь') }}</th>
            <th scope="col">{{ __('Статус') }}</th>
            <th scope="col">{{ __('Цена') }}</th>
            <th scope="col">{{ __('Количество') }}</th>
            <th scope="col">{{ __('Действия') }}</th>
            <th scope="col">{{ __('Дата') }}</th>
            <th scope="col">{{ __('Удаление') }}</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach ($orders as $order)
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

                <td>{{ $order->product->title ?? null }}</td>

                <td>{{ $order->user->first_name ?? null }} {{ $order->user->last_name ?? null }}</td>

                <td>
                    @isset ($order->status->value)
                        @if ($order->status->value)
                            <span class="badge bg-success">
                                {{ __('Выполнен') }}
                            </span>
                        @else
                            <span class="badge bg-danger">
                                {{ __('В работе') }}
                            </span>
                        @endif
                    @endisset
                </td>

                <td>{{ $order->product->price ?? null }}</td>

                <td><span class="badge bg-info">{{ $order->quantity ?? null }}</span></td>

                <td>
                    <div class="btn-group" role="group" aria-label="orders">
                        @if (Route::has('admin.order.update'))
                            <form action="{{ route('admin.order.update', $order) }}" method="post">

                                @method('PUT')
                                @csrf

                                <input type="hidden" name="status" value="1">

                                <button type="submit" class="btn btn-outline-secondary" title="Выполнен">
                                    <i class="icofont-check-circled text-success"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.order.update', $order) }}" method="post">

                                @method('PUT')
                                @csrf

                                <input type="hidden" name="status" value="0">

                                <button type="submit" class="btn btn-outline-secondary" title="В работе">
                                    <i class="icofont-close-circled text-danger"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>

                <td>{{ $order->created_at ?? null }}</td>

                <td>
                    <div class="btn-group" role="group" aria-label="subscribers">
                        @if (Route::has('admin.order.delete'))
                            <form onsubmit="if(confirm('Вы действительно хотите удалить данную запись из таблицы?')){return true}else{return false}" action="{{ route('admin.order.delete', $order) }}" method="post">

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