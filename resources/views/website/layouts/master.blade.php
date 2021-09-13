<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PAPPU PORTFOLIO</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Style-sheet -->
    <link rel="stylesheet" href="{{ asset ('website')}}/css/style.css" />
    <!-- Jquery-cdn-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Vue js-cdn-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <!-- Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- Tailwindcss-->
    <link rel="stylesheet" href="{{ asset ('website')}}/css/tailwind.min.css" />
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->

    <!--Aos animation-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- OwlCarousel2-slider-css-sheet-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- Line Awesome Icons -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <link href="{{ asset('website') }}/css/custom.css" rel="stylesheet">

    <!-- Sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/vue-star-rating/dist/VueStarRating.umd.min.js"></script>

    <!-- tab -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


    <!-- Bootstrap 4 -->
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   @yield('style')
</head>
@yield('style')

<body>

   <div id="app">
      <!-- Start header section-->
      @include('website.layouts.header')
      <!-- End header section-->

       <!-- Start hero section-->
       <router-view></router-view>
      <!-- Start hero section-->

      <!-- Start footer section-->
      @include('website.layouts.footer')
      <!-- End footer section--->

    </div>


<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
</script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset ('website')}}/js/sweetalert.js"></script>
    <script type="text/javascript" src="{{ asset ('website')}}/js/cart.js"></script>
    <script type="text/javascript" src="{{ asset ('website')}}/js/menu.js"></script>
    <!--For animation-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <!--for text typing effect-->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
      <!--for owl slider-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

</body>

</html>
