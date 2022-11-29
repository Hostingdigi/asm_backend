@extends('backend.layouts.app')

@section('title', __('Orders'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            List All Orders

            <div class="modal fade" id="confirmModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="confirmModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <p>Are you sure? Do you want to change order status?</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" id="confirmModalAction" type="button">Change</button>
                            <button class="btn btn-danger" type="button" data-coreui-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
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
                    <th>PAYMENT VIA</th>
                    <th>STATUS</th>
                    <!-- <th>ACTIONS</th> -->
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

        var orderId = 0;
        $("body").on("change", ".order_change", function(e)
        {
            orderId = $(this).data('orderid'); 
            $("#confirmModal").modal("show");
        });

        $("body").on("click", "#confirmModalAction", function(e){
            if(orderId!=0){
                $.ajax({
                    type : 'POST',
                    url : '{{ route("admin.orders.changeStatus") }}',
                    data : {orderId : orderId,_token:'{{ csrf_token() }}'},
                    success: function(result)
                    {
                        // $("#editCategoryForm").attr('action',"{{ route('admin.masters.categories.index') }}/"+result['data']['id']);
                        // $("input[name='cat_id']").val(result['data']['id']);
                        // $("#parent_id").val(result['data']['parent_id']);
                        // $("#cat_name").val(result['data']['name']);
                    }
                });
            }else{
                alert('Try again!');
            }
        });

        $('#orderTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.orders.listOrders') }}",
            columnDefs: [
                {
                    targets: 1,
                    className: 'font-weight-bold'
                },
                {
                    targets: 3,
                    className: 'text-right font-weight-bold'
                },
                {
                    targets: 4,
                    className: 'text-right'
                },
                {
                    targets: 5,
                    className: 'text-right'
                },
                {
                    targets: 6,
                    className: 'text-center font-weight-bold'
                }
            ],
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'order_no', name: 'order_no' },
                    { data: 'customer', name: 'customer' },
                    { data: 'total', name: 'total' },
                    { data: 'ordered', name: 'ordered' },
                    { data: 'payment_status', name: 'payment_status' },
                    { data: 'status', name: 'status' },
                    // { data: 'actions', name: 'actions' }
                ]
        });

    });
</script>
@endpush
