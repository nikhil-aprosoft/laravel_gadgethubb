<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('assets/images/icons/favicon.png') }}">

<!-- WebFont.js -->
<script>
    WebFontConfig = {
        google: {
            families: ['Poppins:400,500,600,700']
        }
    };
    (function(d) {
        var wf = d.createElement('script'),
            s = d.scripts[0];
        wf.src = '{{ asset('assets/js/webfont.js') }}';
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
    })(document);
</script>

<link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font"
    type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font"
    type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font"
    type="font/woff2" crossorigin="anonymous">
<link rel="preload" href="{{ asset('assets/fonts/wolmart87d5.woff?png09e') }}" as="font" type="font/woff"
    crossorigin="anonymous">

<!-- Vendor CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">

<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

<!-- Default CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}">

<!-- Add this in the <head> section of your Blade template -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">


