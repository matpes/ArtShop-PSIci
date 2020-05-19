<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Pobedili ste na aukciji za sliku {{$picture->naziv}}</h1>
<p>
    CESTITAMO!
    Pobedili ste na aukciji za sliku.
    Vasa ponuda je iznosila {{$picture->cena}}.
    Pogledajte sliku na: artshop.test/picture/{{$picture->id}}
</p>

</body>
</html>
