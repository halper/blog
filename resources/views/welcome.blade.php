<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>aLpEr's BLoG</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/materialize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/social-share-kit.css')}}">

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
    <div class="container">

        <div class="row">
            <div class="col m9">
                @include('left-side')
            </div>

            <div class="col m3" id="right-side">
                @include('right-side')
            </div>
        </div>

    </div>
</section>
<script src="{{URL::asset('js/app.js')}}"></script>
<script src="{{URL::asset('js/materialize.min.js')}}"></script>
</body>
</html>
