<!-- app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>E-Registration | Admin</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{url('vendors/metro4/css/metro-all.min.css')}}">
  <link rel="stylesheet" href="{{url('css/index.css')}}">


</head>

<body style="position: relative;background-color: white;
@if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','quiz_report_background')->exists())
background-image: url({{\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','quiz_report_background')->first()->content ?? ''}});background-size: 100%;background-repeat: no-repeat;background-attachment: fixed;
@endif
min-height: 100% !important;">

  <!-- Page Wrapper -->
  <div>

    <!-- Content Wrapper -->
    <div>

      <!-- Main Content -->
      <div>

        <!-- Begin Page Content -->
        <div>
          @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
<script src="{{url('vendors/jquery/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('vendors/metro4/js/metro.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('vendors/chartjs/Chart.min.js') }}"></script>

  @yield('footer')
</body>
<script type="text/javascript">
  $("body").fadeIn();
</script>

</html>
