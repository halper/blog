<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" content="{{ csrf_token() }}"/>
    @yield('meta-prop')

    <title>aLpEr's BLoG</title>
    @include('base.css')

</head>
<body style="background-color: #fdfdfd">
<section style="background-color: #fff">
    <div class="row">
        <div class="col s12">
            <h3 class="center-align">aLpEr</h3>

            <p class="center-align grey-text text-lighten-1" style="font-size: larger;"><i>knowledge is power.
                    information is power.</i></p>
        </div>
    </div>
</section>

<section id="content">
    @yield('content')
</section>
@include('base.js')
@yield('page-specific-js')
</body>
</html>
