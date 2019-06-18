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
<h1>navegacion</h1>
<fieldset>
<legend>Navegación por get</legend>
<form action="about">
    <input type="submit" value="About">
</form>
<form action="contactar">
    <input type="submit" value="Contactar">
</form>
<form action="noticias">
    <input type="submit" value="Noticias">
</form>
<form action="principal">
    <input type="submit" value="Principal">
</form>
</fieldset>
<hr />
<fieldset>
    <legend>Nagegación por post</legend>
<form action="about" method="POST">
    @csrf
    <input type="submit" value="About">
</form>
<form action="contactar" method="POST">
    @csrf
    <input type="submit" value="Contactar">
</form>
<form action="noticias" method="POST">
    @csrf
    <input type="submit" value="Noticias">
</form>
<form action="principal" method="POST">
    @csrf
    <input type="submit" value="Principal">
</form>
</fieldset>
</body>
</html>





