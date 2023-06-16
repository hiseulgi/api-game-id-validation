<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
  <meta content="Coderthemes" name="author">
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('/images/users/avatar-2.jpg') }}">

  <!-- third party css -->
  <link href="{{ asset('/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css">
  <!-- third party css end -->

  <!-- App css -->
  <link href="{{ asset('/css/icons.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>

<body>
  <nav class="navbar navbar-light bg-primary">
    <h1 class="navbar-brand mx-5 text-white">Top Up Bang Udin</h1>
  </nav>

  <div class="wrapper">
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <!-- As a heading -->
    <div class="content">
      @yield('content')
    </div>
    <!-- container -->
  </div>
  <!-- content -->

  </div>

  <!-- ============================================================== -->
  <!-- End Page content -->
  <!-- ============================================================== -->

  </div>
  <!-- END wrapper -->

  <!-- bundle -->
  <script src="js/vendor.min.js"></script>
  <script src="js/app.min.js"></script>

</body>

</html>