@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div role="alert" class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif