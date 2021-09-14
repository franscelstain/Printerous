@if ($errors->any())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <ul class="mb-0 pl-2">
    @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
    @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif