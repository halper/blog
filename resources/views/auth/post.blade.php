<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" content="{{ csrf_token() }}"/>
    @include('base.css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/animate.css')}}">
    <title>Post</title>
</head>
<body>

@yield('post-content')


@include('base.js')
@include('auth._post-js')

</body>
</html>