<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Styles -->
    <link href="<?php echo e(url('/')); ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo e(url('/')); ?>/css/main.css" rel="stylesheet">
    <link href="<?php echo e(url('/')); ?>/css/custom.css" rel="stylesheet">
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
                    <a class="navbar-brand pull-left" href="<?php echo e(url('/admin/songs')); ?>">
                        <?php echo e(config('app.name', 'Laravel')); ?>

                    </a>
                     <?php if(!Auth::guest()): ?>
                    <ul class="nav navbar-nav">
                          <li><a href="<?php echo e(url('/')); ?>/admin/songs">Songs</a></li>
                          <li><a href="<?php echo e(url('/')); ?>/admin/artists">Artists</a></li> 
                          <li><a href="<?php echo e(url('/')); ?>/admin/albums">Albums</a></li> 
                          <li><a href="<?php echo e(url('/')); ?>/admin/users">Users</a></li> 
                          <li><a href="<?php echo e(url('/')); ?>/admin/comments">Comments</a></li> 
                          <li><a href="<?php echo e(url('/')); ?>/admin/pages">Pages</a></li> 
                          <li><a href="<?php echo e(url('/')); ?>/admin/feedback">Feedback</a></li> 
                          <li><a href="<?php echo e(url('/')); ?>/admin/requests">Requests</a></li> 
                        </ul>
                     <?php endif; ?>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <?php if(Auth::guest()): ?>
                            <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                            <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                 <li>
                                     <a href="<?php echo e(url('/admin/profile')); ?>"> Profile settings </a>
                                 </li>
                                    <li>
                                        <a href="<?php echo e(url('/logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <footer class="text-center">
        <p>  Copyright &copy; <?php echo date('Y'); ?> by <a href="http://slekcode.com/"> SlekCode </a> </p>
    </footer>
    <!-- Scripts -->
    <script src="<?php echo e(url('/')); ?>/js/app.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
    <script>
    $( ".close" ).click(function() {
      $(".pos-top").remove();
    });
</script>
</body>
</html>
