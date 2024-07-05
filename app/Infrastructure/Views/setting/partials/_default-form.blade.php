<div class="row g-3 align-items-center">
    <div class="col-md-12">
        <label for="name" class="form-label">{{ __('Название') }}</label>

        <input id="name" type="text" name="name" value="{{ $default->data->name ?? null }}" class="form-control @error('name') is-invalid @enderror" autocomplete="name">

        @error('name')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="timezone" class="form-label">{{ __('Часовой пояс') }}</label>
        <select id="timezone" name="timezone" class="form-select @error('timezone') is-invalid @enderror">
            <option selected disabled hidden>{{ __('-- Выбрать из списка --') }}</option>
            <option value="Europe/Kaliningrad" @selected($default->data->timezone == 'Europe/Kaliningrad')>{{ __('Europe/Kaliningrad UTC+02:00') }}</option>
            <option value="Europe/Moscow" @selected($default->data->timezone == 'Europe/Moscow')>{{ __('Europe/Moscow UTC+03:00') }}</option>
            <option value="Europe/Samara" @selected($default->data->timezone == 'Europe/Samara')>{{ __('Europe/Samara UTC+04:00') }}</option>
            <option value="Asia/Yekaterinburg" @selected($default->data->timezone == 'Asia/Yekaterinburg')>{{ __('Asia/Yekaterinburg UTC+05:00') }}</option>
            <option value="Asia/Omsk" @selected($default->data->timezone == 'Asia/Omsk')>{{ __('Asia/Omsk UTC+06:00') }}</option>
            <option value="Asia/Krasnoyarsk" @selected($default->data->timezone == 'Asia/Krasnoyarsk')>{{ __('Asia/Krasnoyarsk UTC+07:00') }}</option>
            <option value="Asia/Irkutsk" @selected($default->data->timezone == 'Asia/Irkutsk')>{{ __('Asia/Irkutsk UTC+08:00') }}</option>
            <option value="Asia/Yakutsk" @selected($default->data->timezone == 'Asia/Yakutsk')>{{ __('Asia/Yakutsk UTC+09:00') }}</option>
            <option value="Asia/Vladivostok" @selected($default->data->timezone == 'Asia/Vladivostok')>{{ __('Asia/Vladivostok UTC+10:00') }}</option>
            <option value="Asia/Magadan" @selected($default->data->timezone == 'Asia/Magadan')>{{ __('Asia/Magadan UTC+11:00') }}</option>
            <option value="Asia/Kamchatka" @selected($default->data->timezone == 'Asia/Kamchatka')>{{ __('Asia/Kamchatka UTC+12:00') }}</option>
        </select>

        @error('timezone')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">{{ __('Язык по умолчанию') }}</label>
        <div class="row">
            <div class="col-md-6">
                <div class="form-check">
                    <input id="locale" type="radio" name="locale" value="ru" class="form-check-input" @checked($default->data->locale == 'ru')>

                    <label for="locale" class="form-check-label">{{ __('RU') }}</label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check">
                    <input id="locale" type="radio" name="locale" value="en" class="form-check-input" @checked($default->data->locale == 'en')>

                    <label for="locale" class="form-check-label">{{ __('EN') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <label for="url" class="form-label">{{ __('Ссылка') }}</label>

        <input id="url" type="text" name="url" value="{{ $default->data->url ?? null}}" class="form-control @error('url') is-invalid @enderror" autocomplete="url">

        @error('url')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">{{ __('Режим разработки') }}</label>
        <div class="row">
            
            <div class="col-md-6">
                <div class="form-check">
                    <input id="local" type="radio" name="environment" value="local" class="form-check-input" @checked($default->data->environment == 'local')>

                    <label for="local" class="form-check-label">{{ __('Local') }}</label>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check">
                    <input id="production" type="radio" name="environment" value="production" class="form-check-input" @checked($default->data->environment == 'production')>

                    <label for="production" class="form-check-label">{{ __('Production') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label for="debug" class="form-label">{{ __('Отладка') }}</label>
        <select id="debug" name="debug" class="form-select @error('debug') is-invalid @enderror">
            <option selected disabled hidden>{{ __('-- Выбрать из списка --') }}</option>
            <option value="on" @selected($default->data->debug == 'true')>{{ __('Включена') }}</option>
            <option value="off" @selected($default->data->debug == 'false')>{{ __('Отключена') }}</option>
        </select>

        @error('debug')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>