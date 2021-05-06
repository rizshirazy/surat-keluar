@foreach (['danger', 'warning', 'success', 'info'] as $key)
@if(Session::has($key))
<div class="alert alert-{{ $key }} alert-dismissible fade show" role="alert">
    <strong class="text-capitalize">{{ $key }}!</strong> {{ Session::get($key) }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<script>
    setTimeout(() => {
        $('.alert-success .close').click();
    }, 3000);
</script>
@endif
@endforeach