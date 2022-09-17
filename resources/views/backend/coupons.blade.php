@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

@if(Session::has('flashData'))
    <x-utils.alert type="success">
        {{ Session::get('flashData')['message'] }}
    </x-utils.alert>
    @endif
    
    <x-backend.card nn="123">
        <x-slot name="header">
            List All Coupons
        </x-slot>

        <x-slot name="headerActions">
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                CREATE
            </a>
        </x-slot>

        <x-slot name="body">
            <table id="ajaxTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>TITLE</th>
                    <th>COUPON CODE</th>
                    <th>OFFER VALUE</th>
                    <th>VALIDITY</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody></tbody>
                </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {
        $('#ajaxTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.coupons.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'code', name: 'code' },
                { data: 'offer_value', name: 'offer_value' },
                { data: 'validity', name: 'validity' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions' }
            ]
        });
    });
</script>
@endpush
