@if (session('message'))
    <div class="alert alert-success alert-error text-center shadow-lg">
        {{ session('message') }}
    </div>
    <script>setTimeout(function() { $('.alert-success').fadeOut(); }, 2500);</script>
@endif
