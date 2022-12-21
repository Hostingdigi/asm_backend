@extends('backend.layouts.app')

@section('title', __('Delivery Date'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            List All Locked Delivery Days

            <div class="modal fade" id="createBrand" tabindex="-1" aria-labelledby="createBrandLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createBrandLabel">Add New Date</h5>
                            <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('admin.settings.delivery-date.saveDate') }}" id="createBrandForm" novalidate>
                        <div class="modal-body">
                        {{csrf_field()}}
                            <div class="mb-3">
                                    <label class="col-form-label">Name</label>
                                    <input type="text" required class="form-control" id="datepicker" name="day_date" placeholder="Pick your date" autofocus />
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
            <h3>Week Days:</h3>
            <table id="weekTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>NAME</th>
                    <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weedays as $wk => $week)
                    <tr>
                        <td>{{$wk+1}}</td>
                        <td>{{ucwords($week->day)}}</td>
                        <td>
                            @if($week->status=='1')
                            <input type="checkbox" name="weekDay" class="blockday" checked value="{{ $week->id }}" /> Locked
                            @else
                            <input type="checkbox" name="weekDay" class="blockday" value="{{ $week->id }}" /> Un Locked
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                <hr>
<br>
                <div class="row">
                    <div class="col">
                <h3>Special Dates:</h3>
                    </div>
                    <div class="col">
 <a href="#createBrand" data-coreui-toggle="modal" class="btn btn-success btn-sm float-right">
                <i class="fa fa-plus"></i>
                ADD NEW DATE
            </a>

                    </div>

                </div>
<br>
                <table id="brandTable2" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($days as $dk => $day)
                    <tr>
                        <td>{{$dk+1}}</td>
                        <td>{{ucwords($day->day_date)}}</td>
                        <td>
                            <a class="btn btn-danger btn-sm removeDate" data-id="{{ $day->id }}"><i class="fa fa-minus"></i> REMOVE</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {

        $(".blockday").on("change", function(e){
            var status = 0;
            if($(this).is(':checked')){
                var status = 1;
            }

            $.ajax({
                method:'post',
                url : "{{ route('admin.settings.delivery-date.saveWeekDay') }}",
                data : {
                    _token : "{{ csrf_token() }}",
                    weekId : $(this).val(),
                    statusValue : status,
                },
                success: function(){
                    alert("Successfully updated")
                }
            })

        });

        $(".removeDate").on("click", function(e){
            $.ajax({
                method:'post',
                url : "{{ route('admin.settings.delivery-date.removeDay') }}",
                data : {
                    _token : "{{ csrf_token() }}",
                    dayId : $(this).data('id'),
                },
                success: function(){
                    alert("Successfully remvoed");
                    window.location.reload();
                }
            })

        });

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

        $('#brandTable2').DataTable();

        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '+d'
        });
    });
</script>
@endpush
