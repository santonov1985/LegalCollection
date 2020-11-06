@if ($errors->any())
    <div class="alert alert-danger alert-error text-center shadow-lg">
        @foreach($errors->all() as $error)
            <div class="d-block">{{ $error }}</div>
        @endforeach
        <button type="button" class="alert-error-close" data-dismiss="alert" aria-label="Close">
            <i class="fa fa-close"></i>
        </button>
    </div>
@endif
