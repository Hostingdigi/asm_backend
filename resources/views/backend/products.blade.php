@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <x-backend.card nn="123">
        <x-slot name="header">
            List All Products
        </x-slot>

        <x-slot name="headerActions">
            <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                CREATE
            </a>
        </x-slot>

        <x-slot name="body">
            <table id="categoryTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>PRODUCT NAME</th>
                    <th>CATEGORY</th>
                    <th>IMAGE</th>
                    <th class="text-center">VARIANTS</th>
                    <th class="text-center">SORTING ORDER</th>
                    <th>STATUS</th>
                    <th class="text-center" width="20%">ACTIONS</th>
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
        $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.products.index') }}",
            columnDefs: [{ targets: 4, className: 'dt-body-center' },
                { targets: 5, className: 'dt-body-center' },
                { targets: 7, className: 'dt-body-center' } ],
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'category', name: 'category' },
                    { data: 'image', name: 'image' },
                    { data: 'varants', name: 'varants' },
                    { data: 'sorting', name: 'sorting' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions' }
                ]
        });
    });
</script>
@endpush