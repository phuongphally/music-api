<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Styles -->
    <link href="<?php echo e(url('/')); ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo e(url('/')); ?>/css/main.css" rel="stylesheet">
    <link href="<?php echo e(url('/')); ?>/css/custom.css" rel="stylesheet">
    <!-- Scripts -->
</head>
<body>
    <div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <footer class="text-center">
        <p>  Copyright &copy; <?php echo date('Y'); ?> by <a href="http://slekcode.com/"> SlekCode </a> </p>
    </footer>
    <!-- Scripts -->
    <script src="<?php echo e(url('/')); ?>/js/app.js"></script>
    <script>
    $( ".close" ).click(function() {
      $(".pos-top").remove();
    });
</script>
</body>
</html>
