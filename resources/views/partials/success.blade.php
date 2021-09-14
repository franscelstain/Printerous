@if (\Session::has('success'))
<div id="alert-success" class="alert alert-success alert-dismissible fade d-none" role="alert">
    {!! \Session::get('success') !!}
    @php \Session::forget('success'); @endphp
</div>
@endif