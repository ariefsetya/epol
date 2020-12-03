
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="twitter:site" content="@metroui">
    <meta name="twitter:creator" content="@pimenov_sergey">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Metro 4 Components Library">
    <meta name="twitter:description" content="Metro 4 is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with responsive grid system, extensive prebuilt components, and powerful plugins  .">
    <meta name="twitter:image" content="https://metroui.org.ua/images/m4-logo-social.png">

    <meta property="og:url" content="https://metroui.org.ua/index.html">
    <meta property="og:title" content="Metro 4 Components Library">
    <meta property="og:description" content="Metro 4 is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with responsive grid system, extensive prebuilt components, and powerful plugins  .">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://metroui.org.ua/images/m4-logo-social.png">
    <meta property="og:image:secure_url" content="https://metroui.org.ua/images/m4-logo-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="968">
    <meta property="og:image:height" content="504">

    <meta name="author" content="Sergey Pimenov">
    <meta name="description" content="The most popular HTML, CSS, and JS library in Metro style.">
    <meta name="keywords" content="HTML, CSS, JS, Metro, CSS3, Javascript, HTML5, UI, Library, Web, Development, Framework">

    <!-- <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon"> -->
    <!-- <link rel="icon" href="../../favicon.ico" type="image/x-icon"> -->

    <link href="{{url('/css/metro-all.css?ver=@b-version')}}" rel="stylesheet">
    <link href="{{url('/css/start/start.css')}}" rel="stylesheet">

    <title>Start screen demo - Metro 4 :: Popular HTML, CSS and JS library</title>
</head>
<body class="bg-dark fg-white h-vh-100 m4-cloak">

    <div class="container-fluid start-screen h-100">
        <h1 class="start-screen-title"></h1>

        <div class="tiles-area clear">
            <div class="tiles-grid tiles-group size-3 fg-white" data-group-title="General">
                <a href="{{url('admin')}}" data-role="tile" class="bg-teal fg-white">
                    <span class="mif-dashboard icon"></span>
                    <span class="branding-bar">Dashboard</span>
                </a>
                <a href="{{url('/')}}" data-role="tile" class="bg-red fg-white" data-size="wide">
                    <span class="mif-earth icon"></span>
                    <span class="branding-bar">View Website</span>
                </a>
                <a href="{{url('admin/user')}}" data-role="tile" class="bg-blue fg-white" data-size="wide">
                    <span class="mif-users icon"></span>
                    <span class="branding-bar">Users</span>
                </a>
                <a data-role="tile" class="bg-brown fg-white" data-size="wide">
                    <span class="mif-tags icon"></span>
                    <span class="branding-bar">Lottery Participant Category</span>
                    <span class="badge-bottom">10</span>
                </a>
            </div>
            <div class="tiles-grid tiles-group size-3 fg-white" data-group-title="Polling Website">
                <a href="{{url('admin/polling')}}" data-role="tile" class="bg-teal fg-white">
                    <span class="mif-chart-pie icon"></span>
                    <span class="branding-bar">Polling</span>
                </a>
                <a href="{{url('admin/polling_question')}}" data-role="tile" class="bg-red fg-white" data-size="wide">
                    <span class="mif-earth icon"></span>
                    <span class="branding-bar">Question</span>
                </a>
                <a href="{{url('admin/polling_answer')}}" data-role="tile" class="bg-blue fg-white" data-size="wide">
                    <span class="mif-users icon"></span>
                    <span class="branding-bar">Answer</span>
                </a>
            </div>

            <div class="tiles-grid tiles-group size-2 fg-white" data-group-title="Report">
                <a href="{{url('admin/presence/report')}}" data-role="tile" class="bg-blue fg-white" >
                    <span class="mif-users icon"></span>
                    <span class="branding-bar">Presence</span>
                </a>
                <div data-role="tile" class="bg-orange fg-white">
                    <span class="mif-chart-pie icon"></span>
                    <span class="branding-bar">Polling</span>
                </div>
            </div>

            <div class="tiles-grid tiles-group size-2 fg-white" data-group-title="Lottery">
                <a data-role="tile" data-size="wide" href="{{url('/lottery/scan')}}">
                    <span class="mif-qrcode icon"></span>
                    <span class="branding-bar">Scan</span>
                </a>
                <a href="{{url('/lottery/display')}}" data-role="tile" class="bg-white fg-black">
                    <span class="mif-display icon"></span>
                    <span class="branding-bar">Display</span>
                </a>
                <a href="{{url('/lottery/report')}}" data-role="tile" class="bg-teal fg-white">
                    <span class="mif-file-text icon"></span>
                    <span class="branding-bar">Report</span>
                </a>
                <a href="{{url('/participant/list')}}" data-role="tile" class="bg-indigo fg-white" data-size="wide">
                    <span class="mif-users icon"></span>
                    <span class="branding-bar">Participant</span>
                    <span class="badge-bottom">10</span>
                </a>
            </div>

            <div href="{{url('lottery_setting')}}" class="tiles-grid tiles-group size-2 fg-white" data-group-title="Settings">
                <a data-role="tile" class="bg-green fg-white">
                    <span class="mif-cog icon"></span>
                    <span class="branding-bar">Lottery</span>
                </a>
                <a href="{{url('polling_setting')}}" data-role="tile" class="bg-red fg-white">
                    <span class="mif-cog icon"></span>
                    <span class="branding-bar">Polling</span>
                </a>
                <a href="{{url('event_setting')}}" data-role="tile" class="bg-red fg-white">
                    <span class="mif-cog icon"></span>
                    <span class="branding-bar">Event</span>
                </a>
                <a data-role="tile" class="bg-blue fg-white" href="{{url('/admin/event_detail')}}">
                    <span class="mif-cog icon"></span>
                    <span class="branding-bar">Event Detail</span>
                </a>
            </div>

        </div>
    </div>


    <script src="{{url('/js/metro.js')}}"></script>
    <script src="{{url('/js/start/start.js')}}"></script>

</body>
</html>