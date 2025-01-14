<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/yearpicker.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.7.0') }}">
    <title>SwipeLoan – Approved Personal Loan in Just 2 Minutes</title>
    <link rel="icon" href="{{ asset('assets/images/favicons/cropped-swipefund_logo-32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('assets/images/favicons/cropped-swipefund_logo-192x192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicons/cropped-swipefund_logo-190x180.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicons/cropped-swipefund_logo-270x270.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" async="" src="https://www.googletagmanager.com/gtag/js?id=G-D1QW99F3EN&amp;l=dataLayer&amp;cx=c"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-91615293-4"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script src="{{ asset('assets/js/bundle.js?ver=2.7.0') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    @yield('style');

    <style type="text/css">
        #toast-container>div {
            width: 277px !important;
            position: absolute;
            bottom: 0 !important;
            right: 0 !important;
        }

        #toast-container {
            position: absolute;
            bottom: 0 !important;
            right: 0 !important;
        }

        .nk-tb-actions {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .dtr-title {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .dtr-data {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        @media (max-width: 992px) {
            .nk-content-wrap {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body class="nk-body bg-white npc-subscription has-aside no-touch nk-nio-theme">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap">
                @include('layouts.header')
                <div class="nk-content">
                    <div class="container wide-xl" style="margin-top: -40px">
                        <div class="nk-content-inner">
                            @include('layouts.sidebar')
                            <div class="nk-content-body">
                                @yield('content')
                              {{-- @include('layouts.footer') --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/scripts.js?ver=2.7.0') }}"></script>
    <script src="{{ asset('assets/js/yearpicker.js') }}"></script>
    <script src="{{ asset('assets/js/libs/datatable-btns.js?ver=3.1.1') }}"></script>
    <script src="{{ asset('assets/js/charts/gd-analytics.js?ver=3.2.3') }}"></script>

    <script type="text/javascript">
        $.fn.select2.defaults.set("theme", "bootstrap");

        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    @yield('scriptJs')
</body>
</html>
