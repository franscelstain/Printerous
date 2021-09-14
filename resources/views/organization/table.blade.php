@extends('layouts.app2')
@section('page') Organization @endsection
@section('content')
@include('partials.success')
<div class="card">
    <div class="card-header header-elements-inline border-bottom mb-3">
        <h5 class="card-title">Organization</h5>
        <div class="header-elements">
            <a href="{{ url('organization/create') }}" class="btn btn-primary">Add</a>
        </div>
    </div>
    <table class="table table-striped card-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Website</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($data))
                @php $no = 1; @endphp
                @foreach ($data as $dt)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            <div class="media mt-0">
                                <div class="mr-2">
                                    @php $img = !empty($dt->logo) ? 'storage/organization/'.$dt->logo : 'img/dummy-image.jpg'; @endphp
                                    <img src="{{ asset($img) }}" alt="" width="40" height="40" />
                                </div>
                                <div class="media-body align-self-center">
                                    {{ $dt->org_name }}
                                </div>
                            </div>
                        </td>
                        <td>{{ $dt->email }}</td>
                        <td>{{ $dt->phone }}</td>
                        <td>{{ $dt->website }}</td>
                        <td class="d-flex">
                            @if (Auth::user()->user_type == 'Admin' || $dt->account_manager_id == Auth::user()->id)
                            <a href="{{ url('organization/'. $dt->id .'/edit') }}" class="btn btn-icon" data-popup="tooltip" data-original-title="Edit">
                                <i class="icon-pencil7 text-primary"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon" onClick="delete_data(this)" data-popup="tooltip" data-original-title="Delete" data-method="organization" data-id="{{ $dt->id }}">
                                <i class="icon-trash text-danger"></i>
                            </a>
                            @endif
                            <a href="{{ url('organization/'. $dt->id) }}" class="btn btn-icon" data-popup="tooltip" data-original-title="View">
                                <i class="icon-eye2"></i>
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