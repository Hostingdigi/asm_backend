@extends('backend.layouts.app')

@section('title', __('Categories'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            List All Categories

            <a href="" class="btn btn-success float-right">
                <i class="fa fa-plus"></i>
                CREATE
            </a>
        </x-slot>

        <x-slot name="body">
            <table id="myTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>PARENT CATEGORY</th>
                    <th>NAME</th>
                    <th>SUB CATEGORIES</th>
                    <th>STATUS</th>
                    <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
</script>
@endpush
