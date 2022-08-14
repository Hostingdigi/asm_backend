@extends('backend.layouts.app')
@section('title', 'Products | Edit Product')
@section('content')
<x-backend.card>
    <x-slot name="header">
        Edit Product - {{ ucwords($product->name) }}
    </x-slot>
    
    <x-slot name="headerActions">
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">
            <i class="fa fa-arrow-left"></i>
            BACK
        </a>
    </x-slot>

    <x-slot name="body">
        <form method="post" action="{{ route('admin.products.update',$product->id) }}" id="editProductForm" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col">
                        <label class="form-label fw-bolder" for="sup">Supplier</label>
                        <select required class="form-control" name="sup" required>
                            @foreach($sup as $su)
                            <option @if($product->user_id==$su->id) selected @endif value="{{ $su->id }}">{{ $su->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bolder" for="exampleFormControlInput1">Category</label>
                        <select required class="form-control" name="category" required>
                            @foreach($category as $c)
                            <option @if($product->category_id==$c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bolder" for="exampleFormControlInput1">Brand</label>
                        <select class="form-control" name="brand">
                            <option value="">--select--</option>
                            @foreach($brand as $b)
                            <option @if($product->brand_id==$b->id) selected @endif value="{{ $b->id }}">{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                   
                </div>
                <div class="row">
                     <div class="col">
                        <br>

                        <label class="form-label fw-bolder" for="pro_code">Product Code</label>
                        <input class="form-control" value="{{ trim($product->code) }}" name="pro_code" type="text" placeholder="Enter product code">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_name">Name</label>
                        <input class="form-control" value="{{ trim($product->name) }}" required name="pro_name" type="name" placeholder="Enter product name">
                    </div>
                    
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_image">Cover Image</label>
                        <input class="" name="pro_image" type="file">
                        @if(!empty($product->cover_image))
                        <img class="img-thumbnail mt-2" width="75" height="75" src="{{ asset('assets/'.$product->cover_image) }}">
                        @endif
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
                        <textarea class="form-control" name="pro_desc" rows="3">{{ trim($product->description) }}</textarea>
                    </div>
                </div>
                
                <hr style="height:0px;">
                <h5>Variants:</h5>

                <input type="hidden" id="var_rows" name="var_rows" value="{{ (count($vars) > 0 ?  count($vars) : 1) }}">

                @foreach($vars as $vk => $vari)

                    <div class="row var_row" id="main_row_{{ ($vk+1) }}">
                    <input value="{{ $vari->id }}" name="row_id_{{ ($vk+1) }}" type="hidden">
                    <div class="col">
                        <label class="form-label fw-bolder" for="var_name_{{ ($vk+1) }}">Name</label>
                        <input class="form-control" name="var_name_{{ ($vk+1) }}" value="{{ $vari->name }}" type="text" required placeholder="Enter Name">
                    </div>

                    <div class="col">
                        <label class="form-label fw-bolder" for="var_unit_{{ ($vk+1) }}">Unit</label>
                        <select required class="form-control" name="var_unit_{{ ($vk+1) }}">
                            @foreach($units as $u)
                            <option @if($vari->unit_id==$u['id']) selected @endif value="{{ $u['id'] }}">{{ $u['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bolder" for="var_price_{{ ($vk+1) }}">Price</label>
                        <input class="form-control" value="{{ $vari->price }}" required name="var_price_{{ ($vk+1) }}" type="text" placeholder="Enter Price">
                    </div>
                    <div class="col-1">
                        <label class="form-label fw-bolder" for="var_price_{{ ($vk+1) }}">Status</label>
                        <br>
                        @if($vari->status=='0')
                        <span class="text-secondary" id="isStatusInactive_{{ $vari->id }}">IN-ACTIVE</span>
                        <span class="text-success d-none" id="isStatusActive_{{ $vari->id }}">ACTIVE</span>
                        @else
                        <span class="text-success" id="isStatusActive_{{ $vari->id }}">ACTIVE</span>
                        <span class="text-secondary d-none" id="isStatusInactive_{{ $vari->id }}">IN-ACTIVE</span>
                        @endif
                    </div>
                    <div class="col">
                        @if($vk==0)
                        <button type="button" id="addRow" class="btn btn-success btn-sm" style="margin-top:2rem"><i class="fa fa-plus"></i> ADD</button>
                        @else
                        <button id="isStatusActiveBtn_{{ $vari->id }}"  type="button" data-rowid="{{ $vari->id }}" data-status='1' class="@if($vari->status=='1') d-none @endif btn btn-success btn-sm changeVarRow" style="margin-top:2rem"><i class="fa fa-circle"></i> Make Active</button>
                        <button id="isStatusInactiveBtn_{{ $vari->id }}" type="button" data-rowid="{{ $vari->id }}" data-status='0' class="@if($vari->status=='0') d-none @endif btn btn-secondary btn-sm changeVarRow" style="margin-top:2rem"><i class="fa fa-dot-circle"></i> Make In-Active</button>
                        <button type="button" data-rowid="{{ $vk+1 }}" class="btn btn-danger btn-sm deleteRow" style="margin-top:2rem"><i class="fa fa-minus"></i> REMOVE</button>
                        @endif
                    </div>
                </div>
                <br>
                @endforeach
                <hr>
        </x-slot>

        <x-slot name="footer">
            <button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-check"></i> Save</button>
            </form>
        </x-slot>

    </x-backend.card>

    @if(count($addImages)>0)
    <x-backend.card>
        <x-slot name="header">
            Manage Additional Images
        </x-slot>
        <x-slot name="body">
            @foreach($addImages as $img)
            <div class="row mt-3" id="img_row_{{ $img->id }}">
                <div class="col-2">
                    <img src="{{ asset('assets/'.$img->file_name) }}" width="75" height="75" class="img-thumbnail" alt="">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bolder">Display Order</label>
                    <input data-id="{{ $img->id }}" type="number" min="1" class="form-control display_order" name="display_order" value="{{ $img->display_order }}">
                    <small id="upd_txt_{{ $img->id }}" style="display:none;" class="text-success fw-semibold">Updated</small>
                </div>
                <div class="col">
                    <button type="button" data-id="{{ $img->id }}" class="btn btn-danger btn-sm removeImg" style="margin-top:31px;"><i class="fa fa-minus"></i> REMOVE</button>
                </div>
            </div>
            @endforeach
        </x-slot>
    </x-backend.card>
    @endif

@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {

        var unitOptions = '';
        @foreach($units as $u)
            unitOptions +=' <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>';
        @endforeach

        $("#editProductForm").validate({
            rules: {
                pro_name : {
                    required : true,
                    remote: {
                        url: "{{ route('admin.products.checkDuplicate') }}",
                        type: "post",
                        data : {
                            rowId : '{{ $product->id }}',
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

        $("body").on("click", ".deleteRow", function(){
            $("#main_row_"+$(this).data("rowid")).remove();
        });

        $(".removeImg").on("click", function(e){
            var imgRow = $(this).data("id");
            var updateData = {
                _token:"{{ csrf_token() }}",
                productId:"{{ $product->id }}",
                variant:imgRow
            };
            $.post("{{route('admin.products.removeProImage')}}",updateData,function(result){
                alert(result.message);
                $("#img_row_"+imgRow).remove();
            },'JSON');
        });

        $("body").on("click",".changeVarRow", function(){
            var isStatus = $(this).data('status');
            var rowId = $(this).data('rowid');
            $("#isStatusActive_"+rowId+", "+"#isStatusInactive_"+rowId+", #isStatusActiveBtn_"+rowId+", "+"#isStatusInactiveBtn_"+rowId).addClass('d-none');
            var updateData = {
                _token:"{{ csrf_token() }}",
                productId:"{{ $product->id }}",
                variant:rowId,
                status:isStatus
            };
            $.post("{{route('admin.products.updateVariantStatus')}}",updateData,function(result){
                alert(result.message);
                $((isStatus==1 ? "#isStatusActive_" : "#isStatusInactive_")+rowId).removeClass('d-none');
                $((isStatus==0 ? "#isStatusActiveBtn_" : "#isStatusInactiveBtn_")+rowId).removeClass('d-none');
            },'JSON');
        });

        $(".display_order").on("change", function(e){
            var imgRow = $(this).data("id");
            $("#upd_txt_"+imgRow).slideDown();
            var updateData = {
                _token:"{{ csrf_token() }}",
                productId:"{{ $product->id }}",
                variant:imgRow,
                display : $(this).val()
            };
            $.post("{{route('admin.products.updateDisplayProImage')}}",updateData,function(result){
                setTimeout(function(){
                    $("#upd_txt_"+imgRow).slideUp();
                },500);
            },'JSON');
            
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
                htmlContent += '<div class="col-1"></div><div class="col"><button type="button" style="margin-top:3rem" data-rowid="'+incVal+'" class="btn btn-danger btn-sm deleteRow" style="margin-top:2rem"><i class="fa fa-minus"></i> REMOVE</button></div>';
                htmlContent += '</div>';
                $("#var_rows").val(incVal);
            $(".var_row:last").after(htmlContent);
        });
    });
</script>
@endpush
