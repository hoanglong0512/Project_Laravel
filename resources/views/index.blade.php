<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Home | Template</title>
    @include('layouts._share.style')
</head>

<body>

    <!-- Header Section Begin -->
    @include('layouts._share.header-home')
    <!-- Header Section End -->

    <!-- banner home -->
    @yield('banner-home')
    <!-- end banner home -->

    <!-- stat categories -->
    @yield('cates-home')
    <!-- end categories -->

    <!-- Featured Section Begin -->
    @yield('index-content')
    <!-- Featured Section End -->


    <!-- Footer Section Begin -->
    @include('layouts._share.footer-home')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('layouts._share.script')


</body>

</html>