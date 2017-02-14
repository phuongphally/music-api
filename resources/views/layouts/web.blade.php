<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ url('/') }}/css/bootstrap.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/main.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/custom.css" rel="stylesheet">
    <!-- Scripts -->
</head>
<body>
    <div>
        @yield('content')
    </div>
    <footer class="text-center">
        <p>  Copyright &copy; <?php echo date('Y'); ?> by <a href="http://slekcode.com/"> SlekCode </a> </p>
    </footer>
    <!-- Scripts -->
    <script src="{{ url('/') }}/js/app.js"></script>
    <script>
    $( ".close" ).click(function() {
      $(".pos-top").remove();
    });
</script>
</body>
</html>
