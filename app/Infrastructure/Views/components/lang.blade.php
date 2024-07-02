<div class="dropdown zindex-popover">
    <a href="javascript:void(0);" class="nav-link dropdown-toggle pulse" role="button" data-bs-toggle="dropdown">
        @switch(app()->getLocale())
            @case('en')
                <img src="{{ asset('assets/img/en.png') }}">
                @break
            @case('ru')
                <img src="{{ asset('assets/img/ru.png') }}">
                @break
            @default
                <img src="{{ asset('assets/img/' . app()->getLocale() . '.png') }}">
        @endswitch
    </a>
    <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
        <div class="card border-0">
            <ul class="list-unstyled py-2 px-3">
                <li>
                    <a href="{{ url('admin/lang/ru') }}"><img src="{{ asset('assets/img/ru.png') }}"> Русский</a>
                </li>
                <li>
                    <a href="{{ url('admin/lang/en') }}"><img src="{{ asset('assets/img/en.png') }}"> English</a>
                </li>
            </ul>
        </div>
    </div>
</div>