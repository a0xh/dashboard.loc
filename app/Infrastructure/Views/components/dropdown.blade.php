<div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
    <div class="u-info me-2">
        <p class="mb-0 text-end line-height-sm">
            <span class="font-weight-bold">{{ $user->name ?? null }}</span>
        </p>

        <small>{{ __('Admin') }}</small>
    </div>
    
    <a href="javascript:void(0);" class="nav-link dropdown-toggle pulse p-0" role="button" data-bs-toggle="dropdown" data-bs-display="static">
        <img src="{{ Storage::url($user->media ?? null) }}" class="avatar lg rounded-circle img-thumbnail">
    </a>

    <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
        <div class="card border-0 w280">

            <div class="card-body pb-0">
                <div class="d-flex py-1">
                    <img class="avatar rounded-circle" src="{{ Storage::url($user->media ?? null) }}">
                    <div class="flex-fill ms-3">
                        <p class="mb-0">
                            <span class="font-weight-bold">
                                {{ $user->first_name ?? null }}
                                {{ $user->last_name ?? null }}
                            </span>
                        </p>
                        <small>{{ $user->email ?? null }}</small>
                    </div>
                </div>
                
                <div><hr class="dropdown-divider border-dark"></div>
            </div>

            <div class="list-group m-2">
                <a href="#" class="list-group-item list-group-item-action border-0">
                    <i class="icofont-ui-user fs-5 me-3"></i>
                    {{ __('Профиль') }}
                </a>

                <a href="#" class="list-group-item list-group-item-action border-0">
                    <i class="icofont-ui-settings fs-5 me-3"></i>
                    {{ __('Настройки') }}
                </a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item list-group-item-action border-0">
                    <i class="icofont-logout fs-5 me-3"></i>
                    {{ __('Выход') }}
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        </div>
    </div>
</div>