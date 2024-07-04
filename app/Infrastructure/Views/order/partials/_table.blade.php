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
                        @isset($order->id)
                            @if ($order->id <= 9)
                                0{{ $order->id }}
                            @else
                                {{ $order->id }}
                            @endif
                        @endisset
                    </span>
                </th>
                <td>{{ $order->product->title ?? null }}</td>
                <td>{{ $order->user->name ?? null }}</td>
                <td>
                    @isset ($order->status)
                        @if ($order->status)
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
                        @if (Route::has('admin.orders.update'))
                            <form action="{{ route('admin.orders.update', $order) }}" method="post">

                                @method('PUT')
                                @csrf

                                <input type="hidden" name="status" value="on">

                                <button type="submit" class="btn btn-outline-secondary" title="Выполнен">
                                    <i class="icofont-check-circled text-success"></i>
                                </button>
                            </form>

                            <form action="{{ route('admin.orders.update', $order) }}" method="post">

                                @method('PUT')
                                @csrf

                                <input type="hidden" name="status" value="off">

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
                        @if (Route::has('admin.orders.destroy'))
                            <form onsubmit="if(confirm('Вы действительно хотите удалить данную запись из таблицы?')){return true}else{return false}" action="{{ route('admin.orders.destroy', $order) }}" method="post">

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