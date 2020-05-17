<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Meghna One page parallax responsive HTML Template ">


    <title>WhySoSeries</title>

    <!-- Mobile Specific Meta
        ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('img/img/favicon.png')); ?>" type="image/gif" sizes="16x16">

    <!-- CSS
        ================================================== -->

    <!--Lightbox-->
    <link href="<?php echo e(asset('css/lightbox.css')); ?>" rel="stylesheet">
    <!-- Fontawesome Icon font -->
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/dropdown.css')); ?>">



    <!-- Grid Component css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/component.css')); ?>">
    <!-- Slit Slider css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/slit-slider.css')); ?>">
    <!-- Media Queries -->
    <link rel="stylesheet" href="<?php echo e(asset('css/media-queries.css')); ?>">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">

    <!-- Modernizer Script for old Browsers -->
    <script src="<?php echo e(asset('js/modernizr-2.6.2.min.js')); ?>"></script>





</head>

<body id="body">



<section id="home">


</section>

<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="demo" style="width:100%">

<?php echo $__env->yieldContent('content'); ?>

</div>

<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- end section -->

<!-- end Contact Area
    ========================================== -->


<!-- end footer -->

<!-- Back to Top
    ============================== -->
<a href="javascript:;" id="scrollUp">
    <i class="fa fa-angle-up fa-2x"></i>
</a>



<!-- end Footer Area
    ========================================== -->

<!--
    Essential Scripts
    =====================================-->

<!--Lightbox-->
<script src="<?php echo e(asset('js/lightbox-plus-jquery.js')); ?>"></script>
<!-- Main jQuery -->
<script src="<?php echo e(asset('js/jquery-1.11.0.min.js')); ?>"></script>
<!-- Bootstrap 3.1 -->
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<!-- Slitslider -->
<script src="<?php echo e(asset('js/jquery.slitslider.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.ba-cond.min.js')); ?>"></script>
<!-- Parallax -->
<script src="<?php echo e(asset('js/jquery.parallax-1.1.3.js')); ?>"></script>
<!-- Owl Carousel -->
<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
<!-- Portfolio Filtering -->
<script src="<?php echo e(asset('js/jquery.mixitup.min.js')); ?>"></script>
<!-- Custom Scrollbar -->
<script src="<?php echo e(asset('js/jquery.nicescroll.min.js')); ?>"></script>
<!-- Jappear js -->

<script src="<?php echo e(asset('js/jquery.appear.js')); ?>"></script>

<script src="<?php echo e(asset('js/editEpisode.js')); ?>"></script>
<!-- Pie Chart -->
<script src="<?php echo e(asset('js/easyPieChart.js')); ?>"></script>
<!-- jQuery Easing -->
<script src="<?php echo e(asset('js/jquery.easing-1.3.pack.js')); ?>"></script>
<!-- tweetie.min -->
<script src="<?php echo e(asset('js/tweetie.min.js')); ?>"></script>
<!-- Google Map API -->
<script type="../public/text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!-- Highlight menu item -->
<script src="<?php echo e(asset('js/jquery.nav.js')); ?>"></script>
<!-- Sticky Nav -->
<script src="<?php echo e(asset('js/jquery.sticky.js')); ?>"></script>
<!-- Number Counter Script -->
<script src="<?php echo e(asset('js/jquery.countTo.js')); ?>"></script>
<!-- wow.min Script -->
<script src="<?php echo e(asset('js/wow.min.js')); ?>"></script>
<!-- For video responsive -->
<script src="<?php echo e(asset('js/jquery.fitvids.js')); ?>"></script>
<!-- Grid js -->
<script src="<?php echo e(asset('js/grid.js')); ?>"></script>
<!-- Custom js -->
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>


<script type = "text/javascript">
    $('#browse_file').on('click', function(e)
    {
        $('#picture').click();
    })
    $('#picture').on('change', function (e) {
        var fileInput = this;
        if (fileInput.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img').attr('src', e.target.result);

            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    })


</script>

<script type = "text/javascript">
    $('#browse_file1').on('click', function(e)
    {
        $('#picture').click();
    })
    $('#picture').on('change', function (e) {
        var fileInput = this;
        if (fileInput.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#picture').attr('value', e.target.result);

            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    })


</script>

</body>



</html>
