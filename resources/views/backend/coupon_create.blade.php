@extends('backend.layouts.app')
@section('title', 'Coupons | Create Coupon')

@push('before-styles')
<style> .datepicker.datepicker-dropdown {z-index:9999 !important;} </style>
@endpush

@section('content')
<x-backend.card>
    <x-slot name="header">
        Create New Coupon
    </x-slot>

    <x-slot name="headerActions">
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-sm btn-dark">
            <i class="fa fa-arrow-left"></i>
            BACK
        </a>
    </x-slot>
    
    <x-slot name="body">
            <form method="post" action="{{ route('admin.coupons.store') }}" id="createProductForm" enctype="multipart/form-data">
                        {{csrf_field()}}
                <div class="row">
                    <div class="col">
                        <label class="form-label fw-bolder" for="sup">Type</label>
                        <select required class="form-control" name="coupon_type">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount (SGD)</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label fw-bolder" for="sdate">Start Date</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required name="sdate">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label fw-bolder" for="edate">End Date</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse('tomorrow')->format('Y-m-d') }}" required name="edate">
                        </div>
                    </div>
                    <div class="col">
                        <label class="form-label fw-bolder" for="coupon_for">Coupon For</label>
                        <select class="form-control" required id="coupon_for" name="coupon_for">
                            @foreach($couponTypes as $vk => $val)
                                <option @if('common'==$vk) selected @endif value="{{ $vk }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row" id="v_cust_div"></div>

                <div class="row">
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="title">Title</label>
                        <input class="form-control" id="title" required name="title" type="text" placeholder="Enter coupon title">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="cup_code">Code</label>
                        <input class="form-control" required name="cup_code" type="text" placeholder="Enter coupon code">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="off_value">Offer Value</label>
                        <input class="form-control" name="off_value" required id="off_value" min="1" data-rule-number="true" type="text" placeholder="Ener coupon value">
                    </div>
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="image">Banner Image</label>
                        <br>
                        <input class="" name="image" type="file">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <br>
                        <label class="form-label fw-bolder" for="pro_desc">Description</label>
                        <textarea class="form-control" name="pro_desc" rows="3"></textarea>
                    </div>
                </div>
                
        </x-slot>

        <x-slot name="footer" >
            <button type="submit" class="btn btn-success btn-sm float-right"><i class="fa fa-check"></i> CREATE</button>
            </form>
        </x-slot>

    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {

        let supCatOptions = '';
        let  dateOpions = {
            autoclose : true,
            startDate: '1d',
            format : 'yyyy-mm-dd'
        };

        $("input[name='sdate']").datepicker(dateOpions);
        dateOpions.startDate = '+1d';
        $("input[name='edate']").datepicker(dateOpions);

        $("#coupon_for").on("change", function(){

            $("#v_cust_div").show().empty();
            var coupFor = $(this).val();

            if(coupFor=='category'){

                var unitOptions = '';
                @foreach($category as $u)
                    unitOptions +=' <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>';
                @endforeach

                var htmlContent = '<div class="col"><br><label class="form-label fw-bolder" for="off_cat">Category</label>';
                htmlContent += '<select required class="form-control" name="off_cat">'+unitOptions+'</select></div>';
                $("#v_cust_div").html(htmlContent);

            }

            if(coupFor=='supplier'){

                var supOptions  = firstSupId = '';
                @foreach($supplier as $uk => $u)
                    @if($uk==0)
                    firstSupId = "{{ $u['id'] }}";
                    @endif
                    supOptions +=' <option value="{{ $u['id'] }}">{{ $u['name'] }}</option>';
                @endforeach

                $.ajax({
                    url : "{{ route('admin.coupons.listSupplierCategories') }}",
                    method : 'post',
                    async: false,
                    data : {supplier : firstSupId,_token:'{{ csrf_token() }}'},
                    success : function(data){
                        (data.data).forEach((row) => {
                            supCatOptions +=' <option value="'+row.id+'">'+row.name+'</option>';
                        });
                    }
                });

                var htmlContent = '<div class="col"><br><label class="form-label fw-bolder" for="off_sup">Supplier</label>';
                htmlContent += '<select required class="form-control" id="off_sup" name="off_sup">'+supOptions+'</select></div>';
                htmlContent += '<div class="col"><br><label class="form-label fw-bolder" for="off_sup_cat">Category</label>';
                htmlContent += '<select class="form-control" id="off_sup_cat" name="off_sup_cat">'+supCatOptions+'</select></div>';
                $("#v_cust_div").html(htmlContent);
            }
        });

        $('body').on('change','#off_sup', function() {
            
            $.ajax({
                url : "{{ route('admin.coupons.listSupplierCategories') }}",
                method : 'post',
                async: false,
                data : {supplier : $(this).val(),_token:'{{ csrf_token() }}'},
                success : function(data){
                    supCatOptions = '';
                    (data.data).forEach((row) => {
                        supCatOptions +=' <option value="'+row.id+'">'+row.name+'</option>';
                    });
                    $("body #off_sup_cat option").remove();
                    $("body #off_sup_cat").html(supCatOptions);
                }
            });
        });

        $("#createProductForm").validate({
            rules: {
                cup_code : {
                    required : true,
                    remote: {
                        url: "{{ route('admin.coupons.checkDuplicate') }}",
                        type: "post",
                        data : {
                            '_token' : function() { return $("meta[name='csrf-token']").attr('content'); },
                        }
                    }
                }
            },
            messages : {
                cup_code : {
                    remote : 'This coupon code is already exists'
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

    });
</script>
@endpush
