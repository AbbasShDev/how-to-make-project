@if ($errors->any())
    <div class="alert alert-danger fade-in">
        <ul class="m-0 px-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

