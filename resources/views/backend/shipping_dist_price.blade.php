@extends('backend.layouts.app')

@section('title', __('Shipping Distance Amount'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            List Shipping Distances

            <a href="#createDistAmount" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                CREATE
            </a>

            <div class="modal fade" id="createDistAmount" tabindex="-1" aria-labelledby="createBrandLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createBrandLabel">CREATE NEW</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.settings.shipping-distance-amount.store') }}" id="createDistAmountForm" novalidate>
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label">From <sup class="required">*</sup></label>
                                    <input type="text" required data-rule-number="true" min="0" class="form-control" id="from_dist" name="from_dist" placeholder="Ex: 0" autofocus />
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label">To</label>
                                    <input type="text" data-rule-checkToDist="true" data-rule-number="true" min="0" class="form-control" id="to_dist" name="to_dist" placeholder="must be greater than 'From'." />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Amount <sup class="required">*</sup></label>
                                    <input type="text" data-rule-number="true" min="0" required class="form-control" id="ds_amount" name="ds_amount" placeholder="amount in $." />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success btn-sm" type="submit">CREATE</button>
                            <button class="btn btn-danger btn-sm" type="button" data-coreui-dismiss="modal">CANCEL</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateDistAmount" tabindex="-1" aria-labelledby="createBrandLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createBrandLabel">Update</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" id="editDistAmountForm" novalidate>
                        <div class="modal-body">
                    <input type="hidden" name="_method" value="PUT">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label">From <sup class="required">*</sup></label>
                                    <input type="text" required data-rule-number="true" min="0" class="form-control" id="ed_from_dist" name="from_dist" placeholder="Ex: 0" autofocus />
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label">To</label>
                                    <input type="text" data-rule-edcheckToDist="true" data-rule-number="true" min="0" class="form-control" id="ed_to_dist" name="to_dist" placeholder="must be greater than 'From'." />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Amount <sup class="required">*</sup></label>
                                    <input type="text" data-rule-number="true" min="0" required class="form-control" id="ed_ds_amount" name="ds_amount" placeholder="amount in $." />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Save</button>
                            <button class="btn btn-danger" type="button" data-coreui-dismiss="modal">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="body">
            <table id="shipD" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>FROM VALUE(KM)</th>
                    <th>TO VALUE(KM)</th>
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                    <th width="20%">ACTIONS</th>
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

        jQuery.validator.addMethod("checkToDist", function(value, element) {
            return this.optional(element) || (value > parseFloat($("#from_dist").val()));
        }, "Please specify the correct domain for your documents");

        jQuery.validator.addMethod("edcheckToDist", function(value, element) {
            return this.optional(element) || (value > parseFloat($("#ed_from_dist").val()));
        }, "Please specify the correct domain for your documents");

        $("body").on("click", ".editRow", function(e)
        {
            $.ajax({
                type : 'GET',
                url : $(this).data('href'),
                dataType : 'JSON',
                success: function(result)
                {
                    $("#editDistAmountForm").attr('action',"{{ route('admin.settings.shipping-distance-amount.index') }}/"+result.data.id);
                    $("#ed_from_dist").val(result.data.from_distance);
                    $("#ed_to_dist").val(result.data.to_distance);
                    $("#ed_ds_amount").val(result.data.amount);
                    $("#updateDistAmount").modal("show");
                }
            });
        });

        $("#createDistAmountForm").validate({
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                element.after(error).addClass('is-invalid');
                $("#createDistAmountForm button[type='submit']").prop("disabled",false);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-valid").addClass("is-invalid");
                $("#createDistAmountForm button[type='submit']").prop("disabled",false);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
                $("#createDistAmountForm button[type='submit']").prop("disabled",false);
            },
        });

        $("#editDistAmountForm").validate({
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                element.after(error).addClass('is-invalid');
                $("#editDistAmountForm button[type='submit']").prop("disabled",false);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-valid").addClass("is-invalid");
                $("#editDistAmountForm button[type='submit']").prop("disabled",false);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
                $("#editDistAmountForm button[type='submit']").prop("disabled",false);
            },
        });
        

        $('#shipD').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.settings.shipping-distance-amount.index') }}",
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'from_km', name: 'from_km' },
                    { data: 'to_km', name: 'to_km' },
                    { data: 'amount', name: 'amount' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions' }
                ]
        });

    });
</script>
@endpush
