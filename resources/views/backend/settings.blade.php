@extends('backend.layouts.app')
@section('title', __('Application Data'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Application Data           
            <div class="modal fade" id="createHomeBanner" tabindex="-1" aria-labelledby="createHomeBanner" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createHomeBanner">Create New Banner</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.settings.application-data.storeBanner') }}" id="createHBannerForm" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label">Banner Image <sup class="required">*</sup></label><br>
                                    <input type="file" required name="banner_image" />
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label">Redirect Screen</label>
                                    <select name="red_screen" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="category">Category</option>
                                        <option value="product">Product</option>
                                        <option value="coupon">Coupon</option>
                                        <option value="referral">Referral</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Resource</label><br>
                                        <select name="resource" class="form-control">
                                            <option value="">--select--</option>
                                        </select>
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
            <div class="modal fade" id="editHomeBanner" tabindex="-1" aria-labelledby="editHomeBanner" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editHomeBanner">Update Banner</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" id="editHomePageForm" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="updId" name="updId">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label">Banner Image</label><br>
                                    <input type="file" name="banner_image" />
                                    <img src="" width="75" height="75" id="upBan">
                                </div>
                                <div class="col-6">
                                    <label class="col-form-label">Redirect Screen</label>
                                    <select name="red_screen" id="red_screen" class="form-control">
                                        <option value="">--select--</option>
                                        <option value="category">Category</option>
                                        <option value="product">Product</option>
                                        <option value="coupon">Coupon</option>
                                        <option value="referral">Referral</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-form-label">Resource</label><br>
                                        <select name="resource" id="resource" class="form-control">
                                            <option value="">--select--</option>
                                        </select>
                                    </div>
                                </div>
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
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                               <strong>Homepage Banner's</strong>
                            </button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-12 p-3">
                                    <a href="#createHomeBanner" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right"> <i class="fa fa-plus"></i> CREATE</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table id="hBannerTable" class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                            <th>#</th>
                                            <th>BANNER</th>
                                            <th>REDIRECT SCREEN</th>
                                            <th>SOURCE</th>
                                            <th>STATUS</th>
                                            <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">... 2</div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">... 3</div> -->
                    </div>
                </div>
            </div>
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
                    $("#editHomePageForm").attr('action',"{{ route('admin.settings.application-data.update') }}");
                    $("#red_screen").val(result['data']['red_screen']);
                    var htmlContent = '<option value="">--select--</option>';
                    if((result.data.resourceList).length){
                        (result.data.resourceList).forEach(element => {
                            htmlContent+='<option value="'+element.id+'">'+element.name+'</option>';
                        })
                    }
                    $("#resource").html(htmlContent).val(result['data']['resource']);
                    $("#upBan").attr("src",result['data']['image']);
                    $("#updId").val(result.data.id);
                    $("#editHomeBanner").modal("show");
                }
            });
        });

        $("#createHBannerForm").validate({...validationOptions});

        var createResource = "select[name='resource']";
        $("select[name='red_screen']").on('change', function(e){
            var optionValue = $(this).val();
            if(optionValue.length>0){
                $.ajax({
                    type : 'POST',
                    url : "{{ route('admin.settings.application-data.getResource') }}",
                    dataType : 'JSON',
                    data : {screen:optionValue,_token:"{{ csrf_token() }}"},
                    success: function(result)
                    {
                        var htmlContent = '<option value="">--select--</option>';
                        (result.data).forEach(element => {
                            htmlContent+='<option value="'+element.id+'">'+element.name+'</option>';
                        })
                        $(createResource).html(htmlContent);
                    }
                });
            }else{
                $(createResource).html('<option value="">--select--</option>');                
            }
        });

        $('#hBannerTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.settings.application-data',['type' => 'home-banners']) }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'image', name: 'image' },
                { data: 'red_screen', name: 'red_screen' },
                { data: 'resource', name: 'resource' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions' }
            ]
        });
    });
</script>
@endpush