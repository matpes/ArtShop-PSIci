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
    <link rel="icon" href="{{asset('img/img/favicon.png')}}" type="image/gif" sizes="16x16">

    <!-- CSS
        ================================================== -->

    <!--Lightbox-->
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
    <!-- Fontawesome Icon font -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/dropdown.css')}}">



    <!-- Grid Component css -->
    <link rel="stylesheet" href="{{ asset('css/component.css') }}">
    <!-- Slit Slider css -->
    <link rel="stylesheet" href="{{ asset('css/slit-slider.css') }}">
    <!-- Media Queries -->
    <link rel="stylesheet" href="{{ asset('css/media-queries.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">

    <!-- Modernizer Script for old Browsers -->
    <script src="{{ asset('js/modernizr-2.6.2.min.js') }}"></script>





</head>

<body id="body">



<section id="home">


</section>

@include ('layouts.header')

<div class="demo" style="width:100%">

@yield('content')

</div>

@include('layouts.footer')
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
<script src="{{ asset('js/lightbox-plus-jquery.js') }}"></script>
<!-- Main jQuery -->
<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
<!-- Bootstrap 3.1 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Slitslider -->
<script src="{{ asset('js/jquery.slitslider.js') }}"></script>
<script src="{{ asset('js/jquery.ba-cond.min.js') }}"></script>
<!-- Parallax -->
<script src="{{ asset('js/jquery.parallax-1.1.3.js') }}"></script>
<!-- Owl Carousel -->
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<!-- Portfolio Filtering -->
<script src="{{ asset('js/jquery.mixitup.min.js') }}"></script>
<!-- Custom Scrollbar -->
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<!-- Jappear js -->

<script src="{{ asset('js/jquery.appear.js') }}"></script>

<script src="{{ asset('js/editEpisode.js') }}"></script>
<!-- Pie Chart -->
<script src="{{ asset('js/easyPieChart.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('js/jquery.easing-1.3.pack.js') }}"></script>
<!-- tweetie.min -->
<script src="{{ asset('js/tweetie.min.js') }}"></script>
<!-- Google Map API -->
<script type="../public/text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!-- Highlight menu item -->
<script src="{{ asset('js/jquery.nav.js') }}"></script>
<!-- Sticky Nav -->
<script src="{{ asset('js/jquery.sticky.js') }}"></script>
<!-- Number Counter Script -->
<script src="{{ asset('js/jquery.countTo.js') }}"></script>
<!-- wow.min Script -->
<script src="{{ asset('js/wow.min.js') }}"></script>
<!-- For video responsive -->
<script src="{{ asset('js/jquery.fitvids.js') }}"></script>
<!-- Grid js -->
<script src="{{ asset('js/grid.js') }}"></script>
<!-- Custom js -->
<script src="{{ asset('js/custom.js') }}"></script>


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
