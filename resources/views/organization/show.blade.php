@extends('layouts.app2')
@section('page') Organization @endsection
@section('content')
<div class="card">
    <div class="card-header border-bottom">
        <h6 class="card-title font-weight-semibold">Detail - Organization</h6>
    </div>
    <div class="card-body pt-3">
        <div class="form-group row mb-0">
            <label class="col-form-label col-lg-1">Name</label>
            <div class="col-lg-3">
                <div class="form-control-plaintext">{{ $dt->org_name ?? '-' }}</div>
            </div>
            <label class="col-form-label col-lg-1">Email</label>
            <div class="col-lg-4">
                <div class="form-control-plaintext">{{ $dt->email ?? '-' }}</div>
            </div>
        </div>
        <div class="form-group row mb-0">
            <label class="col-form-label col-lg-1">Phone</label>
            <div class="col-lg-3">
                <div class="form-control-plaintext">{{ $dt->phone ?? '-' }}</div>
            </div>
            <label class="col-form-label col-lg-1">Website</label>
            <div class="col-lg-4">
                <div class="form-control-plaintext">{{ $dt->website ?? '-' }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label col-lg-1">Logo</label>    
            <div class="col-lg-3">                
                <div class="media mt-0">
                    <div class="mr-2">
                        @php $img = !empty($dt->logo) ? 'storage/organization/'.$dt->logo : 'img/dummy-image.jpg'; @endphp
                        <img src="{{ asset($img) }}" alt="" width="40" height="40" />
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($person))
                    @php $no = 1; @endphp
                    @foreach ($person as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <div class="media mt-0">
                                    <div class="mr-2">
                                        @php $img = !empty($p->avatar) ? 'storage/person/'.$p->avatar : 'img/dummy-image.jpg'; @endphp
                                        <img src="{{ asset($img) }}" alt="" width="40" height="40" />
                                    </div>
                                    <div class="media-body align-self-center">
                                        {{ $p->person_name }}
                                    </div>
                                </div>
                            </td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->phone }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
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