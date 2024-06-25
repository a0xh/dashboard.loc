@if (Session::has('success'))
    <div role="alert" class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif