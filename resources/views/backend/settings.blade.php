@extends('backend.layouts.app')
@section('title', __('Mobile Application'))
@push('after-styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <x-backend.card>
        <x-slot name="header">
            Mobile Application     
            @if(request()->tab =='homepage_banner')    
            <div class="modal fade" id="createHomeBanner" tabindex="-1" aria-labelledby="createHomeBanner" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createHomeBanner">Create New Banner</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.settings.mobile-application.storeBanner') }}" id="createHBannerForm" novalidate enctype="multipart/form-data">
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
            @endif

            @if(request()->tab =='order_success_notes')
            <div class="modal fade" id="createOrdSucNote" tabindex="-1" aria-labelledby="createHomeBanner" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createHomeBanner">Update Notes</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.settings.mobile-application.ord-note-save') }}" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Notes</label>
                                    <textarea name="ord_note" id="ord_note">{{$successNotes->notes??''}}</textarea>
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
            @endif

            @if(request()->tab =='dynamic_pages')
            <div class="modal fade" id="createDynamicPages" tabindex="-1" aria-labelledby="createDynamicPages" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Dynamic Page</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="createDynamicPagesForm" action="{{ route('admin.settings.mobile-application.dynamicPages.store') }}" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Title <sup class="required">*</sup></label>
                                    <input type="text" required class="form-control" name="title" placeholder="Enter the title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Content</label>
                                    <textarea name="dynamic_cnt" id="dynamic_cnt"></textarea>
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

            <div class="modal fade" id="editDynamicPages" tabindex="-1" aria-labelledby="editDynamicPages" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create Dynamic Page</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="editDynamicPagesForm" action="" novalidate enctype="multipart/form-data">
                        <div class="modal-body">
                        <input type="hidden" id="updId" name="updId">
            @method('PUT')
                        {{csrf_field()}}
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Title <sup class="required">*</sup></label>
                                    <input type="text" required class="form-control" name="title" id="etitle" placeholder="Enter the title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Content</label>
                                    <textarea name="dynamic_cnt" id="edynamic_cnt"></textarea>
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
            @endif

        </x-slot>

        <x-slot name="body">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="?tab=homepage_banner" class="nav-link @if(request()->tab =='homepage_banner') active @endif" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                               <strong>Homepage Banner's</strong>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="?tab=order_success_notes" class="nav-link @if(request()->tab =='order_success_notes') active @endif" id="order-success-tab" data-bs-toggle="tab" data-bs-target="#order-success-tab" type="button" role="tab" aria-controls="order-success-tab" aria-selected="false">
                                <strong>Order Success Notes</strong>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="?tab=dynamic_pages" class="nav-link @if(request()->tab =='dynamic_pages') active @endif" id="dynamic_pages-tab" data-bs-toggle="tab" data-bs-target="#dynamic_pages-tab" type="button" role="tab" aria-controls="dynamic_pages-tab" aria-selected="false">
                                <strong>Dynamic Pages</strong>
                            </a>
                        </li>
                        <!--<li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade @if(request()->tab =='homepage_banner') show active @endif" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                        <div class="tab-pane fade @if(request()->tab =='order_success_notes') show active @endif" id="order-success-tab" role="tabpanel" aria-labelledby="order-success-tab">
                            <div class="row">
                                <div class="col-12 p-3">
                                    <a href="#createOrdSucNote" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right"> <i class="fa fa-plus"></i> UPDATE</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table id="hBannerTable2" class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                            <th>#</th>
                                            <th>CONTENT</th>
                                            <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <div>    
                                                        {!! $successNotes->notes ?? '1' !!}
                                                    </div>
                                                </td>
                                                <td><b class="text-success">ACTIVE</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if(request()->tab =='dynamic_pages') show active @endif" id="dynamic_pages-tab" role="tabpanel" aria-labelledby="dynamic_pages-tab">
                            <div class="row">
                                <div class="col-12 p-3">
                                    <a href="#createDynamicPages" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right"> <i class="fa fa-plus"></i> CREATE</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <table id="Table3" class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                            <th>#</th>
                                            <th>KEY</th>
                                            <th>TITLE</th>
                                            <th>CONTENT</th>
                                            <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">... 3</div> -->
                    </div>
                </div>
            </div>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready( function () {

        $("#createHBannerForm, #createDynamicPagesForm").validate({...validationOptions});

        @if(request()->tab=='homepage_banner')

        $("body").on("click", ".editRow", function(e)
        {
            $.ajax({
                type : 'GET',
                url : $(this).data('href'),
                dataType : 'JSON',
                success: function(result)
                {
                    $("#editHomePageForm").attr('action',"{{ route('admin.settings.mobile-application.update') }}");
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

        var createResource = "select[name='resource']";
        $("select[name='red_screen']").on('change', function(e){
            var optionValue = $(this).val();
            if(optionValue.length>0){
                $.ajax({
                    type : 'POST',
                    url : "{{ route('admin.settings.mobile-application.getResource') }}",
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
            ajax: "{{ route('admin.settings.mobile-application',['type' => 'home-banners']) }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'image', name: 'image' },
                { data: 'red_screen', name: 'red_screen' },
                { data: 'resource', name: 'resource' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions' }
            ]
        });

        @endif

        @if(request()->tab=='order_success_notes')
            $("#ord_note").summernote();
        @endif

        @if(request()->tab=='dynamic_pages')
            $("#dynamic_cnt").summernote();
        
            $('#Table3').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.settings.mobile-application.dynamicPages.index') }}",
                columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        { data: 'key', name: 'key' },
                        { data: 'title', name: 'title' },
                        { data: 'content', name: 'content' },
                        { data: 'actions', name: 'actions' }
                    ]
            });

            $("body").on("click", ".editRow", function(e)
            {
                $.ajax({
                    type : 'GET',
                    url : $(this).data('href'),
                    dataType : 'JSON',
                    success: function(result)
                    {
                        $("#edynamic_cnt").summernote('destroy');
                        $("#editDynamicPagesForm").attr('action',result['url']);
                        $("#etitle").val(result['data']['value_3']);
                        $("#edynamic_cnt").val(result['data']['value_1']);
                        $("#edynamic_cnt").summernote();
                        $("#updId").val(result.data.id);
                        $("#editDynamicPages").modal("show");
                    }
                });
            });

        @endif

    });
</script>
@endpush
