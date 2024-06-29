<div class="row clearfix g-3">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    {{-- ================ Start First Name User ================ --}}
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">{{ _('Имя') }}</label>

                        <input id="first_name" type="text" name="first_name" value="{{ $user->first_name ?? old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" autocomplete="first_name" autofocus>

                        <x-error-field name="first_name" />
                    </div>
                    {{-- ================ End First Name User ================ --}}

                    {{-- ================ Start Last Name User ================ --}}
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">{{ _('Фамилия') }}</label>

                        <input id="last_name" type="text" name="last_name" value="{{ $user->last_name ?? old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" autocomplete="last_name">

                        <x-error-field name="last_name" />
                    </div>
                    {{-- ================ End Last Name User ================ --}}

                    {{-- ================ Start E-mail User ================ --}}
                    <div class="col-md-12">
                        <label for="email" class="form-label">{{ _('Эл. почта') }}</label>

                        <input id="email" type="email" name="email" value="{{ $user->email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email">

                        <x-error-field name="email" />
                    </div>
                    {{-- ================ End E-mail User ================ --}}

                    {{-- ================ Start Password User ================ --}}
                    <div class="col-md-12">
                        <label for="password" class="form-label">{{ _('Пароль') }}</label>

                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">

                        <x-error-field name="password" />
                    </div>
                    {{-- ================ End Password User ================ --}}

                    {{-- ================ Start Password Confirm User ================ --}}
                    <div class="col-md-12">
                        <label for="password-confirm" class="form-label">{{ _('Подтверждение пароля') }}</label>

                        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                    </div>
                    {{-- ================ End Password Confirm User ================ --}}
                </div>

            </div>
        </div>


        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-center">

                    {{-- ================ Start IP Address User ================ --}}
                    <div class="col-md-12">
                        <label for="ip_address" class="form-label">{{ _('IP-адрес') }}</label>

                        <input id="ip_address" type="text" name="data[ip_address]" value="{{ $user->data->ip_address ?? old('ip_address') }}" class="form-control @error('ip_address') is-invalid @enderror" autocomplete="ip_address">

                        <x-error-field name="ip_address" />
                    </div>
                    {{-- ================ End IP Address User ================ --}}

                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-4">
        <div class="sticky-lg-top">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3 align-items-center">

                        {{-- ================ Start Avatar User ================ --}}
                        <div class="col-md-12">
                            <label for="media" class="form-label">{{ _('Аватар') }}</label>

                            @isset ($user->media)
                                <input id="media" type="file" name="media" value="{{ $user->media }}" class="dropify" data-default-file="{{ Storage::url($user->media) }}" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @else
                                <input type="file" id="media" name="media" class="dropify" data-allowed-file-extensions="jpg jpeg png svg gif">
                            @endisset
                        </div>
                        {{-- ================ Start Avatar User ================ --}}

                        {{-- ================ Start Role User ================ --}}
                        <div class="col-md-12">
                            <label for="role_id" class="form-label">{{ _('Роль') }}</label>

                            <select id="role_id" name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                <option selected disabled hidden>{{ _('-- Выбрать роль --') }}</option>
                                @isset ($roles)
                                    @foreach ($roles as $role)
                                        @isset ($user)
                                            <option value="{{ $role['id'] }}" @selected($role['id'] == $user->roles->first()->id)>{{ $role['name'] }}</option>
                                        @else
                                            <option value="{{ $role['id'] }}" @selected($role['id'] == old('role_id'))>{{ $role['name'] }}</option>
                                        @endisset
                                    @endforeach
                                @endisset
                            </select>

                            <x-error-field name="role_id" />
                        </div>
                        {{-- ================ End Role User ================ --}}

                        {{-- ================ Start Status User ================ --}}
                        <div class="col-md-12">
                            <label class="form-label">{{ _('Статус') }}</label>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @isset ($user->status->value)
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked($user->status->value == true)>
                                        @else
                                            <input id="status" type="radio" name="status" value="1" class="form-check-input" @checked(old('status') == true)>
                                        @endisset

                                        <label for="status" class="form-check-label">{{ _('Активный') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-check">
                                        @isset ($user->status)
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked($user->status->value == false)>
                                        @else
                                            <input id="status" type="radio" name="status" value="0" class="form-check-input" @checked(old('status') == false)>
                                        @endisset

                                        <label for="status" class="form-check-label">{{ _('Заблокированный') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ================ Start Status User ================ --}}

                    </div>

                    <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">{{ _('Сохранить') }}</button>

                </div>
            </div>
        </div>
    </div>
</div>