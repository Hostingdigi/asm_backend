@extends('backend.layouts.app')

@section('title', __('Categories'))

@push('after-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<x-backend.card>
        <x-slot name="header">
            List All Categories

            <a href="#createCategory" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                CREATE
            </a>

            <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryLabel">Create New Category</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.masters.categories.store') }}" id="createCategoryForm" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="mb-3">
                                    <label class="col-form-label">Parent</label>
                                    <select name="parent" class="form-control">
                                        <option value="0">--select--</option>
                                        @foreach($parent as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Name <sup class="required">*</sup></label>
                                        <input type="text" required class="form-control" name="category_name" placeholder="Enter category name" autofocus />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Long Name</label>
                                        <input type="text" class="form-control" name="long_name" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Cut Options</label>
                                        <select name="pack_options[]" id="pack_options" class="js-example-basic-multiple" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Image</label><br>
                                        <input type="file" name="category_image" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Banner Image</label><br>
                                        <input type="file" name="banner_image" />
                                    </div>
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

            <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategory">Update Category</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" id="editCategoryForm" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                        {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                            <div class="mb-3">
                                    <label class="col-form-label">Parent</label>
                                    <select name="parent" id="parent_id" class="form-control">
                                        <option value="0">--select--</option>
                                        @foreach($parent as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Name <sup class="required">*</sup></label>
                                        <input type="text" required class="form-control" id="cat_name" name="category_name" placeholder="Enter category name" autofocus />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Long Name</label>
                                        <input type="text" class="form-control" name="long_name" id="long_name" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Cut Options</label>
                                        <select name="pack_options[]" id="pack_optionsEdit" class="js-example-basic-multiple" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Image</label><br>
                                        <input type="file" name="category_image" />
                                        <br>
                                        <img src="" id="pImg" class="d-none c-avatars-stack mt-2 img-thumbnail" width="85" height="85" >
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Banner Image</label><br>
                                        <input type="file" name="banner_image" />
                                        <br>
                                        <img src="" id="bImg" class="d-none c-avatars-stack mt-2 img-thumbnail" width="85" height="85" >
                                    </div>
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

        </x-slot>

        <x-slot name="body">
            <table id="categoryTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>PARENT CATEGORY</th>
                    <th>NAME</th>
                    <th>IMAGE</th>
                    <th>BANNER IMAGE</th>
                    <th>CUT OPTIONS</th>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready( function () {

        $("#pack_options").select2({
            width : '100%',
            tags: true
        });

        $("#pack_optionsEdit").select2({
            width : '100%',
            tags: true
        });

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
                    $("#long_name").val(result['data']['long_name']);
                    let options = [];
                    let pOptions = result['data']['cut_options'];
                    if(pOptions.length){
                        $('#pack_optionsEdit').select2('destroy');
                        pOptions.forEach(v => options.push({id:v,text:v}));
                        $('#pack_optionsEdit').select2({
                            width:'100%',
                            tags:true,
                            data: options 
                        });
                        $("#pack_optionsEdit").val(pOptions).trigger('change');
                    }else{
                        $('#pack_optionsEdit').empty().trigger("change");
                    }

                    if(!result['data']['image']){
                        $("#pImg").attr("src","").addClass("d-none");
                    }else{
                        $("#pImg").removeClass("d-none").attr("src",result['data']['image']);
                    }
                    if(!result['data']['banner_image']){
                        $("#bImg").attr("src","").addClass("d-none");
                    }else{
                        $("#bImg").removeClass("d-none").attr("src",result['data']['banner_image']);
                    }
                    $("#editCategory").modal("show");
                }
            });
        });

        $("#editCategoryForm").validate({});

        $("#createCategoryForm").validate({
            rules: {
                category_name : {
                    required : true,
                    remote: {
                        url: "{{ route('admin.masters.categories.checkDuplicate') }}",
                        type: "post",
                        data : {
                            '_token' : function() { return $("meta[name='csrf-token']").attr('content'); },
                        }
                    }
                }
            },
            messages : {
                category_name : {
                    remote : 'This product name is already exists'
                }
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("text-danger");
                element.after(error).addClass('is-invalid');
            },
            highlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-valid").addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            },
        });

        $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.masters.categories.index') }}",
            columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'parent', name: 'parent' },
                    { data: 'name', name: 'name' },
                    { data: 'image', name: 'image' },
                    { data: 'banner_image', name: 'banner_image' },
                    { data: 'cut_options', name: 'cut_options' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions' }
                ]
        });

    });
</script>
@endpush
