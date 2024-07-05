<div class="row g-3 align-items-center">
    <div class="col-md-6">
        <label for="host" class="form-label">{{ __('Хост') }}</label>

        <input id="host" type="text" name="host" value="{{ $database->data->host ?? null }}" class="form-control @error('host') is-invalid @enderror" autocomplete="host">

        @error('host')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="port" class="form-label">{{ __('Порт') }}</label>

        <input id="port" type="text" name="port" value="{{ $database->data->port ?? null }}" class="form-control @error('port') is-invalid @enderror" autocomplete="port">

        @error('port')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="name" class="form-label">{{ __('Название БД') }}</label>

        <input id="name" type="text" name="name" value="{{ $database->data->name ?? null }}" class="form-control @error('name') is-invalid @enderror" autocomplete="name">

        @error('name')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="user" class="form-label">{{ __('Имя юзера БД') }}</label>

        <input id="user" type="text" name="user" value="{{ $database->data->user ?? null }}" class="form-control @error('user') is-invalid @enderror" autocomplete="user">

        @error('user')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12">
        <label for="pass" class="form-label">{{ __('Пароль юзера') }}</label>

        <input id="pass" type="text" name="pass" value="{{ $database->data->pass ?? null }}" class="form-control @error('pass') is-invalid @enderror" autocomplete="pass">

        @error('pass')
            <span role="alert" class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>