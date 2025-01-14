<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.7.0') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>SwipeLoan</title>
    <link rel="icon" href="{{ asset('assets/images/favicons/cropped-swipefund_logo-32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('assets/images/favicons/cropped-swipefund_logo-192x192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicons/cropped-swipefund_logo-190x180.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('assets/images/favicons/cropped-swipefund_logo-270x270.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    @yield('style')

    <style>
        .invoice {
            font-family: 'Roboto', sans-serif;
            color: #000;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            padding: 10px;
            text-align: center;
        }

        footer {
            font-family: 'Roboto', sans-serif;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            padding: 10px;
            text-align: center;
        }

        #header_title{
            font-size: 17px;
        }

        #page_title{
            margin-top: 10px;
        }

        #header_subTitle{
            font-size: 12px;
        }

        body{
            position: relative;
        }

        @page {
            margin: 10px 40px;
        }

        section{
            margin-top: 160px; 
        }

        .page-break {
            page-break-before: always;
        }

        #myTable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 13px;
        }

        #myTable th {
            border: 1px solid black;
            text-align: center;
            padding: 2px 5px;
        }

        #myTable td {
            border: 1px solid black;
            padding: 2px 5px;
        }

        #myTable td:nth-child(1),
        #myTable td:nth-child(3) {
            text-align: center;
        }

        #myTable1 {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 13px;
        }

        #myTable1 th {
            border: 1px solid black;
            text-align: center;
        }

        #myTable1 td {
            border: 1px solid black;
            text-align: center;
            padding: 1px 5px;
        }

        p{
            text-align: justify;
        }
    </style>
</head>
<body>
    {{-- Header --}}

    <header>
        <div class="invoice invoice-brand text-center">
            <img src="{{ asset('assets/images/app_logo.png') }}" width="80px"  style="margin-bottom: 0px;" alt=""><br>
            <span id="header_title"><b>KGIL FINTECH SOLUTIONS PRIVATE LIMITED</b></span><br>
            <div style="display:flex; justify-content:center; margin-top: 3px;">
                <span id="header_subTitle" style="width: 180px">Regd. Off: OFFICE NO 219 FLR 2 GERA, IMPERIUM RISE NR WIPRO, Infotech Park, <br>
                    Hinjawadi, Pune, Haveli, Maharashtra, India, 411057</span>
            </div>
            <span id="header_subTitle">CIN- <b>U70200PN2024PTC231463</b></span>
        </div>
        <div class="" style="border-bottom: 1px solid #adadad; margin-top: -15px;"></div>
    </header>

    {{-- Footer --}}

    <footer>
        <table style="font-size: 8pt; width: 100%;">
            <tbody>
                <tr>
                    <td width="40%">
                        <span style="font-weight: bold; font-style: italic;">
                            Email id: Info@swipeloan.in <br>
                            Telephone no: 020-6666-2622 <br>
                            website: https://swipeloan.in/
                        </span>
                    </td>
                    <td style="text-align: right; font-weight: bold; width: 55%;">KGIL FINTECH SOLUTIONS PRIVATE LIMITED <br>
                        Corporate Office: OFFICE NO 219 FLR 2 GERA, IMPERIUM RISE NR WIPRO,<br>
                        Infotech Park, Hinjawadi, Pune, Haveli, Maharashtra, India, 411057
                    </td>
                </tr>
            </tbody>
        </table>
    </footer> 

    {{-- Content --}}

    @yield('content') 
</body>
</html>
