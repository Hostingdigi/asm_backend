@extends('backend.layouts.app')

@section('title', __('Brands'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            List All Brands
            <a href="#createBrand" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                CREATE
            </a>

            <div class="modal fade" id="createBrand" tabindex="-1" aria-labelledby="createBrandLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createBrandLabel">Create New Brand</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.masters.brands.store') }}" id="createBrandForm" novalidate>
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="mb-3">
                                    <label class="col-form-label">Name</label>
                                    <input type="text" required class="form-control" name="brand_name" placeholder="Enter your brand name" autofocus />
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

            <div class="modal fade" id="editBrand" tabindex="-1" aria-labelledby="editBrandLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBrand">Update Brand</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" id="editBrandForm" novalidate>
                        <div class="modal-body">
                        {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                    <input type="hidden" name="brand_id">
                                    <label class="col-form-label">Name</label>
                                    <input type="text" required class="form-control" id="brand_name" name="brand_name" placeholder="Enter your brand name" autofocus />
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
            <table id="brandTable" class="table table-bordered table-hover">
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
                    $("#editBrandForm").attr('action',"{{ route('admin.masters.brands.index') }}/"+result['data']['id']);
                    $("input[name='brand_id']").val(result['data']['id']);
                    $("#brand_name").val(result['data']['name']);
                    $("#editBrand").modal("show");
                }
            });
        });

        $("#editBrandForm").validate({});

        $("#createBrandForm").validate(/*{
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("error invalid-feedback");
                element.parent("div.form-group").append(error);
                element.addClass('is-invalid');
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
        }*/);

        $('#brandTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.masters.brands.index') }}",
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
