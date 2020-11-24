<!DOCTYPE html>
<html lang="en" class=" scrollbar-type-1 sb-cyan">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="{{url('vendors/metro4/css/metro-all.min.css')}}">
    <link rel="stylesheet" href="{{url('css/index.css')}}">

    <title>{{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','website_title')->first()->content}}</title>

    <script>
        window.on_page_functions = [];
    </script>
</head>
<body class="">
    <div>

        <div class="">

            <div id="content-wrapper" class="content-inner" style="overflow-y: auto">
                <div class="shifted-content p-ab">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery first, then Metro UI JS -->
    <script src="{{url('vendors/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('vendors/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{url('vendors/qrcode/qrcode.min.js')}}"></script>
    <script src="{{url('vendors/jsbarcode/JsBarcode.all.min.js')}}"></script>
    <script src="{{url('vendors/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('vendors/metro4/js/metro.min.js')}}"></script>
    @yield('footer')
</body>
</html>