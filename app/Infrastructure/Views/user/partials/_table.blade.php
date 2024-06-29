<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">{{ __('#ID') }}</th>
            <th scope="col">{{ __('Имя и фамилия') }}</th>
            <th scope="col">{{ __('Эл. почта') }}</th>
            <th scope="col">{{ __('Роль') }}</th>
            <th scope="col">{{ __('Статус') }}</th>
            <th scope="col">{{ __('IP-адрес') }}</th>
            <th scope="col">{{ __('Действия') }}</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row">
                    <span class="badge bg-primary">
                        @isset($user['id'])
                            @if ($user['id'] <= 9)
                                {{ '0' . $user['id'] }}
                            @else
                                {{ $user['id'] }}
                            @endif
                        @endisset
                    </span>
                </th>

                <td>
                    @isset ($user['media'])
                        <img src="{{ Storage::url($user['media']) }}" class="avatar rounded-circle">
                    @else
                        <img src="{{ asset('assets/img/user.png') }}" class="avatar rounded-circle">
                    @endisset

                    <span class="fw-bold ms-1">{{ $user['first_name'] ?? null }} {{ $user['last_name'] ?? null }}</span>
                </td>

                <td>
                    <a href="mailto:{{ $user['email'] ?? null }}" class="btn-link">
                        {{ $user['email'] ?? null }}
                    </a>
                </td>

                <td>{{ $user['roles'] ?? null }}</td>

                <td>
                    @isset ($user['status'])
                        @if ($user['status'])
                            <span class="badge bg-success">
                                Активный
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Заблокированный
                            </span>
                        @endif
                    @endisset
                </td>

                <td>{!! $user['ip_address'] ?? '<span class="badge bg-warning">✖</span>' !!}</td>

                <td>
                    <div class="btn-group" role="group">
                        @if (Route::has('admin.user.show'))
                            <a href="{{ route('admin.user.show', $user['id']) }}" class="btn btn-outline-secondary" title="Посмотреть">
                                <i class="icofont-eye-open text-info"></i>
                            </a>
                        @endif

                        @if (Route::has('admin.user.edit'))
                            <a href="{{ route('admin.user.edit', $user['id']) }}" class="btn btn-outline-secondary" title="Отредактировать">
                                <i class="icofont-edit text-success"></i>
                            </a>
                        @endif

                        @if (Route::has('admin.user.delete'))
                            <form onsubmit="if (confirm('Вы действительно хотите удалить данную запись из таблицы?')) {return true} else {return false}" action="{{ route('admin.user.delete', $user['id']) }}" method="post">

                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-outline-secondary" title="Удалить">
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
