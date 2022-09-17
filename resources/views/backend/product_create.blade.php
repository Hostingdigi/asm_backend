@extends('backend.layouts.app')
@section('title', 'Products | Create Product')
@push('after-styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('content')
<x-backend.card>
    <x-slot name="header">
        Create New Product
    </x-slot>

    <x-slot name="headerActions">
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">
            <i class="fa fa-arrow-left"></i>
            BACK
        </a>
    </x-slot>
    
    <x-slot name="body">
            <form method="post" action="{{ route('admin.products.store') }}" id="createProductForm" enctype="multipart/form-data">

                        {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <label class="form-label fw-bolder" for="sup">Supplier</label>
                        <select required class="form-control" name="sup" required>
                            @foreach($sup as $su)
                            <option value="{{ $su->id }}">{{ $su->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bolder" for="exampleFormControlInput1">Category</label>
                        <select required class="form-control" name="category" required>
                            @foreach($category as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bolder" for="exampleFormControlInput1">Brand</label>
                        <select class="form-control" name="brand">
                            <option value="">--select--</option>
                            @foreach($brand as $b)
                            <option value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_code">Product Code</label>
                        <input class="form-control" name="pro_code" type="text" placeholder="Enter product code">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_name">Name</label>
                        <input class="form-control" id="pro_name" required name="pro_name" type="name" placeholder="Enter product name">
                    </div>
                    
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_image">Main Image</label>
                        <br>
                        <input class="" name="pro_image" type="file">
                    </div>

                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_image">Additional Images</label>
                        <br>
                        <input class="" name="add_image[]" multiple type="file">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_desc">Description</label>
                        <textarea class="form-control" name="pro_desc" id="pro_desc" rows="3"></textarea>
                    </div>
                </div>

                <hr>
                <h5>Variants:</h5>
                <input type="hidden" id="var_rows" name="var_rows" value="1">
                <div class="row var_row" id="main_row_1">
                    <div class="col">
                        <label class="form-label fw-bolder" for="var_name_1">Name</label>
                        <input class="form-control" name="var_name_1" type="text" required placeholder="Enter Name">
                    </div>

                    <div class="col">
                        <label class="form-label fw-bolder" for="var_unit_1">Unit</label>
                        <select required class="form-control" name="var_unit_1">
                            @foreach($units as $u)
                            <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bolder" for="var_price_1">Price</label>
                        <input class="form-control" required name="var_price_1" type="text" placeholder="Enter Price">
                    </div>
                    <div class="col">
                        <button type="button" id="addRow" class="btn btn-success btn-sm" style="margin-top:2rem"><i class="fa fa-plus"></i> ADD</button>
                    </div>
                </div>

                <hr>
        </x-slot>

        <x-slot name="footer" >
            <button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-check"></i> SAVE</button>
            </form>
        </x-slot>

    </x-backend.card>
@endsection

@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready( function () {

        $('#pro_desc').summernote();

        var unitOptions = '';
        @foreach($units as $u)
            unitOptions +=' <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>';
        @endforeach

        $("#createProductForm").validate({
            rules: {
                pro_name : {
                    required : true,
                    remote: {
                        url: "{{ route('admin.products.checkDuplicate') }}",
                        type: "post",
                        data : {
                            '_token' : function() { return $("meta[name='csrf-token']").attr('content'); },
                        }
                    }
                }
            },
            messages : {
                pro_name : {
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

        $("#createProductForm").on("blur", function(){
            if($("#createProductForm").valid())
            {
                $("#createProductForm button[type='submit']").removeAttr("disabled");
            }
        });

        $("body").on("click", ".deleteRow", function(){
            $("#main_row_"+$(this).data("rowid")).remove();
        });

        $("#addRow").on("click", function(e){

            var incVal = parseInt($("#var_rows").val());
            incVal++;
            var htmlContent = '<div class="row var_row" id="main_row_'+incVal+'">';
                htmlContent += '<div class="col"><br><label class="form-label fw-bolder" for="var_name_'+incVal+'">Name</label>';
                htmlContent += '<input class="form-control" name="var_name_'+incVal+'" type="text" required placeholder="Enter Name"></div>';
                htmlContent += '<div class="col"><br><label class="form-label fw-bolder" for="var_unit_'+incVal+'">Unit</label>';
                htmlContent += '<select required class="form-control" name="var_unit_'+incVal+'">'+unitOptions+'</select></div>';
                htmlContent += '<div class="col"><br><label class="form-label fw-bolder" for="var_price_'+incVal+'">Price</label>';
                htmlContent += '<input class="form-control" required name="var_price_'+incVal+'" type="text" placeholder="Enter Price"></div>';
                htmlContent += '<div class="col"><button type="button" style="margin-top:3rem" data-rowid="'+incVal+'" class="btn btn-danger btn-sm deleteRow" style="margin-top:2rem"><i class="fa fa-minus"></i> REMOVE</button></div>';
                htmlContent += '</div>';
                $("#var_rows").val(incVal);
            $(".var_row:last").after(htmlContent);
        });

    });
</script>
@endpush
