<!DOCTYPE html>
<html lang="en" class=" scrollbar-type-1 sb-cyan">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Metro 4 -->
    <link rel="stylesheet" href="{{url('vendors/metro4/css/metro-all.min.css')}}">
    <link rel="stylesheet" href="{{url('css/index.css')}}">

    <title>Pandora - Admin template build with Metro 4</title>

    <script>
        window.on_page_functions = [];
    </script>
</head>
<body class="m4-cloak h-vh-100">
<div data-role="navview" data-toggle="#paneToggle" data-expand="xl" data-compact="lg" data-active-state="true">
    <div class="navview-pane">
        <div class="bg-cyan d-flex flex-align-center">
            <button class="pull-button m-0 bg-darkCyan-hover">
                <span class="mif-menu fg-white"></span>
            </button>
            <h2 class="text-light m-0 fg-white pl-7" style="line-height: 52px">Pandora</h2>
        </div>

        <div class="suggest-box">
            <div class="data-box">
                <img src="{{url('images/jek_vorobey.jpg')}}" class="avatar">
                <div class="ml-4 avatar-title flex-column">
                    <a href="#" class="d-block fg-white text-medium no-decor"><span class="reduce-1">Jack Sparrow</span></a>
                    <p class="m-0"><span class="fg-green mr-2">&#x25cf;</span><span class="text-small">online</span></p>
                </div>
            </div>
            <img src="{{url('images/jek_vorobey.jpg')}}" class="avatar holder ml-2">
        </div>

        @include('utils.side-menu') 

        <div class="w-100 text-center text-small data-box p-2 border-top bd-grayMouse" style="position: absolute; bottom: 0">
            <div>&copy; {{date("Y")}}</div>
            <div>Created with <a href="https://metroui.org.ua" class="text-muted fg-white-hover no-decor">Metro 4</a></div>
        </div>
    </div>

    <div class="navview-content h-100">
        <div data-role="appbar" class="pos-absolute bg-darkCyan fg-white">

            <a href="#" class="app-bar-item d-block d-none-lg" id="paneToggle"><span class="mif-menu"></span></a>

            <div class="app-bar-container ml-auto">
                <a href="#" class="app-bar-item">
                    <span class="mif-envelop"></span>
                    <span class="badge bg-green fg-white mt-2 mr-1">4</span>
                </a>
                <a href="#" class="app-bar-item">
                    <span class="mif-bell"></span>
                    <span class="badge bg-orange fg-white mt-2 mr-1">10</span>
                </a>
                <a href="#" class="app-bar-item">
                    <span class="mif-flag"></span>
                    <span class="badge bg-red fg-white mt-2 mr-1">9</span>
                </a>
                <div class="app-bar-container">
                    <a href="#" class="app-bar-item">
                        <img src="{{url('images/jek_vorobey.jpg')}}" class="avatar">
                        <span class="ml-2 app-bar-name">Jack Sparrow</span>
                    </a>
                    <div class="user-block shadow-1" data-role="collapse" data-collapsed="true">
                        <div class="bg-darkCyan fg-white p-2 text-center">
                            <img src="{{url('images/jek_vorobey.jpg')}}" class="avatar">
                            <div class="h4 mb-0">Jack Sparrow</div>
                            <div>Pirate captain</div>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2">
                            <button class="button flat-button">Followers</button>
                            <button class="button flat-button">Sales</button>
                            <button class="button flat-button">Friends</button>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                            <button class="button mr-1">Profile</button>
                            <button class="button ml-1">Sign out</button>
                        </div>
                    </div>
                </div>
                <a href="#" class="app-bar-item">
                    <span class="mif-cogs"></span>
                </a>
            </div>
        </div>

        <div id="content-wrapper" class="content-inner h-100" style="overflow-y: auto">
            @yield('content')
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
<script src="{{url('js/index.js')}}"></script>
</body>
</html>