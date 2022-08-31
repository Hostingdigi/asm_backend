@extends('backend.layouts.app')

@section('title', __('Orders'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            List All Orders
        </x-slot>

        <x-slot name="body">

            <div class="row d-none">
                <div class="col">
                    <div class="form-group">
                        <label for="">Customer</label>
                        <select name="" id="" class="form-control"></select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="" id="" class="form-control"></select>
                    </div>
                </div>
            </div>

            <table id="orderTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>ORDER ID</th>
                    <th>CUSTOMER</th>
                    <th>TOTAL AMOUNT</th>
                    <th>ORDERED ON</th>
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

        $("body").on("click", ".editRow", function(e)
        {
            $.ajax({
                type : 'GET',
                url : $(this).data('href'),
                dataType : 'JSON',
                success: function(result)
                {
                    $("#editCategoryForm").attr('action',"{{ route('admin.masters.categories.index') }}/"+result['data']['id']);
                    $("input[name='cat_id']").val(result['data']['id']);
                    $("#parent_id").val(result['data']['parent_id']);
                    $("#cat_name").val(result['data']['name']);
                    $("#editCategory").modal("show");
                }
            });
        });

        $('#orderTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.orders.listOrders') }}",
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'order_no', name: 'order_no' },
                    { data: 'customer', name: 'customer' },
                    { data: 'total', name: 'total' },
                    { data: 'ordered', name: 'ordered' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions' }
                ]
        });

    });
</script>
@endpush
