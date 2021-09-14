@extends('layouts.app2')
@section('page') Organization @endsection
@section('content')
@php $form_act = $act == 'Create' ? '' : '/' . $dt->id; @endphp
<form id="form-validate" method="post" action="{{ url('organization'.$form_act) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    @if ($act != 'Create') @method('PUT') @endif
    <div class="card">
        <div class="card-header header-elements-inline border-bottom">
            <h6 class="card-title font-weight-semibold">Form {{ $act }} - Organization</h6>
        </div>
        <div class="card-body pt-3">
            @include('partials.errors')
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Name</label>
                    <input type="text" class="form-control" name="org_name" value="{{ $dt->org_name ?? '' }}" required />
                </div>
                <div class="col-lg-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $dt->email ?? '' }}" required />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Phone <small>(optional)</small></label>
                    <input type="text" class="form-control" name="phone" value="{{ $dt->phone ?? '' }}" />
                </div>
                <div class="col-lg-6">
                    <label>Website <small>(optional)</small></label>
                    <input type="text" class="form-control" name="website" value="{{ $dt->website ?? '' }}" />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Logo <small>(optional)</small></label>                    
                    <div class="media mt-0">
                        <div class="mr-2">
                            @php $img = !empty($dt->logo) ? 'storage/organization/'.$dt->logo : 'img/dummy-image.jpg'; @endphp
                            <img src="{{ asset($img) }}" alt="" width="40" height="40" />
                        </div>
                        <div class="media-body">
                            <input type="file" class="form-input-styled" id="logo" name="logo" data-fouc accept="image/*" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('organization') }}" class="btn btn-danger mr-1">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
@endsection
@section('script')
<script src="{{ asset('js/plugins/forms/validation/validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('js/ctrl/organization/form.js') }}"></script>
@endsection