<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ url('/') }}/css/bootstrap.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/main.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/custom.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->
                    <a class="navbar-brand pull-left" href="{{ url('/admin/songs') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                     @if (!Auth::guest())
                    <ul class="nav navbar-nav">
                          <li><a href="{{ url('/') }}/admin/songs">Songs</a></li>
                          <li><a href="{{ url('/') }}/admin/artists">Artists</a></li> 
                          <li><a href="{{ url('/') }}/admin/albums">Albums</a></li> 
                          <li><a href="{{ url('/') }}/admin/users">Users</a></li> 
                          <li><a href="{{ url('/') }}/admin/comments">Comments</a></li> 
                          <li><a href="{{ url('/') }}/admin/pages">Pages</a></li> 
                          <li><a href="{{ url('/') }}/admin/feedback">Feedback</a></li> 
                          <li><a href="{{ url('/') }}/admin/requests">Requests</a></li> 
                        </ul>
                     @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                 <li>
                                     <a href="{{ url('/admin/profile') }}"> Profile settings </a>
                                 </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <footer class="text-center">
        <p>  Copyright &copy; <?php echo date('Y'); ?> by <a href="http://slekcode.com/"> SlekCode </a> </p>
    </footer>
    <!-- Scripts -->
    <script src="{{ url('/') }}/js/app.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
    <script>
    $( ".close" ).click(function() {
      $(".pos-top").remove();
    });
</script>
</body>
</html>
