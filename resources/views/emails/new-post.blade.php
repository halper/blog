<!doctype html>
<html>
<head></head>
<body>
<p>Hello {{$subscriber->name . ' ' . $subscriber->surname}},</p>

<p>I have just published my new post {{$post->title}}!</p>
<br>You can read it from <a href="http://www.halperdom.com/{{$post->slug}}">halperdom.com</a>

</body>
</html>