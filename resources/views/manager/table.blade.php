@extends('layouts.app2')
@section('page') Account Manager @endsection
@section('content')
@include('partials.success')
<div class="card">
    <div class="card-header header-elements-inline border-bottom mb-3">
        <h5 class="card-title">Account Manager</h5>
        <div class="header-elements">
            <a href="{{ url('account-manager/create') }}" class="btn btn-primary">Add</a>
        </div>
    </div>
    <table class="table table-striped card-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Organization</th>
                <th>Create At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($data))
                @php $no = 1; @endphp
                @foreach ($data as $dt)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $dt->name }}</td>
                        <td>{{ $dt->email }}</td>
                        <td>{{ $dt->org_name }}</td>
                        <td>{{ date('d M Y H:i', strtotime($dt->created_at)) }}</td>
                        <td class="d-flex">
                            <a href="{{ url('account-manager/'. $dt->id .'/edit') }}" class="btn btn-icon" data-popup="tooltip" data-original-title="Edit">
                                <i class="icon-pencil7 text-primary"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon" onClick="delete_data(this)" data-popup="tooltip" data-original-title="Delete" data-method="account-manager" data-id="{{ $dt->id }}">
                                <i class="icon-trash text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/table.js') }}"></script>
@endsection