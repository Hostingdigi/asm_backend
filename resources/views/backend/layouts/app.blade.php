<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @yield('meta')

    @stack('before-styles')
    <link href="{{ url('backend/css/main.css') }}" rel="stylesheet">
    <link href="{{ url('backend/css/backend.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700">
    <link media="all" type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    @stack('after-styles')
</head>
<body class="c-app">
    @include('backend.includes.sidebar')

    <div class="c-wrapper c-fixed-components">
        @include('backend.includes.header')
        @include('includes.partials.read-only')
        @include('includes.partials.logged-in-as')
        @include('includes.partials.announcements')

        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        @include('includes.partials.messages')
                        @yield('content')
                    </div><!--fade-in-->
                </div><!--container-fluid-->
            </main>
        </div><!--c-body-->

        @include('backend.includes.footer')
    </div><!--c-wrapper-->

    @stack('before-scripts')
    <script src="{{ url('backend/js/main.js') }}"></script>

    <script src="{{ url('backend/js/manifest.js') }}"></script>
    <script src="{{ url('backend/js/vendor.js') }}"></script>
    <script src="{{ url('backend/js/backend.js') }}"></script>
    <script src="{{ url('livewire/livewire.js') }}"></script>

    <script src="{{ url('backend/js/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('backend/js/jquery-validation/js/additional-methods.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    @stack('after-scripts')

    <script>
        $(document).ready( function () {
            $("body").on("click", ".changeStatus", function(e)
            {
                var altBtnId = $(this).data('id');
                if(altBtnId)
                {
                    var btnId = $(this).attr('id');
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to change the this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2eb85c',
                    cancelButtonColor: '#e55353',
                    confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                        if (result.value) {
                            $.get($(this).data("rowurl"), function(result)
                            {
                                Swal.fire( 'Success!', '', 'success'
                                    ).then(()=>{
                                        if(altBtnId)
                                        {
                                            $('body a#'+btnId).hide();
                                            $('body a#'+altBtnId).show();
                                        }else{
                                            window.location.reload();
                                        }
                                    })
                            },'JSON');
                        }
                    });
            });

            $("body").on("click", ".removeRow", function(e)
            {
                var clinicId = $(this).data('clinic');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2eb85c',
                    cancelButtonColor: '#e55353',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {

                        $.get($(this).data("rowurl"), function(result)
                                    {
                                        Swal.fire(
                        'Success!',
                        '',
                        'success'
                        ).then(()=>{

                            if(clinicId)
                            {
                                $('body #viewConsult_btn_'+clinicId).trigger('click');
                            }else{
                                window.location.reload();
                            }
                        })
                                    },'JSON');

                    }
            });

            });
        });
    </script>
</body>
</html>
