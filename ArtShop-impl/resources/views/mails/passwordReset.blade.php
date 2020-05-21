<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtShop</title>
</head>
<body>

<h1>{{$title}}</h1>
<br>
<h2> Zdravo {{ $username }},</h2>
<p> Tvoja nova lozinka se nalazi u ovoj poruci. Ako nisi zatražio resetovanje lozinke uloguj se sa datom lozinkom i
promeni je na svom nalogu.</p>
<p> Lozinka: "{{$password}}"</p> (navodnici ne ulaze u karaktere lozinke)
<br>
<p>
Možete se ulogovati na sledećem linku:
<a href="{{$link}}">ovde</a>
</p>
<p> Hvala na poverenju! </p>
<br> <br>
<p> Tvoj tim PSIći</p>
</body>
</html>




