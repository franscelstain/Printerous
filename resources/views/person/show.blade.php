@extends('layouts.app2')
@section('page') Person @endsection
@section('content')
<div class="card">
    <div class="card-header border-bottom">
        <h6 class="card-title font-weight-semibold">Detail - Person</h6>
    </div>
    <div class="card-body pt-3">
        <div class="form-group row mb-0">
            <label class="col-form-label col-lg-1">Name</label>
            <div class="col-lg-3">
                <div class="form-control-plaintext">{{ $dt->person_name ?? '-' }}</div>
            </div>
            <label class="col-form-label col-lg-2">Organization</label>
            <div class="col-lg-4">
                <div class="form-control-plaintext">{{ $org->org_name ?? '-' }}</div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <label class="col-form-label col-lg-1">Email</label>
            <div class="col-lg-3">
                <div class="form-control-plaintext">{{ $dt->email ?? '-' }}</div>
            </div>
            <label class="col-form-label col-lg-2">Phone</label>
            <div class="col-lg-4">
                <div class="form-control-plaintext">{{ $dt->phone ?? '-' }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-1">Avatar</label>    
            <div class="col-lg-3">                
                <div class="media mt-0">
                    <div class="mr-2">
                        @php $img = !empty($dt->avatar) ? 'storage/person/'.$dt->avatar : 'img/dummy-image.jpg'; @endphp
                        <img src="{{ asset($img) }}" alt="" width="40" height="40" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/table.js') }}"></script>
@endsection