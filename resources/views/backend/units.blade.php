@extends('backend.layouts.app')

@section('title', __('Units'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            List All Units
            <a href="#createUnit" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                CREATE
            </a>

            <div class="modal fade" id="createUnit" tabindex="-1" aria-labelledby="createUnitLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createUnitLabel">Create New Unit</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.masters.units.store') }}" id="createUnitForm" novalidate>
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="mb-3">
                                    <label class="col-form-label">Name</label>
                                    <input type="text" required class="form-control" id="add_unit_name" name="unit_name" placeholder="Enter your unit name" autofocus />
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

            <div class="modal fade" id="editUnit" tabindex="-1" aria-labelledby="editUnitLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUnit">Update Unit</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" id="editUnitForm" novalidate>
                        <div class="modal-body">
                        {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                    <input type="hidden" name="Unit_id">
                                    <label class="col-form-label">Name</label>
                                    <input type="text" required class="form-control" id="unit_name" name="unit_name" placeholder="Enter your unit name" autofocus />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success btn-sm" type="submit">UPDATE</button>
                            <button class="btn btn-danger btn-sm" type="button" data-coreui-dismiss="modal">CANCEL</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="body">
            <table id="UnitTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>STATUS</th>
                    <th width="20%">ACTIONS</th>
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
                    $("#editUnitForm").attr('action',"{{ route('admin.masters.units.index') }}/"+result['data']['id']);
                    $("input[name='unit_id']").val(result['data']['id']);
                    $("#unit_name").val(result['data']['name']);
                    $("#editUnit").modal("show");
                }
            });
        });

        $("#editUnitForm").validate({
            rules: {
                unit_name : {
                    required : true,
                    remote: {
                        url: "{{ route('admin.masters.units.checkDuplicate') }}",
                        type: "post",
                        data : {
                            '_token' : function() { return $("meta[name='csrf-token']").attr('content'); },
                            'rowId' : function() { return $.trim($("input[name='unit_id']").val()) }
                        }
                    }
                }
            },
            messages : {
                unit_name : {
                    remote : 'This unit is already exists'
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                element.after(error).addClass('is-invalid');
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            },
        });

        $("#createUnitForm").validate({
            rules: {
                unit_name : {
                    required : true,
                    remote: {
                        url: "{{ route('admin.masters.units.checkDuplicate') }}",
                        type: "post",
                        data : {
                            '_token' : function() { return $("meta[name='csrf-token']").attr('content'); },
                        }
                    }
                }
            },
            messages : {
                unit_name : {
                    remote : 'This unit is already exists'
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                element.after(error).addClass('is-invalid');
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            },
        });

        $("#add_unit_name").on("blur", function(){
            if($("#createUnitForm").valid())
            {
                $("#createUnitForm button[type='submit']").removeAttr("disabled");
            }
        });

        $("#unit_name").on("blur", function(){
            if($("#editUnitForm").valid())
            {
                $("#editUnitForm button[type='submit']").removeAttr("disabled");
            }
        });

        $('#UnitTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.masters.units.index') }}",
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions' }
                ]
        });

    });
</script>
@endpush
