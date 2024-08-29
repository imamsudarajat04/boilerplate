@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <i class="bi bi-check-circle"></i>
        <strong>{!! $message !!}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('failed'))
    <div class="alert alert-danger alert-dismissible show fade">
        <i class="bi bi-exclamation-triangle"></i>
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
        <ul>
            @foreach ($errors->all() as $error)
                <li><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
