<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LukyFresh - #sayursegarsehat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<style>
    .logo{
      color: white;
    }
    #containerSlider
      {
        margin: auto;
        margin-top: 0%;
        width: 95%;
        text-align: center;
        box-sizing: border-box;
        opacity: 0.3;
      }
    #containerSlider img
      {
        width: 100%;
        height: 140%;
        text-align: center;
        align-content: center;
      }
  
    @media(max-width: 732px)
      {
    #containerSlider img
        {
          height: 12em;
        }
      }
  
    @media(max-width: 500px)
      {
    #containerSlider img
        {
          height: 10em;
        }
      }
  </style>

<body>
    @include('komponen.menu1')
    
    @yield('konten')
    
    @include('komponen.footer')
    {{-- <div class="container py-5">
        @if (Auth::check())
            @include('komponen.menu1')
        @endif
        @include('komponen/pesan')
        @yield('konten')
    </div> --}}
</body>

<!-- menuscpript -->
<script>
    var MenuItems = document.getElementById("MenuItems");
      MenuItems.style.maxHeight = "0px";
    function menutoggle()
    {
      if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "200px";
      } else {
        MenuItems.style.maxHeight = "0px";
      }
    }
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script>
    $(document).ready(function()
    {
    $('#containerSlider').slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        });
    });
</script>

</html>