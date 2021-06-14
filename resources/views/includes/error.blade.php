@if($errors->any())
<div class="alert alert-danger">
    <p><strong>Terjadi kesalahan!</strong></p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif