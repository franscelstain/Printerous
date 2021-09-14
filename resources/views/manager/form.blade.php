@extends('layouts.app2')
@section('page') Account Manager @endsection
@section('content')
@php $form_act = $act == 'Create' ? '' : '/' . $dt->id; @endphp
<form id="form-validate" method="post" action="{{ url('account-manager'.$form_act) }}">
    {{ csrf_field() }}
    @if ($act != 'Create') @method('PUT') @endif
    <div class="card">
        <div class="card-header header-elements-inline border-bottom">
            <h6 class="card-title font-weight-semibold">Form {{ $act }} - Account Manager</h6>
        </div>
        <div class="card-body pt-3">
            @include('partials.errors')
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $dt->name ?? '' }}" required />
                </div>
                <div class="col-lg-6">
                    <label>Organization <small>(optional)</small></label>
                    <select class="form-control form-control-select2" name="org_id">
                        <option value=""></option>
                        @if (!empty($org))
                            @foreach ($org as $o)
                                @php $slc_amg = !empty($dt->id) && $dt->id == $o->account_manager_id ? ' selected' : ''; @endphp
                                <option value="{{ $o->id }}"{{ $slc_amg }}>{{ $o->org_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $dt->email ?? '' }}" required />
                </div>
                <div class="col-lg-6">
                    <label>Password <small>(optional)</small></label>
                    <input type="password" class="form-control" name="password" value="" />
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('account-manager') }}" class="btn btn-danger mr-1">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
@endsection
@section('script')
<script src="{{ asset('js/plugins/forms/validation/validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('js/ctrl/manager/form.js') }}"></script>
@endsection